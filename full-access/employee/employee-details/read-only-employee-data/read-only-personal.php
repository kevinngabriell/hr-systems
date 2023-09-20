<?php

//check session when started
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('location: ../../../../login.php');
}

//connection 
include("../../../../Conn/connection.php");

//set username variable from session
$username = $_SESSION['username'];
$employee_id = $_GET['employee_id'];

//retrieve company name
$company_data_query = "SELECT cy.company_name, cy.company_address FROM users us JOIN company cy ON us.company_id = cy.company_id;";
$company_data_result = $connect->query($company_data_query);

while ($company_data_row = $company_data_result->fetch_assoc()) {
    $company_name_printed = $company_data_row['company_name'];
    $company_address_printed = $company_data_row['company_address'];
}

$user_data_query = "SELECT em.employee_name, ecd.employee_email FROM users us JOIN employee em ON us.employee_id = em.id JOIN employee_contact_details_db ecd ON us.employee_id = ecd.id WHERE us.username = '$username';";
$user_data_results = $connect->query($user_data_query);

while ($user_data_row = $user_data_results->fetch_assoc()) {
    $employee_name_printed = $user_data_row['employee_name'];
    $employee_email_printed = $user_data_row['employee_email'];
}

?>

