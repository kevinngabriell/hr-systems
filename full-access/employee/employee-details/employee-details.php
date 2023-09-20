<?php

error_reporting(E_ERROR);

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

$employee_id = $_GET['employee_id'];

$user_data_query = "SELECT em.employee_name, ecd.employee_email FROM users us JOIN employee em ON us.employee_id = em.id JOIN employee_contact_details_db ecd ON us.employee_id = ecd.id WHERE us.username = '$username';";
$user_data_results = $connect->query($user_data_query);

while ($user_data_row = $user_data_results->fetch_assoc()) {
    $employee_name_printed = $user_data_row['employee_name'];
    $employee_email_printed = $user_data_row['employee_email'];
}


$employee_data_query = "SELECT em.employee_name, ps.position_name, dp.department_name, ecd.employee_email, ecd.employee_phone_number, es.employee_status_name, em.employee_pob, DATE_FORMAT(em.employee_dob, '%d %M %Y') as employee_dob, gd.gender_name FROM employee em JOIN position_db ps ON em.position_id = ps.position_id JOIN department dp ON em.department_id = dp.department_id JOIN employee_contact_details_db ecd ON em.id = ecd.id JOIN employee_status es ON em.employee_status_id = es.employee_status_id JOIN gender_db gd ON em.gender = gd.gender_id WHERE em.id = '$employee_id';";
$employee_data_results = $connect->query($employee_data_query);

while ($employee_data_rows = $employee_data_results->fetch_assoc()) {
    $data_employee_name = $employee_data_rows['employee_name'];
    $data_employee_position = $employee_data_rows['position_name'];
    $data_employee_department = $employee_data_rows['department_name'];
    $data_employee_email = $employee_data_rows['employee_email'];
    $data_employee_phone = $employee_data_rows['employee_phone_number'];
    $data_employee_status = $employee_data_rows['employee_status_name'];
    $data_employee_pob = $employee_data_rows['employee_pob'];
    $data_employee_dob = $employee_data_rows['employee_dob'];
    $data_employee_gender = $employee_data_rows['gender_name'];
}

$supervised_query = "SELECT employee_spv FROM employee WHERE id = '$employee_id' ";
$supervised_result = $connect->query($supervised_query);

while ($supervised_rows = $supervised_result->fetch_assoc()) {
    $data_supervisor = $supervised_rows['employee_spv'];

    $find_supervised_name = "SELECT employee_name FROM employee WHERE id = '$data_supervisor' ";
    $find_supervised_name_result = $connect->query($find_supervised_name);

    while ($find_supervised_name_rows = $find_supervised_name_result->fetch_assoc()) {
        $superviser_name = $find_supervised_name_rows['employee_name'];
    }

}

