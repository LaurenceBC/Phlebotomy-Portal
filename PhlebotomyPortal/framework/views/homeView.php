<?php


namespace PhlebotomyPortal;


require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/views/View.php";


class homeView extends View {
   
    
    public function mainpage()
    {
       
        ?>
        
        <a href="https://">patients</a>


        <?php 
        
    }
    
    
    
    
}

