<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\ClientModelModel;
use App\Models\VehiculeModel;
use FPDF;
use App\Libraries;
class Home extends BaseController
{
    public function __construct()
    {
        helper(['url']);
        $this->client= new ClientModel();
        $this->vehicule= new VehiculeModel();
        $this->db = \Config\Database::connect();
        
    }
    public function index()
    {
        echo view('index');
    }
    public function dashboard()
    {
        $today = date('Y-m-d');
        $currentMonth = date('Y-m');
    
        $totalVehicles = $this->vehicule->countAll();
        $totalClients = $this->client->countAll();
        $salesToday = $this->client->where('date_vonte', $today)->countAllResults();
        $salesThisMonth = $this->client->like('date_vonte', $currentMonth, 'after')->countAllResults();
    
        $data = [
            'totalVehicles' => $totalVehicles,
            'totalClients' => $totalClients,
            'salesToday' => $salesToday,
            'salesThisMonth' => $salesThisMonth,
        ];
    
        return view('index', $data);
    }
    
    

    public function form(){
     
 
    // Récupère les véhicules avec le statut 'disponible'
    $data['vehiculesDisponibles'] = $this->vehicule->where('status', 'disponible')->findAll();

    // Charge la vue du formulaire avec les données des véhicules disponibles
    echo view('form', $data);

    }
    public function table(){
        $data['client']=$this->client->findAll();
        echo view('table',$data);
    
    }
    public function SaveClient()
    {
        $cin = $this->request->getVar('cin');
        $nom = $this->request->getVar('nom');
        $prenom = $this->request->getVar('prenom');
        $Email = $this->request->getVar('Email');
        $id_voiture = $this->request->getVar('id_voiture');
        $date_vonte = $this->request->getVar('date_vonte');
        
        // Récupérer le 'Num_vehicule' en fonction de l'ID de la voiture
        $vehicule = $this->vehicule->find($id_voiture);
        $num_vehicule = $vehicule['Num_vehicule'];  // Assurez-vous que la colonne existe dans votre table
    
        // Enregistrer le client avec le 'Num_vehicule'
        $this->client->save([
            "cin" => $cin,
            "nom" => $nom,
            "prenom" => $prenom,
            "Email" => $Email,
            "id_voiture" => $num_vehicule,  // Stocker le numéro du véhicule, pas l'id
            "date_vonte" => $date_vonte
        ]);
    
        session()->setFlashdata("success", "Votre client a bien été ajouté.");
    
        return redirect()->to(base_url('table'));
    }
    
    public function edit($id)
    {
        // Récupère les informations actuelles du client par ID
        $clientInfo = $this->client->find($id);
        if (!$clientInfo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Client avec ID $id non trouvé");
        }
    
        // Récupère les véhicules disponibles (filtrer selon le statut "disponible")
        $vehiculesDisponibles = $this->vehicule->where('status', 'disponible')->findAll();
    
        // Passer les informations du client et les véhicules disponibles à la vue
        $data = [
            'clientInfo' => $clientInfo,
            'vehiculesDisponibles' => $vehiculesDisponibles
        ];
    
        echo view('edit', $data);
    }
    

    public function updateClient($id)
    {
        // Récupère les valeurs envoyées par le formulaire
        $cin = $this->request->getVar('cin');
        $nom = $this->request->getVar('nom');
        $prenom = $this->request->getVar('prenom');
        $Email = $this->request->getVar('Email');
        $id_voiture = $this->request->getVar('id_voiture');
        $date_vonte = $this->request->getVar('date_vonte');
    
        // Vérifie si le véhicule sélectionné est disponible
        $vehicule = $this->vehicule->find($id_voiture);
        if (!$vehicule || $vehicule['status'] !== 'disponible') {
            session()->setFlashdata("error", "Le véhicule sélectionné n'est pas disponible.");
            return redirect()->back();
        }
    
        // Prépare les données pour la mise à jour
        $data = [
            'cin' => $cin,
            'nom' => $nom,
            'prenom' => $prenom,
            'Email' => $Email,
            'id_voiture' => $vehicule['Num_vehicule'], // Enregistre le numéro de véhicule
            'date_vonte' => $date_vonte
        ];
    
        // Mettre à jour les informations du client
        $this->client->update($id, $data);
    
        // Redirige avec un message de succès
        session()->setFlashdata("success", "Les informations du client ont été mises à jour.");
        return redirect()->to(base_url('table'));
    }
    
public function deleteClient($id)
{
    // Vérifie si le client existe
    $clientInfo = $this->client->find($id);
    if (!$clientInfo) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Client avec ID $id non trouvé");
    }

    // Supprime le client de la base de données
    $this->client->delete($id);

    // Message de confirmation de suppression
    session()->setFlashdata("success", "Le client a été supprimé avec succès.");
    return redirect()->to(base_url('table'));
}
  

public function generateInvoice($id)
{
    $client = $this->client->find($id);
    $vehicule = $this->vehicule->where('Num_vehicule', $client['id_voiture'])->first();
    
    if (!$client || !$vehicule) {
        return redirect()->back()->with('error', 'Client ou véhicule non trouvé.');
    }

    // Charger FPDF (vérifiez le chemin si nécessaire)
    $this->response->setHeader('Content-Type', 'application/pdf');
    require_once APPPATH . 'Libraries/fpdf.php';
    $pdf = new FPDF();
    $pdf->AddPage();

    // Contenu du PDF
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Facture de Vente', 0, 1, 'C');

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Client: " . $client['nom'] . " " . $client['prenom'], 0, 1);
    $pdf->Cell(0, 10, "Email: " . $client['Email'], 0, 1);
    $pdf->Cell(0, 10, "CIN: " . $client['cin'], 0, 1);
    $pdf->Cell(0, 10, "Date de Vente: " . $client['date_vonte'], 0, 1);

    $pdf->Cell(0, 10, "Vehicule: " . $vehicule['marque'] . " " . $vehicule['model'], 0, 1);
    $pdf->Cell(0, 10, "Numero: " . $vehicule['Num_vehicule'], 0, 1);
    $pdf->Cell(0, 10, "Prix de Vente: " . $vehicule['prix'] . " MAD", 0, 1);
    $pdf->SetY(-50); // Ajustez -30 pour déplacer la zone de signature plus bas ou plus haut selon vos besoins
    $pdf->SetX(100);

// Ligne pour la signature
$pdf->Cell(0, 10, 'Signature', 0, 0, 'R'); // Ajoute le mot "Signature" aligné à gauche




    // Générer le PDF
    $pdf->Output('I', 'Facture_Client_' . $id . '.pdf');
   // $mpdf->Output(); 
}
}
