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

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

$get_answer_query = "SELECT js.job_source_name, eq.job_source_answer_exp, eq.contact_last_comp, eq.position_applied, eq.position_alternate, eq.expected_salary, hk.hubungan_kerja_name, eq.is_ever_award, eq.is_ever_award_exp, eq.hobby_answer, eq.is_ever_org, eq.is_ever_org_exp, eq.is_day_unv, eq.is_day_unv_exp, eq.is_any_sim, eq.sim_a_end, eq.sim_c_end, eq.is_fired, eq.is_fired_exp, eq.is_jailed, eq.is_jailed_exp, eq.is_sick, eq.is_sick_exp, eq.is_smoke FROM employee_question eq JOIN job_source_db js ON eq.job_source_answer = js.job_source_id JOIN hubungan_kerja_db hk ON eq.hubungan_kerja_answer = hk.hubungan_kerja_id WHERE eq.id = '$employee_id';";
$get_answer_result = $connect->query($get_answer_query);

while ($get_answer_row = $get_answer_result->fetch_assoc()) {
    $job_source = $get_answer_row['job_source_name'];
    $job_source_exp = $get_answer_row['job_source_answer_exp'];
    $confirmation_last_company = $get_answer_row['contact_last_comp'];
    $first_position = $get_answer_row['position_applied'];
    $alternate_position = $get_answer_row['position_alternate'];
    $expected_salary = $get_answer_row['expected_salary'];
    $hubungan_kerja_name = $get_answer_row['hubungan_kerja_name'];
    $is_ever_award = $get_answer_row['is_ever_award'];
    $is_ever_award_exp = $get_answer_row['is_ever_award_exp'];
    $hobby = $get_answer_row['hobby_answer'];
    $is_ever_org = $get_answer_row['is_ever_org'];
    $is_ever_org_exp = $get_answer_row['is_ever_org_exp'];
    $is_day_unavail = $get_answer_row['is_day_unv'];
    $is_day_unavail_exp = $get_answer_row['is_day_unv_exp'];
    $is_any_sim = $get_answer_row['is_any_sim'];
    $sim_a_end = $get_answer_row['sim_a_end'];
    $sim_c_end = $get_answer_row['sim_c_end'];
    $is_fired = $get_answer_row['is_fired'];
    $is_fired_exp = $get_answer_row['is_fired_exp'];
    $is_jailed = $get_answer_row['is_jailed'];
    $is_jailed_exp = $get_answer_row['is_jailed_exp'];
    $is_sick = $get_answer_row['is_sick'];
    $is_sick_exp = $get_answer_row['is_sick_exp'];
    $is_smoke = $get_answer_row['is_smoke'];
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
                    <a href="../employee-details.php?employee_id=<?php echo $employee_id ?>"
                        style="text-decoration: none;">
                        <div class="back">
                            < Back </div>
                    </a>
                </div>

                <div class="row d-flex align-items-center">
                    <div class="col profile-employee-title">
                        Profile Karyawan
                    </div>
                </div>

                <!-- <nav class="nav flex-column flex-sm-row">
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
                </nav> -->

                <div class="row">
                    <div class="col">

                        <div class="card card-employee-1 mt-3">

                            <div class="basic-information">
                                Pertanyaan
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col">
                                    <div class="label-basic-information">Informasi lowongan</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($job_source || $job_source_exp != NULL) {
                                            echo $job_source . ", " . $job_source_exp;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Persetujuan konfirmasi</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($confirmation_last_company != NULL) {
                                            echo $confirmation_last_company;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Hubungan kerja</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($hubungan_kerja_name != NULL) {
                                            echo $hubungan_kerja_name;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <div class="label-basic-information">Posisi utama</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($first_position != NULL) {
                                            echo $first_position;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Posisi alternatif</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($alternate_position != NULL) {
                                            echo $alternate_position;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Gaji yang diharapkan</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($expected_salary != NULL) {
                                            echo rupiah($expected_salary);
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <div class="label-basic-information">Prestasi</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($is_ever_award != NULL) {
                                            echo $is_ever_award;
                                            if ($is_ever_award_exp != NULL) {
                                                echo ", " . $is_ever_award_exp;
                                            } else {

                                            }
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Hobi</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($hobby != NULL) {
                                            echo $hobby;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Organisasi</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($is_ever_org != NULL) {
                                            echo $is_ever_org;
                                            if ($is_ever_org_exp != NULL) {
                                                echo ", " . $is_ever_org_exp;
                                            } else {

                                            }
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <div class="label-basic-information">Hari tertentu</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($is_day_unavail != NULL) {
                                            echo $is_day_unavail;
                                            if ($is_day_unavail_exp != NULL) {
                                                echo ", " . $is_day_unavail_exp;
                                            } else {

                                            }
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Diberhentikan</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($is_fired != NULL) {
                                            echo $is_fired;
                                            if ($is_fired_exp != NULL) {
                                                echo ", " . $is_fired_exp;
                                            } else {

                                            }
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Dipenjara</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($is_jailed != NULL) {
                                            echo $is_jailed;
                                            if ($is_jailed_exp != NULL) {
                                                echo ", " . $is_jailed_exp;
                                            } else {

                                            }
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <div class="label-basic-3">Penyakit/Cacat</div>
                                    <div class="value-basic-3">
                                        <?php
                                        if ($is_sick != NULL) {
                                            echo $is_sick;
                                            if ($is_sick_exp != NULL) {
                                                echo ", " . $is_sick_exp;
                                            } else {

                                            }
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-3">Merokok</div>
                                    <div class="value-basic-3">
                                        <?php
                                        if ($is_smoke != NULL) {
                                            echo $is_smoke;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card card-employee-1 mt-3">
                            <div class="basic-information">
                                SIM
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col">
                                    <div class="label-basic-3">SIM A</div>
                                    <div class="value-basic-3">
                                    <?php
                                        if ($sim_a_end != NULL) {
                                            echo $sim_a_end;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-3">SIM C</div>
                                    <div class="value-basic-3">
                                    <?php
                                        if ($sim_c_end != NULL) {
                                            echo $sim_c_end;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-3">
                        <div class="card card-employee-1 pt-3 mt-3 pb-3">

                            <a href="read-only-personal.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-left: 5%;">
                                <div class="employee-name">
                                    Informasi pribadi
                                </div>
                            </a>

                            <a href="read-only-address.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Data alamat
                                </div>
                            </a>

                            <a href="read-only-emploment.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Riwayat bekerja
                                </div>
                            </a>

                            <a href="read-only-education.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Pendidikan
                                </div>
                            </a>

                            <a href="read-only-language.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Kemampuan bahasa
                                </div>
                            </a>

                            <a href="read-only-family.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Data keluarga
                                </div>
                            </a>

                            <a href="read-only-question.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name active">
                                    Pertanyaan
                                </div>
                            </a>

                            <!-- <a href="" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Pernyataan
                                </div>
                            </a> -->

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