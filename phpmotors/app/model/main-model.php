<?php

function getClassifications()
{
    // Create a connection object from the phpmotors connection function
    $db = Connection::connect();
    /*
    // The SQL statement to be used with the database
    $sql = 'SELECT classificationName FROM carclassification ORDER BY classificationName ASC';
    // The next line creates the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line runs the prepared statement
    $stmt->execute();
    // The next line gets the data from the database and
    // stores it as an array in the $classifications variable
    */
    $classifications = new Connection();
    $classifications = $classifications->select("carclassification", ['classificationName'])
        ->orderBy(['classificationName' => 'ASC'])->execute()->fetchAll();
    // The next line sends the array of data back to where the function
    // was called (this should be the controller)
    return $classifications;
}
