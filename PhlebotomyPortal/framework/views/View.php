<?php

namespace PhlebotomyPortal;

abstract class View {

    private $ErrorMessages = array(
        'ERROR' => "Something went wrong",
        'ACCESSDENIED' => "You do not have access to this",
        'ADDPATIENTDENIED' => "You do not have permissions to add a new patient to the system",
        'SEARCHPATIENTDENIED' => "You do not have permission to search patient records.",
        'NOSEARCHPARAMETERS' => "No search parameters entered.",
        'EDITPATIENTDENIED' => "You do not have permission to edit a patient record.",
        'DELETEPATIENTDENIED' => "You do not have permission to delete a patient record.",
      
    );

    public function errorMessage($ErrorType, $Redirecturl = null, $exMsg = null) {
        ?>

        <div id="ErrorBox">

        <?php echo $this->ErrorMessages[$ErrorType]; 
           if(!empty($Redirecturl))
        {
              header( "refresh:3 url= $Redirecturl");
              echo '<h2>Redirecting...</h2>';
        }?>

        </div>

        <?php
    }

    private $PromptMessages = array(
        'SUCCESSFULRECORDADDED' => "Record Added",
         'SUCCESSFULRECORDEDITED' => "Record Edited",
   'PATIENTRECORDDELETED' => "Patient record deleted."
    );

    public function prompt($PromptType, $Redirecturl = null, $exMsg = null) {
        ?>
                <div id="PromptBox">
                    

           <?php echo '<h1>' . $this->PromptMessages[$PromptType] . '</h1>';
        if(!empty($Redirecturl))
        {
              header( "refresh:3 url= $Redirecturl");
              echo '<h2>Redirecting...</h2>';
        }
        ?>
                    
                    
                    
                </div>

        <?php
    }

}
