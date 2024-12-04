
<!DOCTYPE html>
<html lang="en">

    </style>
<?php include 'header.php'; ?>

         
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                <a href="form">
                <div class="col-sm-12 col-xl-6">
                    <div class="m-n2">
                    <button type="button" class="btn btn-primary rounded-pill m-2"> + Ajoute Client</button>  
                    </div>
                    </div>
                    </a>
                    <?php  if(session()->getFlashdata("success")){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'. $_SESSION['success'];
                        
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';
                        
                      

}
         
         
                    ?>
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Table Client</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Cin</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Prenom</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">N° Voiture</th>
                                            <th scope="col">Date Vente</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($client){
                                            foreach($client as $row){ 
                                                ?>
                                        
                                        <tr>
                                            <th scope="row" ><?php echo $row['id'] ?></th>
                                            <td><?php echo $row['cin'] ?></td>
                                            <td><?php echo $row['nom'] ?> </td>
                                            <td><?php echo $row['prenom'] ?></td>
                                            <td><?php echo $row['Email'] ?></td>
                                            <td><?php echo $row['id']; ?></td> <!-- 'id_voiture' contient maintenant le 'Num_vehicule' -->
                                            <td><?php echo $row['date_vonte'] ?></td>
                                            <td>
                                                <a href="client/edit/<?= $row['id'] ?>" class="btn btn-square btn-primary m-2"><i class="fa fa-edit"></i>
                                                <a href="<?= site_url('client/delete/' . $row['id']) ?>"  class="btn btn-square btn-primary m-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');"><i class="fa fa-trash"></i>
                                                <a href="<?= site_url('client/pdf/' . $row['id']) ?>" class="btn btn-square btn-primary m-2"><i class="fa fa-file-pdf"></i>
                                            </td>
                                        </tr>
                                        
                                        <?php }
                                        } 
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->


            <!-- Footer Start -->
           
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <?php include 'footer.php'; ?>