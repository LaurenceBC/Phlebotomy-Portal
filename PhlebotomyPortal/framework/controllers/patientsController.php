<?php

namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/controllers/Controller.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/views/patientsView.php";
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/models/patientsModel.php";

class patientsController extends Controller {

    private $ControllerView = null;
    private $ControllerModel = null;
    public $Title = "Patients";

    //This is the main 'page' shown if no or main is passed as ?action
    protected function main() {
        $this->ControllerView->mainpage();
    }

    protected function viewpatients() {
        if (!$this->ACL->hasPermission('VIEWPATIENTS', $this->UserPermissions)) {
            $this->ControllerView->errorMessage('ACCESSDENIED');
        } else {
            $this->ControllerView->viewpatients($this->ControllerModel->getPatientsRecords());
        }
    }

    public function addnewpatient() {
        //check they have permissions
        if (!$this->ACL->hasPermission('ADDPATIENT', $this->UserPermissions)) {
            $this->ControllerView->errorMessage('ADDPATIENTDENIED', 'patients');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Pass post array into model and get back response.
                //If the record was added then show prompt.
                if ($this->ControllerModel->addPatientRecord($_POST)) {
                    $this->ControllerView->prompt('SUCCESSFULRECORDADDED', 'patients');
                } else {
                    $this->ControllerView->errorMessage('ERROR', 'patients');
                }
            } else {
                $this->ControllerView->addnewpatient();
            }
        }
    }

    public function editpatient($PatientID) {

        if (!$this->ACL->hasPermission('EDITPATIENT', $this->UserPermissions)) {
            $this->ControllerView->errorMessage('EDITPATIENTDENIED', 'patients');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($this->ControllerModel->editPatientRecord($_POST)) {
                    $this->ControllerView->prompt('SUCCESSFULRECORDEDITED', 'patients');
                } else {
                    $this->ControllerView->errorMessage('ERROR');
                }
            } else {

                $this->ControllerView->editpatient($this->ControllerModel->getSinglePatientRecord($PatientID));

                if ($this->ACL->hasPermission('DELETEPATIENT', $this->UserPermissions)) {
                    echo '<a href="patients?action=deletepatient&params=' . $PatientID . '"> Delete </a>';
                }
            }
        }
    }

    public function deletepatient($PatientID = null) {
        if (!$this->ACL->hasPermission('DELETEPATIENT', $this->UserPermissions)) {
            $this->ControllerView->errorMessage('DELETEPATIENTDENIED', 'patients');
        } else {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($this->ControllerModel->deletePatientRecord($_POST['params'])) {
                    $this->ControllerView->prompt('PATIENTRECORDDELETED', 'patients');
                } else {
                    $this->ControllerView->errorMessage('NOSEARCHPARAMETERS', 'patients');
                }
            } else {
                $this->ControllerView->errorMessage('NOSEARCHPARAMETERS', 'patients');
            }
        }
    }

    public function searchpatients($Params = null) {
        if (!$this->ACL->hasPermission('SEARCHPATIENT', $this->UserPermissions)) {
            $this->ControllerView->errorMessage('SEARCHPATIENTDENIED', 'patients');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if (array_filter($_POST)) {
                    $passedParams = array();

                    array_push($passedParams, filter_var($_POST['PatientFirstName'], FILTER_SANITIZE_STRING));
                    array_push($passedParams, filter_var($_POST['PatientLastName'], FILTER_SANITIZE_STRING));
                    array_push($passedParams, filter_var($_POST['PatientNHSNumber'], FILTER_SANITIZE_STRING));
                    array_push($passedParams, filter_var($_POST['PatientDOB'], FILTER_SANITIZE_STRING));

                    $this->ControllerView->searchpatients(false, $this->ControllerModel->getPatientsRecords($passedParams));
                } else {
                    $this->ControllerView->errorMessage('NOSEARCHPARAMETERS', 'patients?action=searchpatients');
                }
            } else {
                $this->ControllerView->searchpatients(true);
            }
        }
    }

    public function viewpatient($PatientID = null) {
        if (!$this->ACL->hasPermission('VIEWPATIENTS', $this->UserPermissions)) {
            $this->ControllerView->errorMessage('ACCESSDENIED', 'patients');
        } else {

            $this->ControllerView->viewpatient($this->ControllerModel->getSinglePatientRecord($PatientID));
            if ($this->ACL->hasPermission('EDITPATIENT', $this->UserPermissions)) {
                //echo '<a href="patients?action=editpatient&params=' . $PatientID . '"> Edit Record </a>';

                echo '<form action="patients?action=editpatient" method="POST">'
                . '<input type="hidden" name="action" value="deletepatient">'
                . '<input type="hidden" name="params" value="' . $PatientID . '">'
                . '<input type="submit" value="EDIT"  class="button"/></form>';
            }
            if ($this->ACL->hasPermission('DELETEPATIENT', $this->UserPermissions)) {
                echo '<form action="patients?action=deletepatient" method="POST">'
                . '<input type="hidden" name="action" value="deletepatient">'
                . '<input type="hidden" name="params" value="' . $PatientID . '">'
                . '<input type="submit" value="DELETE"  class="button"/></form>';
            }
        }
    }

    public function __construct($Route) {
        parent::__construct();
        $this->setup($Route);
        $this->ControllerView = new \PhlebotomyPortal\patientsView();
        $this->ControllerModel = new \PhlebotomyPortal\patientsModel();
    }

    //Add anything that needs setting up in class here
    private function setup($Route) {
        $this->Route = $Route;
        
        
    }

}
