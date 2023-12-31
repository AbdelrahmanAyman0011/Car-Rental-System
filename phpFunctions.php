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
        header("location:carRegistration.html?error=somethingWrong"); // if sql statement has any errors
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssss",$plateID,$name,$model,$color,$price,$officeID,$state);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:carRegistration.html");
    $result = true;
    return $result;
}

function registerOffice($con,$capacity,$location){
    
    $sql = "INSERT INTO office (Capacity,`Location`)
    VALUES (?,?);";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt,$sql)){ // -- > run this sql e
        header("location:officeRegistration.php"); // if sql statement has any errors
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss",$capacity,$location);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:officeRegistration.php");
    $result = true;
    return $result;
}

function displayOffices($con) {
    $sql = "SELECT Office_ID,`Location` FROM office;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt,$sql)){ // -- > run this sql e
        header("location:Signup.html"); // if sql statement has any errors
        exit();
    }

    mysqli_stmt_execute($stmt);


    $resultData = mysqli_stmt_get_result($stmt);
    $officeIds = [];

    while ($row = mysqli_fetch_assoc($resultData)){
        $officeIds[]=$row;
    }
    mysqli_stmt_close($stmt);


    return $officeIds;


}

function displayCars1($con,$officeID) {
    $sql = "SELECT Car_Name FROM car WHERE Office_ID =?;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt,$sql)){ // -- > run this sql e
        header("location:Signup.html"); // if sql statement has any errors
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $officeID);
    mysqli_stmt_execute($stmt);


    $resultData = mysqli_stmt_get_result($stmt);
    $carNames = [];

    while ($row = mysqli_fetch_assoc($resultData)){
        $carNames[]=$row['Car_Name'];
    }
    mysqli_stmt_close($stmt);


    return $carNames;
}

function displayCars($con,$officeID) {
$sql = "SELECT Car_Name FROM car WHERE Office_ID =? AND State = 1;";
$stmt = mysqli_stmt_init($con);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: Signup.html");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $officeID);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);
$carNames = [];

    while ($row = mysqli_fetch_assoc($resultData)) {
        $carNames[] = $row['Car_Name'];
    }
    mysqli_stmt_close($stmt);


    return $carNames;
}