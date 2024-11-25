<?php include 'header.php'; ?>
            <!-- Navbar End -->


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Information sur le Client</h6>
                            <form action="SaveClient" method="POST">
                                <div class="mb-3">
                                    <label for="cin" class="form-label">Cin</label>
                                    <input type="text" class="form-control" id="cin" name="cin" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" name="nom" id="nom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prenom</label>
                                    <input type="text" class="form-control" name="prenom" id="prenom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" class="form-control"  name="Email" id="Email" required>
                                </div>
                             
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Information sur la Voiture</h6>
                         
                            <div class="row mb-3">
    <label for="id_voiture" class="col-sm-2 col-form-label">N° Voiture</label>
    <div class="col-sm-10">
        <select class="form-control" name="id_voiture" id="id_voiture" required>
            <option value="">Sélectionnez un véhicule</option>
            <?php foreach ($vehiculesDisponibles as $vehicule): ?>
                <option value="<?= $vehicule['id']; ?>">
                    <?= $vehicule['Num_vehicule'] . ' - ' . $vehicule['marque'] . ' ' . $vehicule['model']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

                                <div class="row mb-3">
                                    <label for="date_vonte" class="col-sm-2 col-form-label">Date Vente</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control"  name="date_vonte"id="date_vonte" required>
                                    </div>
                                </div>
                              
                                
                               
                               
                                
                                <button type="submit" class="btn btn-primary">Ajoute</button>
                            </form>
                        </div>
                    </div>
                  
                   
                   
                </div>
            </div>
            <!-- Form End -->


            <?php include 'footer.php'; ?>