<?php



namespace PhlebotomyPortal;



abstract class View {
    
    
    
    private $ErrorMessages = array(
        'ERROR' => "Something went wrong",
        'ACCESSDENIED' => "You do not have access to this",
        'ADDPATIENTDENIED' => "You do not have permissions to add a new patient to the system"
    );
    
    public function errorMessage($ErrorType, $exMsg = null)
    {
        ?>
        
            <div id="ErrorBox">
                  
                <?php echo $this->ErrorMessages[$ErrorType]; ?>

            </div>

        <?php
    }
    
    
}
