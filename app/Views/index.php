<?php include 'header.php'; ?>
            <!-- Navbar End -->


            <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Total Véhicule -->
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Véhicule</p>
                    <h6 class="mb-0"><?= $totalVehicles ?></h6>
                </div>
            </div>
        </div>

        <!-- Total Client -->
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Client</p>
                    <h6 class="mb-0"><?= $totalClients ?></h6>
                </div>
            </div>
        </div>

        <!-- Vente par jour -->
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Vente par jour</p>
                    <h6 class="mb-0"><?= $salesToday ?></h6>
                </div>
            </div>
        </div>

        <!-- Vente par mois -->
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Vente par mois</p>
                    <h6 class="mb-0"><?= $salesThisMonth ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Graphe de Vente</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>



                    
                           
                            <div class="col-sm-12 col-md-6 col-xl-4" >
                                <div class="h-100 bg-light rounded p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h6 class="mb-0">Calender</h6>
                                        <a href="">Show All</a>
                                    </div>
                                    <div id="calender"></div>
                                </div>
                            </div>
                          
                           
                    </div>
            </div>
            <!-- Sales Chart End -->


            <!-- Recent Sales Start -->
           
            <!-- Recent Sales End -->


            <!-- Widgets Start -->
     
            <!-- Widgets End -->
<!-- Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Récupérer les données PHP dans JavaScript
const totalVehicles = <?= $totalVehicles; ?>;
const totalClients = <?= $totalClients; ?>;
const salesToday = <?= $salesToday; ?>;
const salesThisMonth = <?= $salesThisMonth; ?>;

// Configuration du graphique
const ctx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(ctx, {
    type: 'bar', // Choisissez le type de graphique
    data: {
        labels: ['Total Véhicules', 'Total Clients', 'Ventes Aujourd\'hui', 'Ventes Ce Mois'],
        datasets: [{
            label: 'Données de Vente',
            data: [totalVehicles, totalClients, salesToday, salesThisMonth],
            backgroundColor: [
                'rgba(54, 162, 235, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(54, 162, 235, 0.6)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
               'rgba(54, 162, 235, 1)',
               'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

            <?php include 'footer.php'; ?>