<?php

namespace App\Controllers;

class Livre extends BaseController
{
    public function ajoute()
    {
       $titre = $this->request->getPost('livre');
       if(!empty($titre)){
        
       }

       
    }
}
