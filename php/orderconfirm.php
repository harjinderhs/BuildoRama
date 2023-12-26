<?php

    //include connection file 
    include "dbconnect.php";

    $prodId = $_POST['selected_prod'];
    $quantity = $_POST['quantity'];
    $memNum = $_POST['mem_num'];

    $param = "";

    $availQuantity = 0;
    $price = 0;

    $saleCount = 0;

    echo "Hello ".$memNum;


    $prodSql = "SELECT StockQuantity, Price FROM products WHERE ProductID = '$prodId' ";
    $prodResult = mysqli_query($conn, $prodSql);

    while ($prod = mysqli_fetch_array($prodResult)) {
        $availQuantity = $prod['StockQuantity'];
        $price = $prod['Price'];
    }

    $saleSql = "SELECT SaleID FROM sales";
    $saleResult = mysqli_query($conn, $saleSql);
    $saleCount = $saleResult->num_rows;

    $buyerSql = "SELECT MembershipNumber FROM customers WHERE MembershipNumber = '$memNum' ";
    $buyerResult = mysqli_query($conn, $buyerSql);
    


    if($availQuantity < $quantity ) {
        $param = "<p style='color: red;'> Don't have asked Stock, please reduce the quantity! </p>";
    }
    else if ( $buyerResult->num_rows <=0) {

        $param = "<p style='color: red;'> User Not Found, please subscribe to us first!. </p>";

    }
    else {

        $param =  "<p style='color: green;'> Order has been Successfully placed. </p>";

        $saleId = $saleCount++;

        date_default_timezone_set('America/Toronto');
        $saleDate = date('Y-m-d H:i:s', time()); 

        $totalAMt = $price * $quantity;

        echo $totalAMt;

        echo $saleId;

        $sqlInsert = "INSERT INTO buildorama.sales (SaleID, ProductID, CustomerMemNum, SaleDate, Quantity, TotalAmount) 
        VALUES(?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($conn);

        if( ! mysqli_stmt_prepare($stmt, $sqlInsert)) {
        die(mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "iissii",
                                $saleId,
                                $prodId,
                                $memNum,
                                $saleDate,
                                $quantity,
                                $totalAMt);

        mysqli_stmt_execute($stmt);


        $sqlProdUpdate = "UPDATE products SET StockQuantity = StockQuantity - '$quantity' WHERE ProductID = '$prodId' ";

        if ($conn->query($sqlProdUpdate) === TRUE) {
            echo "Sale table updated successfully. ";
        } else {
            echo "Error updating sale table: " . $conn->error;
        }

    }

    mysqli_close($conn);

    $encodedData = urlencode($param);

    header("Location: ../purchase.php?data=$encodedData");
    exit();
?>