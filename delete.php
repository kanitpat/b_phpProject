<?php

$strCustomerID = $_GET['CustomerID'];
    $sql = "DELETE FROM customer
			WHERE CustomerID = '".$strCustomerID."' ";

    $query = mysqli_query($conn, $sql);
