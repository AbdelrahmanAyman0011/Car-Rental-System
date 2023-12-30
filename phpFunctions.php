<?php

function emailUsed($con,$mail){
    
    $sql = "SELECT * FROM customer WHERE Email = ?;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt,$sql)){ // -- > run this sql e
        header("Location:Signup.html?error=stmtfailed"); // if sql statement has any errors
    }

    mysqli_stmt_bind_param($stmt, "s", $mail);
    mysqli_stmt_execute($stmt);


    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row; // what we want to login (the data)
    }
    else{ // what we want to register (not finding a used email)
        $result =false;
        return $result;
    }


    mysqli_stmt_close($stmt);
}

function createCustomer($con, $fname, $lname, $mail, $phone, $gender, $country, $city, $street, $pass){
    
    $sql = "INSERT INTO customer (Fname,Lname,Gender,Country,City,Street,PhoneNum,Email,`Password`)
    VALUES (?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt,$sql)){ // -- > run this sql e
        header("Location:Signup.html?error=stmtfailed"); // if sql statement has any errors
    }


    $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);


    mysqli_stmt_bind_param($stmt, "sssssssss", $fname,$lname,$gender,$country,$city,$street,$phone,$mail,$hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location:index.html?error=none");
    exit();
}