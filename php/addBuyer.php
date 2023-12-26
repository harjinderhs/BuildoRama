<?php

    //include connection file 
    include "dbconnect.php";
    include_once('../fpdf186/fpdf.php');

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $memberNum = explode('@', $email);


    $sqlInsert = "INSERT INTO customers (MembershipNumber, FirstName, LastName, Address, PhoneNumber, Email) 
                    VALUES(?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);

    if( ! mysqli_stmt_prepare($stmt, $sqlInsert)) {
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssssis",
                                    $memberNum[0],
                                    $firstName,
                                    $lastName,
                                    $address,
                                    $phone,
                                    $email );

    mysqli_stmt_execute($stmt);


    $param = "<p style='color: Green;'> Registeration Successfully. <br> Please Note your Membership Number: <b> ".$memberNum[0]."</b> </p>";

    $encodedData = urlencode($param);

    header("Location: ../user_services.php?data=$encodedData");
    exit();

    mysqli_close($conn);

?>