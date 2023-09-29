<?php

//connection 
include("../../Conn/connection.php");

$company_id = $_POST['company_id'];

if(!empty($company_id)){
    $department_query = "SELECT * FROM department WHERE company_id = '$company_id'";
    $department_result = $connect->query($department_query);

    if($department_result->num_rows > 0){
        while($department_rows = $department_result->fetch_assoc()){
            echo "<option value ='".$department_rows['department_id']."'>".$department_rows['department_name']."</option>";
        }
    }
} else {

}

?>