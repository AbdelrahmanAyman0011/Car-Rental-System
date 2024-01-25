<?php
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
?>
