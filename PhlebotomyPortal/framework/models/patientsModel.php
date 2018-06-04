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

    public function deletePatientRecord($PatientID) {
        $this->DatabaseWrite->query('DELETE FROM patients_table WHERE PatientID = :PatientID');
        $this->DatabaseWrite->bind(':PatientID', $PatientID);
        return $this->DatabaseWrite->execute();
    }

    public function getPatientsRecords($SearchParams, $LIMIT = null, $PAGE = null) {



        $this->DatabaseRead->query('SELECT * FROM patients_table '
                . 'WHERE '
                . '(:PatientFirstName is null or PatientFirstName like "%" :PatientFirstName "%") AND'
                . '(:PatientLastName is null or PatientLastName like "%" :PatientLastName "%") AND'
                . '(:PatientNHSNumber is null or PatientNHSNumber like "%" :PatientNHSNumber "%") AND'
                . '(:PatientDOB is null or PatientDOB like "%" :PatientDOB "%")');

        $this->DatabaseRead->bind(':PatientFirstName', $SearchParams[0]);
        $this->DatabaseRead->bind(':PatientLastName', $SearchParams[1]);
        $this->DatabaseRead->bind(':PatientNHSNumber', $SearchParams[2]);
        $this->DatabaseRead->bind(':PatientDOB', $SearchParams[3]);

        try {
            $SearchResults = $this->DatabaseRead->getResultSet();
        } catch (Exception $ex) {
            
        }

        return $SearchResults;
    }

    public function getSinglePatientRecord($PatientID) {


        $this->DatabaseRead->query('SELECT patients_table.*, contact_details_table.* '
                . 'FROM patients_table '
                . 'INNER JOIN contact_details_table '
                . 'ON patients_table.ContactDetailsID = contact_details_table.ContactDetailsID '
                . 'WHERE PatientID = :PatientID');



        $this->DatabaseRead->bind(':PatientID', $PatientID);

        try {
            return $this->DatabaseRead->getSingleRecord();
        } catch (Exception $ex) {
            echo $ex;
        }
        return null;
    }

    public function editPatientRecord($EditedPatientDetails) {


        //update patient record. Should be a transaction.

        $this->DatabaseWrite->query('UPDATE patients_table SET PatientTitle = :PatientTitle, PatientFirstName = :PatientFirstName,'
                . ' PatientLastName = :PatientLastName, PatientDOB = :PatientDOB, PatientGender = :PatientGender, '
                . 'PatientBloodType = :PatientBloodType, PatientNHSNumber = :PatientNHSNumber WHERE PatientID = :PatientID');

        $this->DatabaseWrite->bind(':PatientTitle', $EditedPatientDetails['PatientTitle']);
        $this->DatabaseWrite->bind(':PatientFirstName', $EditedPatientDetails['PatientFirstName']);
        $this->DatabaseWrite->bind(':PatientLastName', $EditedPatientDetails['PatientLastName']);
        $this->DatabaseWrite->bind(':PatientDOB', $EditedPatientDetails['PatientDOB']);
        $this->DatabaseWrite->bind(':PatientGender', $EditedPatientDetails['PatientGender']);
        $this->DatabaseWrite->bind(':PatientBloodType', $EditedPatientDetails['PatientBloodType']);
        $this->DatabaseWrite->bind(':PatientNHSNumber', $EditedPatientDetails['PatientNHSNumber']);
        $this->DatabaseWrite->bind(':PatientID', $EditedPatientDetails['PatientID']);


        try {
            $this->DatabaseWrite->execute();
        } catch (\PDOException $ex) {
            echo $ex;
            return false;
        }




        $this->DatabaseWrite->query('UPDATE contact_details_table '
                . 'SET ContactPhone = :ContactPhone, '
                . 'ContactMobile = :ContactMobile, '
                . 'ContactAddressLine1 = :ContactAddressLine1, '
                . 'ContactAddressLine2 = :ContactAddressLine2, '
                . 'ContactTown = :ContactTown, '
                . 'ContactCounty = :ContactCounty, '
                . 'ContactPostCode = :ContactPostCode, '
                . 'ContactEmail = :ContactEmail '
                . 'WHERE '
                . 'ContactDetailsID = :ContactDetailsID');

        $this->DatabaseWrite->bind(':ContactPhone', $EditedPatientDetails['ContactPhone']);
        $this->DatabaseWrite->bind(':ContactMobile', $EditedPatientDetails['ContactMobile']);
        $this->DatabaseWrite->bind(':ContactAddressLine1', $EditedPatientDetails['ContactAddressLine1']);
        $this->DatabaseWrite->bind(':ContactAddressLine2', $EditedPatientDetails['ContactAddressLine2']);
        $this->DatabaseWrite->bind(':ContactTown', $EditedPatientDetails['ContactTown']);
        $this->DatabaseWrite->bind(':ContactCounty', $EditedPatientDetails['ContactCounty']);
        $this->DatabaseWrite->bind(':ContactPostCode', $EditedPatientDetails['ContactPostCode']);
        $this->DatabaseWrite->bind(':ContactEmail', $EditedPatientDetails['ContactEmail']);
        $this->DatabaseWrite->bind(':ContactDetailsID', $EditedPatientDetails['ContactDetailsID']);

        try {
            return $this->DatabaseWrite->execute();
        } catch (\PDOException $ex) {
            echo $ex;
        }


        //update patient contact id
    }

    public function addPatientRecord($NewPatientDetails) {

        $returnedContactDetailsID = null;

        //This needs to be a transaction!
        //Add contact details first and get back the ID for that insert.

        $this->DatabaseWrite->query('INSERT INTO contact_details_table ('
                . 'ContactEmail, ContactPhone, ContactMobile,'
                . 'ContactAddressLine1, ContactAddressLine2, ContactTown, ContactCounty, ContactPostCode)'
                . ' VALUES(:ContactEmail,:ContactPhone,:ContactMobile,:ContactAddressLine1,:ContactAddressLine2,:ContactTown,:ContactCounty,:ContactPostCode)');


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
                . 'PatientTitle, PatientFirstName, PatientLastName, PatientDOB, PatientGender, PatientBloodType, PatientNHSNumber, ContactDetailsID ) '
                . 'VALUES (:PatientTitle,:PatientFirstName,:PatientLastName,'
                . ':PatientDOB,:PatientGender,:PatientBloodType,:PatientNHSNumber,:ContactDetailsID) ');

        $this->DatabaseWrite->bind(':PatientTitle', $NewPatientDetails['PatientTitle']);
        $this->DatabaseWrite->bind(':PatientFirstName', $NewPatientDetails['PatientFirstName']);
        $this->DatabaseWrite->bind(':PatientLastName', $NewPatientDetails['PatientLastName']);
        $this->DatabaseWrite->bind(':PatientDOB', $NewPatientDetails['PatientDOB']);
        $this->DatabaseWrite->bind(':PatientGender', $NewPatientDetails['PatientGender']);
        $this->DatabaseWrite->bind(':PatientBloodType', $NewPatientDetails['PatientBloodType']);
        $this->DatabaseWrite->bind(':PatientNHSNumber', $NewPatientDetails['PatientNHSNumber']);
        $this->DatabaseWrite->bind(':ContactDetailsID', $returnedContactDetailsID);

        return $this->DatabaseWrite->execute();
    }

}
