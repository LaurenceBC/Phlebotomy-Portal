<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/framework/models/Model.php";



class patientsModel extends Model {
  
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getPatientsRecords($LIMIT = null, $PAGE = null)
    {
        
        $this->DatabaseRead->query('SELECT * FROM patients_table');
             
        try{
            return $this->DatabaseRead->getResultSet();
        } catch (Exception $ex) {
           echo $ex; //Turn on for debugging.
        }  
        return null;
        
    }
    
    public function getPatientRecord($PatientID)
    {
        $this->DatabaseRead->query('SELECT * FROM patients_table WHERE PatientID = :PaitentID');
        $this->DatabaseRead->bind(':PatientID', $PatientID, PDO::PARAM_INT);
        
        try{
           return $this->DatabaseRead->getSingleRecord();
        } catch (Exception $ex) {
          echo $ex;
        }
        return null;
    }
    
    
    public function addPatientRecord($NewPatientDetails)
    {
        $this->DatabaseWrite->query('INSERT INTO patients_table '
                                  . '(PatientFirstName) '
                . 'VALUEs (:PatientFirstName,)');
        
        $this->DatabaseWrite->bind(':PatientFirstName', $NewPatientDetails['PatientFirstName']);
        
        
    }
    

    
    
}
