<?php

namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/views/View.php";

class patientsView extends View {

    public function mainpage() {
        ?>
        <h1>Patients</h1>
        <br>
        <a href="?action=viewpatients">view all patients</a>
        <br>
        <a href="?action=addnewpatient">add patient</a>
        <br>
        <a href="?action=searchpatients">search patients</a>
        <?php
    }

    public function viewpatients($PatientRecords) {
        echo ' in patients';

        print_r($PatientRecords);
    }

    public function searchpatients($Menu = true, $PatientSearchResult = null) {

        if ($Menu) { 
            ?>


            <div id="searchpatientWrapper">

                <h1>Search patients</h1>
                <br>

                <form action="?searchpatients">

                    <label>Search by first name</label>
                    <input type='text' name='PatientFirstName' value="" class="textbox">
                    <label>Search by last name</label>
                    <input type='text' name='PatientLastName' value="" class="textbox">
                    <label>Search by NHS number</label>
                    <input type='text' name='PatientNHSNumber' value="" class="textbox">
                    <label>Search by DOB</label>
                    <input type='date' name='PatientDOB' value="" class="textbox">
                </form>
            </div>

        <?php } else { //Search patients result html follows  ?>

            <div id="searchpatientWrapper">
                search results;
            </div>

            <?php
        }
    }

    public function addnewpatient() {
        ?>
        <div id="addnewpatientWrapper">
            <h1>Add new patient</h1>

            <form action="?action=addnewpatient" method="POST">
                <div class="PatientDetailsContainer">
                    <h3>Patient Details</h3>
                    <label>Patients first name:</label>
                    <input type='text' name='PatientFirstName' value="" class="textbox">
                    <br>
                    <label>Patients last name:</label>
                    <input type='text' name='PatientLastName' value="" class="textbox">
                    <br>
                    <label>Patients date of birth:</label>
                    <input type="date" name="PatientDOB" class="textbox">
                    <br> 
                    <label>Patients NHS number:</label>
                    <input type="text" name="PatientNHSNumber" class="textbox">
                    <br> 
                    <label>Patients Gender</label>
                    <select name="PatientGender" >
                        <option>Male</option>
                        <option>Female</option>
                        <option>Asexual</option>
                        <option>Female to male trans man</option>
                        <option>Female to male transgender man</option>
                        <option>Female to male transsexual man</option>
                        <option>Gender neutral</option>
                        <option>Hermaphrodite</option>
                        <option>Male to female trans woman</option>
                        <option>Male to female transgender woman</option>
                        <option>Male to female transsexual woman</option>
                    </select>
                    <br>
                    <label>Blood Type</label>
                    <select name="PatientBloodType" >
                        <option>O-positive</option>
                        <option>O-negative</option>
                        <option>A-positive</option>
                        <option>A-negative</option>
                        <option>B-positive</option>
                        <option>B-negative</option>
                        <option>AB-positive</option>
                        <option>AB-negative</option>
                    </select>

                </div>

                <div class="ContactDetailsContainer">
                    <h3>Patient Contact details</h3>

                    <label>Title</label>
                    <select name="ContactTitle">
                        <option>Mr</option>
                        <option>Mrs</option>
                        <option>Miss</option>
                        <option>DR</option>
                    </select>

                    <label>First name</label>
                    <input type='text' name='ContactFirstName' value="" class="textbox">
                    <br>
                    <label>Last name</label>
                    <input type='text' name='ContactLastName' value="" class="textbox">
                    <br>
                    <label>Phone</label>
                    <input type='number' name='ContactPhone' value="" class="textbox">
                    <br>
                    <label>Mobile</label>
                    <input type='number' name='ContactMobile' value="" class="textbox">
                    <br>
                    <label>Email</label>
                    <input type='email' name='ContactEmail' value="" class="textbox">
                    <br>
                    <label>Address line 1</label>
                    <input type='text' name='ContactAddressLine1' placeholder="" class="textbox">
                    <br>
                    <label>Address line 2</label>
                    <input type='text' name='ContactAddressLine2' placeholder="" class="textbox">
                    <br>
                    <label>Town</label>
                    <input type='text' name='ContactTown' placeholder="" class="textbox">
                    <br>
                    <label>County</label>
                    <input type='text' name='ContactCounty' placeholder="" class="textbox">
                    <br>
                    <label>Post code</label>
                    <input type='text' name='ContactPostCode' placeholder="" class="textbox">
                    <br>
                </div>

                <div class="clearDiv">
                    <br>
                    <input type="submit" value="Click To Add Patient Record" class="button"/>
                    <br>
                </div>
            </form>



        </div>



        <?php
    }

}
