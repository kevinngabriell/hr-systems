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
                        <img src="../../../../Assets/company-logo.png" alt="" />
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
                <a href="../../../dashboard.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Dashboard-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Beranda</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../employee.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu">
                        <div class="col-3">
                            <img src="../../../../Assets/Asset21.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Karyawan</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../payroll.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Payroll-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Gaji</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../performance.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Performance-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Performa</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../training.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Training-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Pelatihan</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../event.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Event-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Acara</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../report.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Report-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Laporan</div>
                    </div>
                </a>

                <!-- main menu text -->
                <div class="mt-4 main-menu-text">Peraturan</div>

                <!-- Navigation links in sidebar-->
                <a href="../../../company-setting.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/CompanySetting-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Perusahaan</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../structure.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Structure-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Struktur</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../attandance-setting.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Attandance-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Kehadiran</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../../logout.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-logout">
                        <div class="col-3">
                            <img src="../../../../Assets/Asset15.png" alt="" class="img-right-side" />
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
                                    <img src="../../../../Assets/Asset17.png" class="img-right-side" />
                                </div>
                            </div>
                        </div>
                        <!-- third column of top navbar -->
                        <div class="col">
                            <!-- row of profile @top navbar -->
                            <div class="row d-flex align-items-center">
                                <!-- profile picture -->
                                <div class="col-2">
                                    <img src="../../../../Assets/company-logo.png" class="img-right-side" />
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
                    <a href="../../employee-list.php" style="text-decoration: none;">
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
                    <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page"
                        href="../employee-details.php?employee_id=<?php echo $employee_id ?>">Overview</a>
                    <a class="flex-sm-fill text-sm-center nav-link"
                        href="../employee-details-absensi.php?employee_id=<?php echo $employee_id ?>">Absensi</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-perfoma.html">Perfoma</a>
                    <a class="flex-sm-fill text-sm-center nav-link"
                        href="employee-details-permohonan.html">Permohonan</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-dokumen.html">Dokumen</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-catatan.html">Catatan</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-riwayat.html">Riwayat</a>
                </nav>

                <div class="row">
                    <div class="col">

                        <div class="card card-employee-1 mt-3">

                            <div class="basic-information">
                                Informasi umum
                            </div>

                            <?php
                            $get_employee_query = "SELECT em.employee_id, em.employee_name, gb.gender_name, em.employee_pob, DATE_FORMAT(em.employee_dob, '%d %M %Y') as employee_dob, nb.nationality, cy.company_name, dt.department_name, pb.position_name, em.employee_identity, em.employee_jamsostek, sb.status_name, rb.religion_name FROM employee em JOIN gender_db gb ON em.gender = gb.gender_id JOIN nationality_db nb ON em.employee_nationality = nb.num_code JOIN company cy ON em.company_id = cy.company_id JOIN department dt ON em.department_id = dt.department_id JOIN position_db pb ON em.position_id = pb.position_id JOIN status_db sb ON em.employee_status = sb.status_id JOIN religion_db rb ON em.employee_religion = rb.religion_id WHERE em.id = '$employee_id';";
                            $get_employee_result = $connect->query($get_employee_query);

                            while ($get_employee_rows = $get_employee_result->fetch_assoc()) {
                                ?>

                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">
                                            ID karyawan
                                        </div>
                                        <div class="value-basic">
                                            <?php
                                            echo $get_employee_rows['employee_id'];
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">
                                            Nama karyawan
                                        </div>
                                        <div class="value-basic">
                                            <?php
                                            echo $get_employee_rows['employee_name'];
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">
                                            Jenis kelamin
                                        </div>
                                        <div class="value-basic">
                                            <?php
                                            echo $get_employee_rows['gender_name'];
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">
                                            Tempat, tanggal lahir
                                        </div>
                                        <div class="value-basic">
                                            <?php
                                            $employee_pob = $get_employee_rows['employee_pob'];
                                            $employee_dob = $get_employee_rows['employee_dob'];
                                            echo "$employee_pob, $employee_dob";
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">
                                            Kewarganegaraan
                                        </div>
                                        <div class="value-basic">
                                            <?php
                                            echo $get_employee_rows['nationality'];
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">
                                            Status
                                        </div>
                                        <div class="value-basic">
                                            <?php
                                            echo $get_employee_rows['status_name'];
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">
                                            Agama
                                        </div>
                                        <div class="value-basic">
                                            <?php
                                            echo $get_employee_rows['religion_name'];
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">
                                            Nomor ktp
                                        </div>
                                        <div class="value-basic">
                                            <?php
                                            echo $get_employee_rows['employee_identity'];
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">
                                            Nomor jamsostek
                                        </div>
                                        <div class="value-basic">
                                            <?php
                                                $employee_jamsostek =  $get_employee_rows['employee_jamsostek'];

                                                if($employee_jamsostek == NULL){
                                                    echo "-";
                                                } else {
                                                    echo $employee_jamsostek;
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>

                        </div>

                        <div class="card card-employee-1 mt-4">

                            <div class="basic-information">
                                Informasi posisi
                            </div>

                            <?php
                            $get_employee_query = "SELECT em.employee_id, em.employee_name, gb.gender_name, em.employee_pob, DATE_FORMAT(em.employee_dob, '%d %M %Y') as employee_dob, nb.nationality, cy.company_name, dt.department_name, pb.position_name, em.employee_identity, em.employee_jamsostek, sb.status_name, rb.religion_name FROM employee em JOIN gender_db gb ON em.gender = gb.gender_id JOIN nationality_db nb ON em.employee_nationality = nb.num_code JOIN company cy ON em.company_id = cy.company_id JOIN department dt ON em.department_id = dt.department_id JOIN position_db pb ON em.position_id = pb.position_id JOIN status_db sb ON em.employee_status = sb.status_id JOIN religion_db rb ON em.employee_religion = rb.religion_id WHERE em.id = '$employee_id';";
                            $get_employee_result = $connect->query($get_employee_query);

                            while ($get_employee_rows = $get_employee_result->fetch_assoc()) {
                                ?>

                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">
                                            Perusahaan
                                        </div>
                                        <div class="value-basic">
                                            <?php
                                            echo $get_employee_rows['company_name'];
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">
                                            Departemen
                                        </div>
                                        <div class="value-basic">
                                            <?php
                                            echo $get_employee_rows['department_name'];
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">
                                            Posisi
                                        </div>
                                        <div class="value-basic">
                                            <?php
                                            echo $get_employee_rows['position_name'];
                                            ?>
                                        </div>
                                    </div>
                                </div>



                                <?php
                            }
                            ?>
                        </div>

                    </div>
                    <div class="col-3">
                        <div class="card card-employee-1 pt-3 mt-3 pb-3">

                            <a href="read-only-personal.php?employee_id=<?= $employee_id ?>" style="text-decoration: none; margin-left: 5%;">
                                <div class="employee-name active">
                                    Informasi pribadi
                                </div>
                            </a>

                            <a href="read-only-address.php?employee_id=<?= $employee_id ?>" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Data alamat
                                </div>
                            </a>

                            <a href="read-only-emploment.php?employee_id=<?= $employee_id ?>" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Riwayat bekerja
                                </div>
                            </a>

                            <a href="read-only-education.php?employee_id=<?= $employee_id ?>" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Pendidikan
                                </div>
                            </a>

                            <a href="read-only-language.php?employee_id=<?= $employee_id ?>" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Kemampuan bahasa
                                </div>
                            </a>

                            <a href="" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Data keluarga
                                </div>
                            </a>

                            <a href="" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Pertanyaan
                                </div>
                            </a>

                            <a href="" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Pernyataan
                                </div>
                            </a>

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