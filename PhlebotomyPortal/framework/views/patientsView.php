<?php

namespace PhlebotomyPortal;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/../framework/views/View.php";

class patientsView extends View {

    public function mainpage() {
        ?>
        <h1>Patients</h1>
        <br>
        <!--        <a href="?action=viewpatients">view all patients</a>
                <br>-->
        <a href="?action=addnewpatient">add patient</a>
        <br>
        <a href="?action=searchpatients">search patients</a>
        <?php
    }

    public function editpatient($PatientRecord) { 
        ?>
        <form action="?action=editpatient" method="POST">
            
            <div class="PatientDetailsContainer">
               
                <h2>Patient details.</h2>
                <br>
                <label>Title:</label> 
                <select name="PatientTitle" selected="<?php echo $PatientRecord['PatientTitle']; ?>">
                    <option>Mr</option>
                    <option>Mrs</option>
                    <option>Miss</option>
                    <option>DR</option>
                </select>

                <label>First name:</label> 
                <input type='text' name='PatientFirstName' value="<?php echo $PatientRecord['PatientFirstName']; ?>" class="textbox">
                <br>
                <label>Last name:</label>
                <input type='text' name='PatientLastName' value="<?php echo $PatientRecord['PatientLastName']; ?>" class="textbox">
                <br>
                <label>Date of birth:</label> 
                <input type='date' name='PatientDOB' value="<?php echo $PatientRecord['PatientDOB']; ?>" class="textbox">
                <br>
                <label>Gender:</label> 
                <select name="PatientGender" option 
                        value="<?php echo $PatientRecord['PatientGender']; ?>" >
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
                <label>Blood type:</label> 
                <select name="PatientBloodType" selected="<?php echo $PatientRecord['PatientBloodType']; ?>" >
                    <option>O-positive</option>
                    <option>O-negative</option>
                    <option>A-positive</option>
                    <option>A-negative</option>
                    <option>B-positive</option>
                    <option>B-negative</option>
                    <option>AB-positive</option>
                    <option>AB-negative</option>
                </select>
                <br>
                <label>NHS Number:</label> 
                <input type='text' name='PatientNHSNumber' value="<?php echo $PatientRecord['PatientNHSNumber']; ?>" class="textbox">
                <br>
            </div>

            <div class="ContactDetailsContainer">
                <h2>Contact details</h2>
                <label>Phone:</label>
                <input type='number' name='ContactPhone' value="<?php echo $PatientRecord['ContactPhone']; ?>" class="textbox">
                <br>
                <label>Mobile:</label>
                <input type='number' name='ContactMobile' value="<?php echo $PatientRecord['ContactMobile']; ?>" class="textbox">
                <br>
                <label>Email:</label>
                <input type='email' name='ContactEmail' value="<?php echo $PatientRecord['ContactEmail']; ?>" class="textbox">
                <br>
                <h3>Address</h3>
                <label>Address line 1:</label>
                <input type='text' name='ContactAddressLine1' value="<?php echo $PatientRecord['ContactAddressLine1']; ?>" class="textbox">
                <br>
                <label>Address line 2:</label>
                <input type='text' name='ContactAddressLine2' value="<?php echo $PatientRecord['ContactAddressLine2']; ?>" class="textbox">
                <br>
                <label>Town:</label>
                <input type='text' name='ContactTown' value="<?php echo $PatientRecord['ContactTown']; ?>" class="textbox">
                <br>
                <label>County:</label>
                <input type='text' name='ContactCounty' value="<?php echo $PatientRecord['ContactCounty']; ?>" class="textbox">
                <br>
                <label>Post code:</label>
                <input type='text' name='ContactPostCode' value="<?php echo $PatientRecord['ContactPostCode']; ?>" class="textbox">
                <br>
            </div>
            
              <div class="clearDiv">
                    <br>
                     <input type="hidden" name="PatientID" value="<?php echo $PatientRecord['PatientID'] ?>">
                     <input type="hidden" name="ContactDetailsID" value="<?php echo $PatientRecord['ContactDetailsID'] ?>">
                    <input type="submit" value="SAVE" class="button"/>
                    <br>
                </div>
        </form>
        <?php
    }

