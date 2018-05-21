<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/models/Model.php";



class patientsModel extends Model {
  
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getPatientsRecords($LIMIT = null, $PAGE = null, $SearchParams)
    {
        
        print_r($SearchParams);
        
//        $this->DatabaseRead->query('SELECT * FROM patients_table');
//             
//        try{
//            return $this->DatabaseRead->getResultSet();
//        } catch (Exception $ex) {
//           echo $ex; //Turn on for debugging.
//        }  
//        return null;
        
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
        
          $returnedContactDetailsID = null;
        
        //This needs to be a transaction!
        
        
        //Add contact details first and get back the ID for that insert.
       
        $this->DatabaseWrite->query('INSERT INTO contact_details_table ('
                . 'ContactTitle, ContactFirstName, ContactLastName, ContactEmail, ContactPhone, ContactMobile,'
                . 'ContactAddressLine1, ContactAddressLine2, ContactTown, ContactCounty, ContactPostCode)'
                . ' VALUES(:ContactTitle,:ContactFirstName,:ContactLastName,:ContactEmail,:ContactPhone,:ContactMobile,:ContactAddressLine1,:ContactAddressLine2,:ContactTown,:ContactCounty,:ContactPostCode)');

        $this->DatabaseWrite->bind(':ContactTitle', $NewPatientDetails['ContactTitle']);
        $this->DatabaseWrite->bind(':ContactFirstName', $NewPatientDetails['ContactFirstName']);
        $this->DatabaseWrite->bind(':ContactLastName', $NewPatientDetails['ContactLastName']);
        $this->DatabaseWrite->bind(':ContactPhone', $NewPatientDetails['ContactPhone']);
        $this->DatabaseWrite->bind(':ContactEmail', $NewPatientDetails['ContactEmail']);
        $this->DatabaseWrite->bind(':ContactMobile', $NewPatientDetails['ContactMobile']);
        $this->DatabaseWrite->bind(':ContactAddressLine1', $NewPatientDetails['ContactAddressLine1']);
        $this->DatabaseWrite->bind(':ContactAddressLine2', $NewPatientDetails['ContactAddressLine2']);
        $this->DatabaseWrite->bind(':ContactTown', $NewPatientDetails['ContactTown']);
        $this->DatabaseWrite->bind(':ContactCounty', $NewPatientDetails['ContactCounty']);
        $this->DatabaseWrite->bind(':ContactPostCode', $NewPatientDetails['ContactPostCode']);
    

        try {
            if ($this->DatabaseWrite->execute()) {
                $returnedContactDetailsID = $this->DatabaseWrite->getLastRecordInsertID();
            } else {
                return false;
            }
        } catch (Exception $ex) {
            
        }

 
        $this->DatabaseWrite->query('INSERT INTO patients_table ('
                . 'PatientFirstName, PatientLastName, PatientDOB, PatientGender, PatientBloodType, PatientNHSNumber, ContactDetailsID ) '
                . 'VALUES (:PatientFirstName,:PatientLastName,'
                . ':PatientDOB,:PatientGender,:PatientBloodType,:PatientNHSNumber,:ContactDetailsID) ');
        
        $this->DatabaseWrite->bind(':PatientFirstName', $NewPatientDetails['PatientFirstName']);
        $this->DatabaseWrite->bind(':PatientLastName', $NewPatientDetails['PatientLastName']);
        $this->DatabaseWrite->bind(':PatientDOB', $NewPatientDetails['PatientDOB']);
        $this->DatabaseWrite->bind(':PatientGender', $NewPatientDetails['PatientGender']);
        $this->DatabaseWrite->bind(':PatientBloodType', $NewPatientDetails['PatientBloodType']);
        $this->DatabaseWrite->bind(':PatientNHSNumber', $NewPatientDetails['PatientNHSNumber']);
        $this->DatabaseWrite->bind(':ContactDetailsID', $returnedContactDetailsID);
        
        
        
        $this->DatabaseWrite->execute();
        
        return true;

        
    }
    

    
    
}
