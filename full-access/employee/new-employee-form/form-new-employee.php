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

//retrieve gender db 
$gender_db_query = "SELECT * FROM gender_db;";
$gender_db_result = mysqli_query($connect, $gender_db_query);

//retrieve nationality db
$nationality_db_query = "SELECT * FROM nationality_db";
$nationality_db_result = mysqli_query($connect, $nationality_db_query);

//retrieve department db
$company_db_query = "SELECT * FROM company";
$company_db_result = mysqli_query($connect, $company_db_query);

//retrieve department db
$department_db_query = "SELECT * FROM department";
$department_db_result = mysqli_query($connect, $department_db_query);

//retrieve position db
$position_db_query = "SELECT * FROM position_db";
$position_db_result = mysqli_query($connect, $position_db_query);

//retrieve status db
$status_db_query = "SELECT * FROM status_db";
$status_db_result = mysqli_query($connect, $status_db_query);

//retrieve religion db
$religion_db_query = "SELECT * FROM religion_db";
$religion_db_result = mysqli_query($connect, $religion_db_query);

//retrieve all data if submit
if (isset($_POST['submit'])) {

    //gather user data
    $employee_name = $_POST['user_fullname'];
    $employee_gender = $_POST['user_gender'];
    $employee_pob = $_POST['user_pob'];
    $employee_dob = $_POST['user_dob'];
    $employee_nationality = $_POST['user_nationality'];
    $employee_department = $_POST['user_department'];
    $employee_position = $_POST['user_position'];
    $employee_identity_number = $_POST['user_identity'];
    $employee_jamsostek_number = $_POST['user_jamsostek'];
    $employee_status = $_POST['user_status'];
    $employee_religion = $_POST['user_religion'];
    $employee_id = $_POST['user_employee_id'];
    $employee_company = $_POST['user_company'];

    //check if employee field is empty 
    if ($employee_id == null) {
        $message = "ID karyawan masih kosong !!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($employee_name == null) {
        $message = "Nama karyawan masih kosong !!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($employee_gender == null) {
        $message = "Jenis kelamin karyawan masih kosong !!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($employee_pob == null) {
        $message = "Tempat lahir karyawan masih kosong !!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($employee_dob == null) {
        $message = "Tanggal lahir karyawan masih kosong !!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($employee_nationality == null) {
        $message = "Silahkan pilih kewarganegaraan karyawan";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($employee_company == null){
        $message = "Silahkan pilih perusahaan karyawan";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($employee_department == null || $employee_department == 'DEPT-HR-000') {
        $message = "Silahkan pilih departemen karyawan !!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($employee_position == null) {
        $message = "Silahkan pilih jabatan karyawan !!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($employee_identity_number == null) {
        $message = "Nomor KTP karyawan masih kosong";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($employee_status == null) {
        $message = "Silahkan pilih status karyawan !!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($employee_religion == null) {
        $message = "Silahkan pilih agama karyawan !!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {

        $check_ktp_is_unique = "SELECT employee_identity FROM employee WHERE employee_identity = '$employee_identity_number'";
        $check_ktp_is_unique = mysqli_query($connect, $check_ktp_is_unique);

        while ($check_ktp_rows = $check_ktp_is_unique->fetch_assoc()) {
            $message = "Nomor KTP telah terdaftar silahkan coba lagi !!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }

        //get length of ktp number
        $employee_identity_length = strlen($employee_identity_number);

        //check is 16 digit or not
        if ($employee_identity_length >= 10) {

            //set employee name session
            $_SESSION['employee_name'] = $employee_name;

            //insert data query
            $employee_insert_query = "INSERT IGNORE INTO employee (id, employee_id, employee_name, employee_status_id, department_id, position_id, company_id, gender, employee_pob, employee_dob, employee_nationality, employee_identity, employee_jamsostek, employee_status, employee_religion) VALUES (NULL, '$employee_id', '$employee_name', 'ES-HR-001', '$employee_department', '$employee_position', '$employee_company', '$employee_gender', '$employee_pob', '$employee_dob', '$employee_nationality', '$employee_identity_number', '$employee_jamsostek_number', '$employee_status', '$employee_religion');";
            $input_employee_process = mysqli_query($connect, $employee_insert_query);

            if ($input_employee_process) {
                header("location: form-new-employee-contact-details.php");
                // $message = "Data berhasil diinput!!";
                // echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                mysqli_error($connect);
            }

        } else {
            //error message
            $message = "No KTP tidak valid !!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }

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
                                    <div class="profile-name">Kevin Gabriel</div>
                                    <div class="profile-email">kevingabriel@xyz.com</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <form action="" method="post">
                    <div class="row mt-4 d-flex">
                        <div class="col">

                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">ID Karyawan</label>
                                    <input type="text" id="user_employee_id" name="user_employee_id"
                                        class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nama lengkap</label>
                                    <input type="text" id="user_fullname" name="user_fullname" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Jenis kelamin</label>
                                    <select class="form-select" id="user_gender" name="user_gender">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($gender_db_rows = mysqli_fetch_array($gender_db_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $gender_db_rows["gender_id"]; ?>">
                                                <?php echo $gender_db_rows["gender_name"] ?>
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
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="form-new-employee-label mb-1">Tempat lahir</label>
                                            <input type="text" id="user_pob" name="user_pob" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label for="" class="form-new-employee-label mb-1">Tanggal lahir</label>
                                            <input type="date" id="user_dob" name="user_dob" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Kewarganegaraan</label>
                                    <select class="form-select" id="user_nationality" name="user_nationality">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($nationality_db_rows = mysqli_fetch_array($nationality_db_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $nationality_db_rows["num_code"]; ?>">
                                                <?php echo $nationality_db_rows["en_short_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col" class="form-new-employee-label">
                                    <label for="" class="form-new-employee-label mb-1">Perusahaan</label>
                                    <select class="form-select" name="user_company" id="user_company">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($company_db_rows = mysqli_fetch_array($company_db_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $company_db_rows["company_id"]; ?>">
                                                <?php echo $company_db_rows["company_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col" class="form-new-employee-label">
                                    <label for="" class="form-new-employee-label mb-1">Departemen</label>
                                    <select class="form-select" name="user_department" id="user_department">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($department_db_rows = mysqli_fetch_array($department_db_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $department_db_rows["department_id"]; ?>">
                                                <?php echo $department_db_rows["department_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col" class="form-new-employee-label">
                                    <label for="" class="form-new-employee-label mb-1">Jabatan</label>
                                    <select class="form-select" name="user_position" id="user_position">
                                        <option></option>

                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">No. KTP</label>
                                    <input type="number" name="user_identity" id="user_identity" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">No. Jamsostek</label>
                                    <input type="number" name="user_jamsostek" id="user_jamsostek" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Status</label>
                                    <select class="form-select" id="user_status" name="user_status">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($status_db_rows = mysqli_fetch_array($status_db_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $status_db_rows["status_id"]; ?>">
                                                <?php echo $status_db_rows["status_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Agama</label>
                                    <select class="form-select" id="user_religion" name="user_religion">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($religion_db_rows = mysqli_fetch_array($religion_db_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $religion_db_rows["religion_id"]; ?>">
                                                <?php echo $religion_db_rows["religion_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-3">
                            <div class="card" style="height: 100%;">
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
                    <button type="submit" id="submit" name="submit"
                        class="btn mt-4 btn-submit-form-employee align-items-end">Next</button>
                </form>





            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>

</body>

</html>