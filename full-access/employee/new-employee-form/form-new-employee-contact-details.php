<?php

//check session when started
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('location: ../../../login.php');
}

//connection 
include("../../../Conn/connection.php");

//set username variable from session
$username = $_SESSION['username'];

//retrieve company name
$company_data_query = "SELECT cy.company_name, cy.company_address FROM users us JOIN company cy ON us.company_id = cy.company_id;";
$company_data_result = $connect->query($company_data_query);

while ($company_data_row = $company_data_result->fetch_assoc()) {
    $company_name_printed = $company_data_row['company_name'];
    $company_address_printed = $company_data_row['company_address'];
}

//retrieve address status
$address_status_query = "SELECT * FROM address_status_db";
$address_status_result = mysqli_query($connect, $address_status_query);
$address_status_result_now = mysqli_query($connect, $address_status_query);

//retrieve province status
$provinces_query = "SELECT * FROM provinsi_db";
$provinces_result = mysqli_query($connect, $provinces_query);
$provinces_result_now = mysqli_query($connect, $provinces_query);

$user_data_query = "SELECT em.employee_name, ecd.employee_email FROM users us JOIN employee em ON us.employee_id = em.id JOIN employee_contact_details_db ecd ON us.employee_id = ecd.id WHERE us.username = '$username';";
$user_data_results = $connect->query($user_data_query);

while ($user_data_row = $user_data_results->fetch_assoc()) {
    $employee_name_printed = $user_data_row['employee_name'];
    $employee_email_printed = $user_data_row['employee_email'];
}

