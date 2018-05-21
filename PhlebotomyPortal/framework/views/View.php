<?php

namespace PhlebotomyPortal;

abstract class View {

    private $ErrorMessages = array(
        'ERROR' => "Something went wrong",
        'ACCESSDENIED' => "You do not have access to this",
        'ADDPATIENTDENIED' => "You do not have permissions to add a new patient to the system",
        'SEARCHPATIENTDENIED' => "You do not have permission to search patient records."
    );

    public function errorMessage($ErrorType, $exMsg = null) {
        ?>

        <div id="ErrorBox">

        <?php echo $this->ErrorMessages[$ErrorType]; ?>

        </div>

        <?php
    }

    private $PromptMessages = array(
        'SUCCESSFULRECORDADDED' => "Record Added",
      
        
    );

    public function prompt($PromptType, $exMsg = null) {
        ?>
                <div id="PromptBox">

        <?php echo $this->PromptMessages[$PromptType]; ?>
                    
                </div>

        <?php
    }

}
