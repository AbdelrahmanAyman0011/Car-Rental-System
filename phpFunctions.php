<?php

function emailUsed($con,$mail){
    
    $sql = "SELECT * FROM customer WHERE Email = ?;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt,$sql)){ // -- > run this sql e
        header("location:Signup.html"); // if sql statement has any errors
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $mail);
    mysqli_stmt_execute($stmt);


    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row; // what we want to login (the data)
    }
    else{ // what we want to register (not finding a used email)
        $result = false;
        return $result;
    }


    mysqli_stmt_close($stmt);
}

function createCustomer($con, $fname, $lname, $mail, $phone, $gender, $country, $city, $street, $pass){
    
    $sql = "INSERT INTO customer (Fname,Lname,Gender,Country,City,Street,PhoneNum,Email,`Password`)
    VALUES (?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt,$sql)){ // -- > run this sql e
        header("location:frontSignup.php?error=somethingWrong"); // if sql statement has any errors
        exit();
    }


    $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sssssssss", $fname,$lname,$gender,$country,$city,$street,$phone,$mail,$hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:frontSignup.php");
    $result = true;
    return $result;
}

function loginUser($con,$mail,$pass) {

    $emailUsed = emailUsed($con,$mail);

    if($emailUsed == false){
        header("location:frontLogin.php?error=emailNotFound");
        return false;
    }
 
    $pwdHashed = $emailUsed["Password"];
    $checkPwd = password_verify($pass, $pwdHashed);
    if($checkPwd == false){
        header("location:frontLogin.php?error=invalidPassword");
        return false;
    }
    else if ($checkPwd == true){
    session_start();
        $_SESSION["customerId"] = $emailUsed["Customer_ID"];
        $_SESSION["customerName"] = $emailUsed["Fname"];
        header("location:CustomerHome.html");
        exit();
    }

}


function registerCar($con,$name,$price,$model,$color,$plateID,$officeID,$state){
    $sql = "INSERT INTO car (Plate_ID,Car_Name,Model,Color,Price,Office_ID,`State`)
    VALUES (?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt,$sql)){ // -- > run this sql e
        header("location:carRegistration.html"); // if sql statement has any errors
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssss",$plateID,$name,$model,$color,$price,$officeID,$state);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:frontSignup.php");
    $result = true;
    return $result;
}