//check if next button
if (isset($_POST['submit'])) {

    //gather user data
    $employee_address_ktp = $_POST['user_address_ktp'];
    $employee_address_status_ktp = $_POST['user_address_status_ktp'];
    $employee_rt_ktp = $_POST['user_rt_ktp'];
    $employee_rw_ktp = $_POST['user_rw_ktp'];
    $employee_province_ktp = $_POST['user_province_ktp'];
    $employee_city_ktp = $_POST['user_city_ktp'];
    $employee_kec_ktp = $_POST['user_kec_ktp'];
    $employee_kel_ktp = $_POST['user_kel_ktp'];
    $employee_address_now = $_POST['user_address_now'];
    $employee_address_status_now = $_POST['user_address_status_now'];
    $employee_rt_now = $_POST['user_rt_now'];
    $employee_rw_now = $_POST['user_rw_now'];
    $employee_province_now = $_POST['user_province_now'];
    $employee_city_now = $_POST['user_city_now'];
    $employee_kec_now = $_POST['user_kec_now'];
    $employee_kel_now = $_POST['user_kel_now'];
    $employee_email = $_POST['user_email'];
    $employee_phone = $_POST['user_phone'];

    //get last id employee
    $get_id_query = "SELECT id FROM employee ORDER BY id DESC LIMIT 1";
    $last_id = mysqli_query($connect, $get_id_query);
    while ($last_id_row = $last_id->fetch_assoc()) {
        $employee_id = $last_id_row['id'];
    }

    //insert contact query
    $insert_contact_details_query = "INSERT IGNORE INTO employee_contact_details_db (employee_address_ktp, employee_address_status_ktp, employee_rt_ktp, employee_rw_ktp, employee_provinsi_ktp, employee_kota_kab_ktp, employee_kec_ktp, employee_kel_ktp, employee_address_now, employee_address_status_now, employee_rt_now, employee_rw_now, employee_provinsi_now, employee_kot_kab_now, employee_kec_now, employee_kel_now, employee_email, employee_phone_number, id) VALUES ('$employee_address_ktp', '$employee_address_status_ktp', '$employee_rt_ktp', '$employee_rw_ktp', '$employee_province_ktp', '$employee_city_ktp', '$employee_kec_ktp', '$employee_kel_ktp', '$employee_address_now', '$employee_address_status_now', '$employee_rt_now', '$employee_rw_now', '$employee_province_now', '$employee_city_now', '$employee_kec_now', '$employee_kel_now', '$employee_email', 'employee_phone_number', '$employee_id')";
    $insert_contact_details_result = mysqli_query($connect, $insert_contact_details_query);
    if ($insert_contact_details_result) {
        header("location: form-new-employee-employment-history.php");
    } else {
        mysqli_error($connect);
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Employee HR Systems</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="employeestyle.css" />
    <!-- font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nokora:wght@100;300;400;700;900&display=swap"
        rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="app.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row h-100">
            <!-- column left side all -->
            <div class="col-2" style="margin-left: 1%; margin-right: 1%">
                <!-- row left side company profile-->
                <div class="row row-company-name-and-logo">
                    <!-- column for company logo -->
                    <div class="col-4">
                        <img src="../../../Assets/company-logo.png" alt="" />
                    </div>
                    <!-- column for company name and address -->
                    <div class="col">
                        <div class="company-name">
                            <?= $company_name_printed ?>
                        </div>
                        <div class="company-address">
                            <?= $company_address_printed ?>
                        </div>
                    </div>
                </div>

                <!-- main menu text -->
                <div class="main-menu-text">Menu utama</div>

                <!-- Navigation links in sidebar-->
                <a href="../../dashboard.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Dashboard-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Beranda</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../employee.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu">
                        <div class="col-3">
                            <img src="../../../Assets/Asset21.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Karyawan</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../payroll.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Payroll-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Gaji</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../performance.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Performance-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Performa</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../training.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Training-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Pelatihan</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../event.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Event-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Acara</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../report.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Report-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Laporan</div>
                    </div>
                </a>

                <!-- main menu text -->
                <div class="mt-4 main-menu-text">Pengaturan</div>

                <!-- Navigation links in sidebar-->
                <a href="../../company-setting.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/CompanySetting-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Perusahaan</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../structure.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Structure-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Struktur</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../attandance-setting.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Attandance-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Kehadiran</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../logout.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-logout">
                        <div class="col-3">
                            <img src="../../../Assets/Asset15.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Logout</div>
                    </div>
                </a>
            </div>

            <!-- right side column -->
            <div class="col">

                <!-- top navbar -->
                <nav class="navbar">
                    <!-- row navbar -->
                    <div class="row row-right-navbar">
                        <!-- first column of top navbar -->
                        <div class="col">
                            <a href="../employee.php" class="nav-item nav-text-dashboard">Employee</a>
                        </div>
                        <!-- second column of top navbar -->
                        <div class="col">
                            <!-- search and notif logo -->
                            <div class="row d-flex align-items-center">
                                <!-- search form -->
                                <div class="col">
                                    <input class="form-control" type="text" placeholder="Search here"
                                        aria-label="default input example" />
                                </div>
                                <!-- notification logo -->
                                <div class="col-2">
                                    <img src="../../../Assets/Asset17.png" class="img-right-side" />
                                </div>
                            </div>
                        </div>
                        <!-- third column of top navbar -->
                        <div class="col">
                            <!-- row of profile @top navbar -->
                            <div class="row d-flex align-items-center">
                                <!-- profile picture -->
                                <div class="col-2">
                                    <img src="../../../Assets/company-logo.png" class="img-right-side" />
                                </div>
                                <!-- profile name and email -->
                                <div class="col">
                                    <div class="profile-name">
                                        <?php echo $employee_name_printed ?>
                                    </div>
                                    <div class="profile-email">
                                        <?php
                                        if ($employee_email_printed == NULL) {
                                            echo "Email belum terdata";
                                        } else {
                                            echo $employee_email_printed;
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <form action="" method="post">
                    <div class="row mt-4 mb-5 d-flex">
                        <div class="col">

                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Alamat sesuai KTP</label>
                                    <textarea class="form-control" name="user_address_ktp" id="user_address_ktp"
                                        cols="10" rows="3"></textarea>
                                </div>
                                <div class="col-5">
                                    <label for="" class="form-new-employee-label mb-1">Status alamat</label>
                                    <select class="form-select" id="user_address_status_ktp"
                                        name="user_address_status_ktp">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($address_status_rows = mysqli_fetch_array($address_status_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $address_status_rows["address_status_id"]; ?>">
                                                <?php echo $address_status_rows["address_status_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-3">
                                    <label for="" class="form-new-employee-label mb-1">RT</label>
                                    <input type="number" name="user_rt_ktp" id="user_rt_ktp" class="form-control">
                                </div>
                                <div class="col-3">
                                    <label for="" class="form-new-employee-label mb-1">RW</label>
                                    <input type="number" name="user_rw_ktp" id="user_rw_ktp" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Provinsi</label>
                                    <select class="form-select" id="user_province_ktp" name="user_province_ktp">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($provinces_rows = mysqli_fetch_array($provinces_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $provinces_rows["id"]; ?>">
                                                <?php echo $provinces_rows["name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Kota/Kab</label>
                                    <select class="form-select" id="user_city_ktp" name="user_city_ktp">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Kecamatan</label>
                                    <select class="form-select" id="user_kec_ktp" name="user_kec_ktp">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Kelurahan</label>
                                    <select class="form-select" id="user_kel_ktp" name="user_kel_ktp">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Alamat saat ini</label>
                                    <textarea class="form-control" name="user_address_now" id="user_address_now"
                                        cols="10" rows="3"></textarea>
                                </div>
                                <div class="col-5">
                                    <label for="" class="form-new-employee-label mb-1">Status alamat</label>
                                    <select class="form-select" id="user_address_status_now"
                                        name="user_address_status_now">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($address_status_rows_now = mysqli_fetch_array($address_status_result_now, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $address_status_rows_now["address_status_id"]; ?>">
                                                <?php echo $address_status_rows_now["address_status_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-3">
                                    <label for="" class="form-new-employee-label mb-1">RT</label>
                                    <input type="number" name="user_rt_now" id="user_rt_now" class="form-control">
                                </div>
                                <div class="col-3">
                                    <label for="" class="form-new-employee-label mb-1">RW</label>
                                    <input type="number" name="user_rw_now" id="user_rw_now" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Provinsi</label>
                                    <select class="form-select" id="user_province_now" name="user_province_now">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($provinces_rows_now = mysqli_fetch_array($provinces_result_now, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $provinces_rows_now["id"]; ?>">
                                                <?php echo $provinces_rows_now["name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Kota/Kab</label>
                                    <select class="form-select" id="user_city_now" name="user_city_now">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Kecamatan</label>
                                    <select class="form-select" id="user_kec_now" name="user_kec_now">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Kelurahan</label>
                                    <select class="form-select" id="user_kel_now" name="user_kel_now">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Alamat Email</label>
                                    <input type="email" name="user_email" id="user_email" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nomor Handphone</label>
                                    <input type="number" name="user_phone" id="user_phone" class="form-control">
                                </div>
                            </div>

                            <button type="submit" id="submit" name="submit"
                                class="btn mt-4 btn-submit-form-employee align-items-end">Next</button>

                        </div>
                        <div class="col-3">
                            <div class="card">
                                <nav>
                                    <ul>
                                        <li style="list-style-type: none; margin-top: 12%;">
                                            <a href="form-new-employee.php" style="text-decoration: none;">
                                                Informasi pribadi
                                            </a>
                                        </li>
                                        <li style="list-style-type: none; margin-top: 12%;">
                                            <a href="form-new-employee-contact-details.php"
                                                style="text-decoration: none;">
                                                Data alamat
                                            </a>
                                        </li>
                                        <li style="list-style-type: none; margin-top: 12%;">
                                            <a href="form-new-employee-employment-history.php"
                                                style="text-decoration: none;">
                                                Riwayat bekerja
                                            </a>
                                        </li>
                                        <li style="list-style-type: none; margin-top: 12%;">
                                            <a href="form-new-employee-educational.php" style="text-decoration: none;">
                                                Pendidikan
                                            </a>
                                        </li>
                                        <li style="list-style-type: none; margin-top: 12%;">
                                            <a href="form-new-employee-language-professional.php"
                                                style="text-decoration: none;">
                                                Kemampuan bahasa
                                            </a>
                                        </li>
                                        <li style="list-style-type: none; margin-top: 12%;">
                                            <a href="form-new-employee-family-data.php" style="text-decoration: none;">
                                                Data keluarga
                                            </a>
                                        </li>
                                        <li style="list-style-type: none; margin-top: 12%;">
                                            <a href="form-new-employee-question.php" style="text-decoration: none;">
                                                Pertanyaan
                                            </a>
                                        </li>
                                        <li style="list-style-type: none; margin-top: 12%;">
                                            <a href="form-new-employee-agreement.php" style="text-decoration: none;">
                                                Pernyataan
                                            </a>
                                        </li>
                                    </ul>
                                </nav>

                            </div>
                        </div>
                    </div>
                </form>





            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>

</body>

</html>