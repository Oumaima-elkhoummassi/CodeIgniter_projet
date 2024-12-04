<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\VoitureModel;
use FPDF;
use App\Libraries;
class Client extends BaseController
{
    public function __construct()
    {
        helper(['url']);
        $this->client = new ClientModel();
        $this->vehicule = new VoitureModel();
    }

    public function form()
    {
        // Load the Voiture model (assuming you have a VoitureModel)
        $vehiculesDisponibles = model('VoitureModel')->where('status', 1)->findAll();
    
        // Pass the data to the view
        return view('client/form', ['vehiculesDisponibles' => $vehiculesDisponibles]);
    }

    public function table()
    {
        // Get all clients
        $data['client'] = $this->client->findAll();
        
        // Return the table view with the client data
        return view('client/table', $data);
    }

    public function SaveClient()
    {
        // Retrieve input data from the form
        $cin = $this->request->getVar('cin');
        $nom = $this->request->getVar('nom');
        $prenom = $this->request->getVar('prenom');
        $Email = $this->request->getVar('Email');
        $id_voiture = $this->request->getVar('id_voiture');
        $date_vonte = $this->request->getVar('date_vonte');

        // Save the client data with the vehicle ID
        $this->client->save([
            "cin" => $cin,
            "nom" => $nom,
            "prenom" => $prenom,
            "Email" => $Email,
            "id_voiture" => $id_voiture,
            "date_vonte" => $date_vonte
        ]);

        session()->setFlashdata("success", "Client added successfully.");
        return redirect()->to(base_url('client/table'));
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
    
        return view('client/index', $data);
    }










    public function edit($id)
    {
        // Get client information by ID
        $clientInfo = $this->client->find($id);
        if (!$clientInfo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Client with ID $id not found");
        }

        // Get available vehicles (status 'disponible')
        $vehiculesDisponibles = $this->vehicule->where('status', 1)->findAll();

        // Pass client data and available vehicles to the view
        $data = [
            'clientInfo' => $clientInfo,
            'vehiculesDisponibles' => $vehiculesDisponibles
        ];

        return view('client/edit', $data);
    }

    public function updateClient($id)
    {
        // Retrieve input data from the form
        $cin = $this->request->getVar('cin');
        $nom = $this->request->getVar('nom');
        $prenom = $this->request->getVar('prenom');
        $Email = $this->request->getVar('Email');
        $id_voiture = $this->request->getVar('id_voiture');
        $date_vonte = $this->request->getVar('date_vonte');

        // Prepare data for updating client
        $data = [
            'cin' => $cin,
            'nom' => $nom,
            'prenom' => $prenom,
            'Email' => $Email,
            'id_voiture' => $id_voiture,
            'date_vonte' => $date_vonte
        ];

        // Update client data in database
        $this->client->update($id, $data);

        // Redirect with success message
        session()->setFlashdata("success", "Client data updated successfully.");
        return redirect()->to(base_url('client/table'));
    }











 


    public function deleteClient($id)
    {
        // Verify if client exists
        $clientInfo = $this->client->find($id);
        if (!$clientInfo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Client with ID $id not found");
        }

        // Delete client from the database
        $this->client->delete($id);

        // Redirect with success message
        session()->setFlashdata("success", "Client deleted successfully.");
        return redirect()->to(base_url('client/table'));
    }


    
    public function generateInvoice($id)
    {
        $client = $this->client->find($id);
        $vehicule = $this->vehicule->where('id', $client['id_voiture'])->first();
    
        if (!$client || !$vehicule) {
            return redirect()->back()->with('error', 'Client ou véhicule non trouvé.');
        }
    
        // Charger FPDF
        $this->response->setHeader('Content-Type', 'application/pdf');
        require_once APPPATH . 'Libraries/fpdf.php';
    
        $pdf = new FPDF();
        $pdf->AddPage();
    
        // Contenu du PDF
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Facture de Vente', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, "Client: {$client['nom']} {$client['prenom']}", 0, 1);
        $pdf->Cell(0, 10, "Email: {$client['Email']}", 0, 1);
        $pdf->Cell(0, 10, "CIN: {$client['cin']}", 0, 1);
        $pdf->Cell(0, 10, "Date de Vente: {$client['date_vonte']}", 0, 1);
        $pdf->Cell(0, 10, "Vehicule: {$vehicule['marque']} {$vehicule['model']}", 0, 1);
        $pdf->Cell(0, 10, "Prix: {$vehicule['prix']} MAD", 0, 1);
    
        $pdf->SetY(-50);
        $pdf->SetX(100);
        $pdf->Cell(0, 10, 'Signature', 0, 0, 'R');
    
        // Générer le PDF
        $pdf->Output('I', "Facture_Client_{$id}.pdf");
        exit(); // Important pour éviter toute sortie supplémentaire
    }
    
}