    public function viewpatient($PatientRecord, $PatientAppointments = null) {
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

        <div class="ContactDetailsContainer">
            <h2>Contact details</h2>
            <label>Phone:</label><text><?php echo $PatientRecord['ContactPhone'] ?></text>
            <br>
            <label>Mobile:</label><text><?php echo $PatientRecord['ContactMobile'] ?></text>
            <br>
            <label>Email:</label><text><?php echo $PatientRecord['ContactEmail'] ?></text>
            <br>
            <h3>Address</h3>
            <label>Address line 1:</label><text><?php echo $PatientRecord['ContactAddressLine1'] ?></text>
            <br>
            <label>Address line 2:</label><text><?php echo $PatientRecord['ContactAddressLine2'] ?></text>
            <br>
            <label>Town:</label><text><?php echo $PatientRecord['ContactTown'] ?></text>
            <br>
            <label>County:</label><text><?php echo $PatientRecord['ContactCounty'] ?></text>
            <br>
            <label>Post code:</label><text><?php echo $PatientRecord['ContactPostCode'] ?></text>
            <br>
        </div>
        <?php
    }

    public function searchpatients($Menu = true, $PatientSearchResult = null) {

        if ($Menu) {
            ?>

        <div class="centerbox">
            <div id="searchpatientWrapper">

                <h1>Search patients</h1>
                <br>

                <form action="" method="POST">


                    <label>Search by first name</label>
                    <input type='text' name='PatientFirstName' value="" class="textbox">
                    <br>
                    <label>Search by last name</label>
                    <input type='text' name='PatientLastName' value="" class="textbox">
                    <br>
                    <label>Search by NHS number</label>
                    <input type='text' name='PatientNHSNumber' value="" class="textbox">
                    </div>
                    <label>Search by DOB</label>
                    <input type='date' name='PatientDOB' value="" class="textbox">
                    <br>
                    <input type="submit"   class="button"/>
                </form>
            </div>
            </div>

        <?php } else { //Search patients result html follows   ?>

            <div id="searchpatientWrapper">


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

                echo '<tr ><td><a href="patients?action=viewpatient&params=' . $PatientRecord['PatientID'] . '">' . $PatientRecord['PatientTitle'];
                echo '</td><td><a href="patients?action=viewpatient&params=' . $PatientRecord['PatientID'] . '">' . $PatientRecord['PatientFirstName'];
                echo '</td><td><a href="patients?action=viewpatient&params=' . $PatientRecord['PatientID'] . '">' . $PatientRecord['PatientLastName'];
                echo '</td><td><a href="patients?action=viewpatient&params=' . $PatientRecord['PatientID'] . '">' . floor((time() - strtotime($PatientRecord['PatientDOB'])) / 31556926);
                echo '</td><td><a href="patients?action=viewpatient&params=' . $PatientRecord['PatientID'] . '">' . $PatientRecord['PatientGender'];
                echo '</td><td><a href="patients?action=viewpatient&params=' . $PatientRecord['PatientID'] . '">' . $PatientRecord['PatientDOB'];
                echo '</td><td><a href="patients?action=viewpatient&params=' . $PatientRecord['PatientID'] . '">' . $PatientRecord['PatientNHSNumber'] . '</td></tr>';
            }
            ?>

                    </table>
                </div>


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
                    <label>Patient title</label>
                    <select name="PatientTitle">
                        <option>Mr</option>
                        <option>Mrs</option>
                        <option>Miss</option>
                        <option>DR</option>
                    </select>
                    <label>Patients first name:</label>
                    <input type='text' name='PatientFirstName' value="" class="textbox">
                    <br>
                    <label>Patients last name:</label>
                    <input type='text' name='PatientLastName' value="" class="textbox">
                    <br>
                    <label>Patients date of birth:</label>
                    <input type="date" name="PatientDOB" value="null" class="textbox">
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