// $find_supervised_name = "SELECT employee_name FROM employee WHERE ";


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
                <div class="mt-4 main-menu-text">Peraturan</div>

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
                <a href="../../../logout.php" class="sidebar-menu">
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
                            <a href="employee.php" class="nav-item nav-text-dashboard">Employee</a>
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

                <div class="row">
                    <a href="../employee-list.php" style="text-decoration: none;">
                        <div class="back">
                            < Back </div>
                    </a>
                </div>

                <div class="row d-flex align-items-center">
                    <div class="col profile-employee-title">
                        Profile Karyawan
                    </div>
                </div>

                <nav class="nav flex-column flex-sm-row">
                    <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="#">Overview</a>
                    <a class="flex-sm-fill text-sm-center nav-link"
                        href="employee-details-absensi.php?employee_id=<?php echo $employee_id ?>">Absensi</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-perfoma.html">Perfoma</a>
                    <a class="flex-sm-fill text-sm-center nav-link"
                        href="employee-details-permohonan.html">Permohonan</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-dokumen.html">Dokumen</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-catatan.html">Catatan</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-riwayat.html">Riwayat</a>
                </nav>

                <div class="row mt-4 d-flex">
                    <div class="col-3">
                        <div class="card card-employee-1">
                            <img src="../../../Assets/company-logo.png"
                                style="width: 30%; margin-left: 3%; margin-top:5%;">

                            <!-- employee name -->
                            <a href="" style="text-decoration: none;">
                                <div class="employee-name">
                                    <?= $data_employee_name; ?>
                                </div>
                            </a>
                            <!-- employee position -->
                            <div class="employee-position">
                                <?= $data_employee_position ?>
                            </div>

                            <!-- employee status -->
                            <div class="status-label">Status</div>
                            <div class="status-value">
                                <?= $data_employee_status ?>
                            </div>

                            <!-- employee contact -->
                            <div class="contact-label mt-3">Kontak</div>
                            <div class="contact-value">
                                <?php
                                if ($data_employee_phone == NULL) {
                                    echo "-";
                                } else {
                                    echo $data_employee_phone;
                                }
                                ?>
                                <br />
                                <?php
                                if ($data_employee_email == NULL) {
                                    echo "-";
                                } else {
                                    echo $data_employee_email;
                                }
                                ?>
                            </div>

                            <!-- supervised by -->
                            <div class="contact-label mt-3">Supervisor</div>
                            <div class="contact-value mb-4">
                                <?php
                                    if($superviser_name == NULL){
                                        echo "-";
                                    } else {
                                        echo $superviser_name;
                                    }

                                ?>
                            </div>

                        </div>

                        <div class="card mt-4 card-action">
                            <a href="read-only-employee-data/read-only-personal.php?employee_id=<?php echo $employee_id ?>" style="text-decoration: none;">
                                <div class="menu-name-details-right-corner">
                                    Detail karyawan
                                </div>
                            </a>
                        </div>


                        <div class="card mt-4 card-action">
                            <a href="create-acc-backend.php?employee_id=<?php echo $employee_id ?>"
                                style="text-decoration: none;">
                                <div class="menu-name-details-right-corner">
                                    Buat akun
                                </div>
                            </a>
                        </div>

                        <div class="card mt-4 card-action">
                            <a href="javascript:resetPass();" style="text-decoration: none;">
                                <div class="menu-name-details-right-corner">
                                    Reset akun
                                </div>
                            </a>
                        </div>

                        <div class="card mt-4 card-action">
                            <a href="javascript:deleteAcc();" style="text-decoration: none;">
                                <div class="menu-name-details-right-corner">
                                    Hapus akun
                                </div>
                            </a>
                        </div>

                        <div class="card mt-4 card-action mb-5">
                            <a href="javascript:deleteAcc();" style="text-decoration: none;">
                                <div class="menu-name-details-right-corner">
                                    Request Update data
                                </div>
                            </a>
                        </div>



                    </div>
                    <div class="col">
                        <div class="card card-employee-1">

                            <div class="basic-information">
                                Informasi Umum
                            </div>

                            <table style="margin-left: 3%; margin-top: 1%; margin-bottom: 3%; ">
                                <tr>
                                    <th class="label-basic-information">Nama lengkap</th>
                                    <th class="value-basic-information">
                                        <?= $data_employee_name; ?>
                                    </th>
                                </tr>
                                <tr class="separator">
                                    <th class="label-basic-information">Tanggal lahir</th>
                                    <th class="value-basic-information">
                                        <?php echo "$data_employee_pob, $data_employee_dob" ?>
                                    </th>
                                </tr>
                                <tr class="separator">
                                    <th class="label-basic-information">Nomor handphone</th>
                                    <th class="value-basic-information">
                                        <?php
                                        if ($data_employee_phone == NULL) {
                                            echo "-";
                                        } else {
                                            echo $data_employee_phone;
                                        }
                                        ?>
                                    </th>
                                </tr>
                                <tr class="separator">
                                    <th class="label-basic-information">Jenis kelamin</th>
                                    <th class="value-basic-information">
                                        <?= $data_employee_gender; ?>
                                    </th>
                                </tr>
                            </table>
                        </div>

                        <div class="card card-employee-1 mt-4">
                            <div class="basic-information">
                                Catatan posisi
                            </div>

                            <table style="margin-left: 3%; margin-top: 2%; margin-bottom: 3%; ">
                                <tr>
                                    <th class="label-basic-information">Jabatan</th>
                                    <th class="label-basic-information">Departemen</th>
                                    <th class="label-basic-information">Periode awal</th>
                                    <th class="label-basic-information">Periode akhir</th>
                                </tr>
                                <?php
                                    $position_history_query = "SELECT pd.position_name, DATE_FORMAT(pld.start_date, '%d %M %Y') as start_date, DATE_FORMAT(pld.end_date, '%d %M %Y') as end_date, dt.department_name FROM position_log_db pld JOIN position_db pd ON pld.position = pd.position_id JOIN department dt ON pld.department = dt.department_id;";
                                    $position_history_result = $connect->query($position_history_query);

                                    while($position_history_rows = $position_history_result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td style="height: 50%;"><?= $position_history_rows['position_name']; ?></td>
                                    <td style="height: 50%;"><?= $position_history_rows['department_name']; ?></td>
                                    <td style="height: 50%;"><?= $position_history_rows['start_date']; ?></td>
                                    <td style="height: 50%;">
                                        <?php  
                                            if($position_history_rows['end_date'] == NULL){
                                                echo "-";
                                            } else {
                                                echo $position_history_rows['end_date'];
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                    endwhile;
                                ?>
                            </table>


                        </div>

                    </div>
                </div>



            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
        <script>
            function resetPass() {
                //alert('hi');

                response = confirm("Apakah anda yakin ingin melakukan reset password ?");
                if (response) {
                    // add code if the user pressed the Ok button
                    window.location.href = "reset-pass-backend.php?employee_id=<?php echo $employee_id ?>";
                } else {
                    // add code if the user pressed the Cancel button
                    alert("Reset password dibatalkan");
                }
            }

            function deleteAcc() {
                // alert('delete');

                deleteresponse = confirm("Apakah anda yakin ingin menghapus akun ini ?");

                if (deleteresponse) {
                    window.location.href = "delete-acc-backend.php?employee_id=<?php echo $employee_id ?>";
                } else {
                    alert('Hapus akun dibatalkan');
                }
            }   
        </script>
</body>

</html>