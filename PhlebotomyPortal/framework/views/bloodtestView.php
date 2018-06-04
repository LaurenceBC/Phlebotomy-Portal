<?php

namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/views/View.php";

class bloodtestView extends View {

    public function mainpage() {
        ?>
        <div class="centerbox">

            <h1> Blood tests</h1>
            <a href="?action=request">Request</a>
            <a href="?action=request">View requests</a>
            <a href="?action=request">Request appointment</a>

        </div>


        <?php
    }

    public function testrequest($PatientRecord, $GPDetails, $BloodTests = null) {
        ?>
        <div class="PatientDetailsContainer">
            <h2>Patient details.</h2>
            <br>
            <label>Title:</label><text><?php echo $PatientRecord['PatientTitle'] ?></text>
            <br>
            <label>First name:</label><text><?php echo $PatientRecord['PatientFirstName'] ?></text>
            <br>
            <label>First name:</label><text><?php echo $PatientRecord['PatientLastName'] ?></text>
            <br>
            <label>Date of birth:</label><text><?php echo $PatientRecord['PatientDOB'] ?></text>
            <br>
            <label>Age:</label><text><?php echo floor((time() - strtotime($PatientRecord['PatientDOB'])) / 31556926); ?></text>
            <br>
            <label>Gender:</label><text><?php echo $PatientRecord['PatientGender'] ?></text>
            <br>
            <label>Blood type:</label><text><?php echo $PatientRecord['PatientBloodType'] ?></text>
            <br>
            <label>NHS Number:</label><text><?php echo $PatientRecord['PatientNHSNumber'] ?></text>
            <br>
        </div>

        <div class="GPDetails">

        </div>


        <div class="RequestTest">

        </div>

        <?php
    }

    public function requestselectpatient() {
        ?>

        <div class="centerbox">

            <h1>Request blood test</h1>
            <h2>Search for patient</h2>

            <form action="" method="POST">
                <label>Search by first name</label>
                <input type='text' name='PatientFirstName' value="" class="textbox">
                <br>
                <label>Search by last name</label>
                <input type='text' name='PatientLastName' value="" class="textbox">
                <br>
                <label>Search by NHS number</label>
                <input type='text' name='PatientNHSNumber' value="" class="textbox">
                <br>
                <label>Search by DOB</label>
                <input type='date' name='PatientDOB' value="" class="textbox">
                <br>
                <input type="submit"   class="button"/>
            </form>

        </div>



        <?php
    }

    public function patientsearchresults($PatientSearchResult) {
        ?>
        <div id="patientsearchresults">

            <table>
                <h2>Results</h2>
                <th>Title</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>NHS Number</th>

        <?php
        foreach ($PatientSearchResult as $PatientRecord) {

            echo '<tr ><td><a href="bloodtest?action=testrequest' . $PatientRecord['PatientID'] . '">' . $PatientRecord['PatientTitle'];
            echo '</td><td><a href="bloodtest?action=testrequest' . $PatientRecord['PatientID'] . '">' . $PatientRecord['PatientFirstName'];
            echo '</td><td><a href="bloodtest?action=testrequest' . $PatientRecord['PatientID'] . '">' . $PatientRecord['PatientLastName'];
            echo '</td><td><a href="bloodtest?action=testrequest' . $PatientRecord['PatientID'] . '">' . floor((time() - strtotime($PatientRecord['PatientDOB'])) / 31556926);
            echo '</td><td><a href="bloodtest?action=testrequest' . $PatientRecord['PatientID'] . '">' . $PatientRecord['PatientGender'];
            echo '</td><td><a href="bloodtest?action=testrequest' . $PatientRecord['PatientID'] . '">' . $PatientRecord['PatientDOB'];
            echo '</td><td><a href="bloodtest?action=testrequest' . $PatientRecord['PatientID'] . '">' . $PatientRecord['PatientNHSNumber'] . '</td></tr>';
        }
        ?>

            </table>
        </div>
        <?php
    }

}
