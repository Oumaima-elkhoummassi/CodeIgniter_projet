<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\VoitureModel;

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
       $data['vehiculesDisponibles'] = $this->vehicule->where('status', 1)->findAll();

    // Charger la vue avec les véhicules disponibles
    return view('form', $data);
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
        return redirect()->to(base_url('table'));
    }

    public function edit($id)
    {
        // Get client information by ID
        $clientInfo = $this->client->find($id);
        if (!$clientInfo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Client with ID $id not found");
        }

        // Get available vehicles (status 'disponible')
        $vehiculesDisponibles = $this->vehicule->where('status', 'disponible')->findAll();

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
}
