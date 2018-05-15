
<?php


namespace PhlebotomyPortal;

$DatabaseInsertObject = new \PhlebotomyPortal\DatabaseInsert;


//This is the query you want the object to execute
//For binding values just add : and a placeholder name.
$DatabaseInsertObject->query("INSERT INTO testingtable VALUES (:bindedvalue)");

//Then add the values you want to bind. 
//SQL Injection is prevented at this stage.
$DatabaseInsertObject->bind(':bindedvalue1', "testdata");  

//Execute
$DatabaseInsertObject->execute();


//Getting records
$DatabaseRetrieveObject = new \PhlebotomyPortal\DatabaseRetrieve;
$DatabaseRetrieveObject->query("SELECT * FROM testingtable WHERE data = :bindedvalue1");
$DatabaseRetrieveObject->bind(':bindedvalue1', "testdata"); 

//Either a single record returned
$SignleRecordData = $DatabaseRetrieveObject->getSingleRecord();

//Or record set (which can still be only one record)
$RecordSet = $DatabaseRetrieveObject->getResultSet();



?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
