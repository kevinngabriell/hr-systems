<?php

//connection 
include("../../../Conn/connection.php");

$department_id = $_POST['department_id'];

if(!empty($department_id))
    {
        $user_position_query = "SELECT * FROM position_db WHERE department_id = '$department_id'";
        $user_position_result = $connect->query($user_position_query);

        if($user_position_result->num_rows > 0){
            while($user_position_row = $user_position_result->fetch_assoc()){
                echo "<option value='".$user_position_row['position_id']."'>".$user_position_row['position_name']."</option>";
            }
        }
    }
else {

}

$province_ktp = $_POST['province_ktp'];

if(!empty($province_ktp)){
    $user_city_ktp_query = "SELECT * FROM kotakab_db WHERE province_id = '$province_ktp'";
    $user_city_ktp_result = $connect->query($user_city_ktp_query);

    if($user_city_ktp_result->num_rows > 0){
        while($user_city_ktp_row = $user_city_ktp_result->fetch_assoc()){
            echo "<option value='".$user_city_ktp_row['id']."'>".$user_city_ktp_row['name']."</option>";
        }
    }

} else {

}

$city_ktp = $_POST['city_ktp'];

if(!empty($city_ktp)){
    $user_kec_ktp_query = "SELECT * FROM kecamatan_db WHERE regency_id = '$city_ktp'";
    $user_kec_ktp_result = $connect->query($user_kec_ktp_query);

    if($user_kec_ktp_result->num_rows > 0){
        while($user_kec_ktp_row = $user_kec_ktp_result->fetch_assoc()){
            echo "<option value='".$user_kec_ktp_row['id']."'>".$user_kec_ktp_row['name']."</option>";
        }
    }

} else {

}

$kec_ktp = $_POST['kec_ktp'];

if(!empty($kec_ktp)){
    $user_kel_ktp_query = "SELECT * FROM kelurahan_db WHERE district_id = '$kec_ktp'";
    $user_kel_ktp_result = $connect->query($user_kel_ktp_query);

    if($user_kel_ktp_result->num_rows > 0){
        while($user_kel_ktp_row = $user_kel_ktp_result->fetch_assoc()){
            echo "<option value='".$user_kel_ktp_row['id']."'>".$user_kel_ktp_row['name']."</option>";
        }
    }

} else {

}

$province_now = $_POST['province_now'];

if(!empty($province_now)){
    $user_city_now_query = "SELECT * FROM kotakab_db WHERE province_id = '$province_now'";
    $user_city_now_result = $connect->query($user_city_now_query);

    if($user_city_now_result->num_rows > 0){
        while($user_city_now_row = $user_city_now_result->fetch_assoc()){
            echo "<option value='".$user_city_now_row['id']."'>".$user_city_now_row['name']."</option>";
        }
    }

} else {

}

$city_now = $_POST['city_now'];

if(!empty($city_now)){
    $user_kec_now_query = "SELECT * FROM kecamatan_db WHERE regency_id = '$city_now'";
    $user_kec_now_result = $connect->query($user_kec_now_query);

    if($user_kec_now_result->num_rows > 0){
        while($user_kec_now_row = $user_kec_now_result->fetch_assoc()){
            echo "<option value='".$user_kec_now_row['id']."'>".$user_kec_now_row['name']."</option>";
        }
    }

} else {

}

$kec_now = $_POST['kec_now'];

if(!empty($kec_now)){
    $user_kel_now_query = "SELECT * FROM kelurahan_db WHERE district_id = '$kec_now'";
    $user_kel_now_result = $connect->query($user_kel_now_query);

    if($user_kel_now_result->num_rows > 0){
        while($user_kel_now_row = $user_kel_now_result->fetch_assoc()){
            echo "<option value='".$user_kel_now_row['id']."'>".$user_kel_now_row['name']."</option>";
        }
    }

} else {

}


?>