<?php



namespace PhlebotomyPortal;



abstract class View {
    
    
    
    private $ErrorMessages = array(
        'ERROR' => "Something went wrong",
        'ACCESSDENIED' => "You do not have access to this"        
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
