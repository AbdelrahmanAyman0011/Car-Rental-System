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

function get_cars($con, $customer_ID) {
    $sql = "SELECT R.car_ID, car.Car_Name FROM Reserve R
            JOIN car ON R.car_ID = car.car_ID
            JOIN customer C ON R.customer_Id = C.customer_ID
            WHERE R.customer_Id = ?
            GROUP BY R.customer_Id, R.car_ID, R.S_Date;";

    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Handle the error, for example, redirect to an error page
        header("location: error.html");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $customer_ID);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    $cars = array();
    while ($row = mysqli_fetch_assoc($resultData)) {
        $cars[] = array(
            'car_ID' => $row['car_ID'],
            'car_Name' => $row['Car_Name']
        );
    }

    mysqli_stmt_close($stmt);

    return $cars;
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
        $_SESSION['cars'] = get_cars($con, $emailUsed["Customer_ID"]);
        header("location:CustomerHome.html");
        exit();
    }

}


function registerCar($con,$name,$price,$model,$color,$plateID,$officeID,$state,$targetFile){
    $sql = "INSERT INTO car (Plate_ID,Car_Name,Model,Color,Price,Office_ID,`State`,Img_Path)
    VALUES (?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt,$sql)){ // -- > run this sql e
        header("location:carRegistration.html?error=somethingWrong"); // if sql statement has any errors
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssss",$plateID,$name,$model,$color,$price,$officeID,$state,$targetFile);
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


function displayCars($con,$officeID) {
$sql = "SELECT Car_ID, Car_Name FROM car WHERE Office_ID =? AND State = 1;";
$stmt = mysqli_stmt_init($con);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $officeID);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);
$carNames = [];

    while ($row = mysqli_fetch_assoc($resultData)) {
        $carNames[] = $row;
    }
    mysqli_stmt_close($stmt);


    return $carNames;
}




function displayPrice($con,$selectedValue) {
    $sql = "SELECT Price FROM car WHERE Car_ID = ?;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $selectedValue);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);
    $carPrice = null;
    
        while ($row = mysqli_fetch_assoc($resultData)) {
            $carPrice = $row['Price'];
        }
    
    
        return $carPrice;
}




function displayCard($con, $customerId){
    $sql = "SELECT Card_ID FROM payment_card WHERE Customer_ID = ?;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt,$sql)){ // -- > run this sql e
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $customerId);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);
    $cardNums = [];
    
        while ($row = mysqli_fetch_assoc($resultData)) {
            $cardNums[] = array('Card_ID' => $row['Card_ID']);
        }
        mysqli_stmt_close($stmt);
    
    
        return $cardNums;
}




function paymentCard($con, $cardNumber, $expirationMonth, $expirationYear, $cvv, $customer_ID) {
    // Combine month and year into a date string
    $formattedExpirationDate = "20{$expirationYear}-{$expirationMonth}-01";

    $sql = "INSERT INTO payment_card (Card_ID, CVV, Ex_Date, Customer_ID)
            VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:PaymentCard.html?error=somethingWrong");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $cardNumber, $cvv, $formattedExpirationDate, $customer_ID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:PaymentCard.html");
    $result = true;
    return $result;
}


function reserve($con,$customerId,$carId,$sDate,$eDate){
    $sql = "INSERT INTO reserve (Customer_ID, Car_ID, S_Date, En_Date)
            VALUES (?, ?, ?, ?);";

$stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:ReserveCustomer.php?error=somethingWrong");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssss", $customerId, $carId, $sDate, $eDate);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_error($stmt)) {
        echo "SQL Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);

    session_start();
    $_SESSION['cars'] = get_cars($con, $_SESSION['customerId']);
    session_write_close();

    $result = true;
    return $result;

}

function changeState($con,$carId,$state){

    $sql = "UPDATE car SET State = ? WHERE Car_ID = ?;";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:ReserveCustomer.php?error=somethingWrong");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $state, $carId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);    
    $result = true;
    return $result;


}


function paymentOperation($con,$sDate,$cardNum,$customerId,$price){
    $sql = "INSERT INTO payment_operation (`Date`, Card_ID, Customer_ID, Price) VALUES (?, ?, ?, ?);";

$stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:ReserveCustomer.php?error=somethingWrong");
        exit();
    }
    var_dump($stmt);
    mysqli_stmt_bind_param($stmt, "ssss", $sDate, $cardNum, $customerId, $price);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $result = true;
    return $result;
}

function endDate($con,$carId){
    $sql = "SELECT En_Date FROM reserve WHERE Car_ID = ?;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt,$sql)){ // -- > run this sql e
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $carId);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);
    $endDate = null;
    
        while ($row = mysqli_fetch_assoc($resultData)) {
            $endDate = $row['En_Date'];
        }
    
    
        return $endDate;

}


    function ReturnCar($con,$carId) {

    $sql = "DELETE FROM reserve WHERE Car_ID = ?;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt,$sql)){ // -- > run this sql e
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $carId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    session_start();
    $_SESSION['cars'] = get_cars($con, $_SESSION['customerId']);
    session_write_close();

    $result = true;
    return $result;

}


function getCarsHTML($con) {
    $sql = "SELECT Car_ID, Car_Name, Model, Color, Img_Path FROM Car WHERE State = 1";

    $result = mysqli_query($con, $sql);

    $carsHTML = '';

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $carsHTML .= '<tr>';
            $carsHTML .= '<td><img src="' . $row['Img_Path'] . '" alt="Car Photo"></td>';
            $carsHTML .= '<td>' . $row['Car_Name'] . '</td>';
            $carsHTML .= '<td>' . $row['Model'] . '</td>';
            $carsHTML .= '<td>' . $row['Color'] . '</td>';
            $carsHTML .= '</tr>';
        }
    } else {
        $carsHTML = '<tr><td colspan="4">No cars available</td></tr>';
    }

    return $carsHTML;
}
