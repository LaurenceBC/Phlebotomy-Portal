<?php



namespace PhlebotomyPortal;


require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/views/View.php";


class patientsView extends View{
    
    
    
    public function mainpage()
    {
       
        ?>
        
        <a href="?action=viewpatients">patients</a>


        <?php 
        
    }
    
    public function viewpatients($PatientRecords)
    {
        echo ' in patients';
        
        print_r($PatientRecords);
        
    }
    
    public function addnewpatient()
    {
        ?>
        
        <div id="addnewpatientWrapper">
            
            <form action="?action=addnewpatient" method="POST">
                
                <label>Patients first name:</label>
                <input type='text' name='PatientFirstName' value="PatientFirstName" class="textbox">
                <label>Patients last name:</label>
                <input type='text' name='PatientLastName' value="PatientLastName" class="textbox">
                <label>Patients date of birth:</label>
                
<!--                 <input type='text' name='PatientLastName' value="PatientLastName" class="textbox">
            <date-util format="dd/MM/yyyy"></date-util>-->
             </form>
            
            
          
        </div>
        
        
        
        <?php
    }
    
    
    
    
}
