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

$user_data_query = "SELECT em.employee_name, ecd.employee_email FROM users us JOIN employee em ON us.employee_id = em.id JOIN employee_contact_details_db ecd ON us.employee_id = ecd.id WHERE us.username = '$username';";
$user_data_results = $connect->query($user_data_query);

while ($user_data_row = $user_data_results->fetch_assoc()) {
    $employee_name_printed = $user_data_row['employee_name'];
    $employee_email_printed = $user_data_row['employee_email'];
}

//retrieve job source
$job_source_query = "SELECT * FROM job_source_db";
$job_source_result = mysqli_query($connect, $job_source_query);

//retrieve hubungan kerja
$hubungan_kerja_query = "SELECT * FROM hubungan_kerja_db";
$hubungan_kerja_result = mysqli_query($connect, $hubungan_kerja_query);

if (isset($_POST['submit'])) {

    $job_source_answer = $_POST['job_source_answer'];
    $job_source_answer_exp = $_POST['job_source_answer_exp'];
    $contact_last_comp = $_POST['contact_last_comp'];
    $position_applied = $_POST['position_applied'];
    $position_alternate = $_POST['position_alternate'];
    $expected_salary = $_POST['expected_salary'];
    $hubungan_kerja_answer = $_POST['hubungan_kerja_answer'];
    $is_ever_award = $_POST['is_ever_award'];
    $is_ever_award_exp = $_POST['is_ever_award_exp'];
    $hobby_answer = $_POST['hobby_answer'];
    $is_ever_org = $_POST['is_ever_org'];
    $is_ever_org_exp = $_POST['is_ever_org'];
    $is_day_unv = $_POST['is_day_unv'];
    $is_day_unv_exp = $_POST['is_day_unv_exp'];
    $is_any_sim = $_POST['is_any_sim'];
    $sim_a_end = $_POST['sim_a_end'];
    $sim_c_end = $_POST['sim_c_end'];
    $is_fired = $_POST['is_fired'];
    $is_fired_exp = $_POST['is_fired_exp'];
    $is_jailed = $_POST['is_jailed'];
    $is_jailed_exp = $_POST['is_jailed_exp'];
    $is_sick = $_POST['is_sick'];
    $is_sick_exp = $_POST['is_sick_exp'];
    $is_smoke = $_POST['is_smoke'];

    $emergency_name = $_POST['emergency_name'];
    $emergency_hubungan = $_POST['emergency_hubungan'];
    $emergency_phone = $_POST['emergency_phone'];
    $emergency_address = $_POST['emergency_address'];
    $emergency_name_2 = $_POST['emergency_name_2'];
    $emergency_hubungan_2 = $_POST['emergency_hubungan_2'];
    $emergency_phone_2 = $_POST['emergency_phone_2'];
    $emergency_address_2 = $_POST['emergency_address_2'];

    $get_id_query = "SELECT id FROM employee ORDER BY id DESC LIMIT 1";
    $last_id = mysqli_query($connect, $get_id_query);

    while ($last_id_row = $last_id->fetch_assoc()) {
        $employee_id = $last_id_row['id'];
    }

    $insert_question_query = "INSERT IGNORE INTO employee_question (id, job_source_answer, job_source_answer_exp, contact_last_comp, position_applied, position_alternate, expected_salary, hubungan_kerja_answer, is_ever_award, is_ever_award_exp, hobby_answer, is_ever_org, is_ever_org_exp, is_day_unv, is_day_unv_exp, is_any_sim, sim_a_end, sim_c_end, is_fired, is_fired_exp, is_jailed, is_jailed_exp, is_sick, is_sick_exp, is_smoke) VALUES 
    ('$employee_id', '$job_source_answer', '$job_source_answer_exp', '$contact_last_comp', '$position_applied', '$position_alternate', '$expected_salary', '$hubungan_kerja_answer', '$is_ever_award', '$is_ever_award_exp', '$hobby_answer', '$is_ever_org', '$is_ever_org_exp', '$is_day_unv', '$is_day_unv_exp', '$is_any_sim', '$sim_a_end', '$sim_c_end', '$is_fired', '$is_fired_exp', '$is_jailed', '$is_jailed_exp', '$is_sick', '$is_sick_exp', '$is_smoke');";
    $insert_question_result = mysqli_query($connect, $insert_question_query);

    $insert_emergency_query = "INSERT INTO employee_emergency_contact (id, emergency_name, emergency_hubungan, emergency_phone, emergency_address, emergency_name_2, emergency_hubungan_2, emergency_phone_2, emergency_address_2) VALUES ('$employee_id', '$emergency_name', '$emergency_hubungan', '$emergency_phone', '$emergency_address', '$emergency_name_2', '$emergency_hubungan_2', '$emergency_phone_2', '$emergency_address_2');";
    $insert_emergency_result = mysqli_query($connect, $insert_emergency_query);

    if ($insert_question_result && $insert_emergency_result) {
        header("location: form-new-employee-agreement.php");
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

                            <p class="form-new-question">Dari mana anda mengetahui tentang lowongan ini ?</p>
                            <div class="row">
                                <div class="col-4">
                                    <select class="form-select" id="job_source_answer" name="job_source_answer">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($job_source_rows = mysqli_fetch_array($job_source_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $job_source_rows["job_source_id"]; ?>">
                                                <?php echo $job_source_rows["job_source_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="text" name="job_source_answer_exp" id="job_source_answer_exp"
                                        class="form-control">
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Bolehkah kami menghubungi perusahaan sebelumnya tempat
                                Anda bekerja?</p>
                            <div class="row">
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes"
                                            id="contact_last_comp" name="contact_last_comp">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="no"
                                            id="contact_last_comp" name="contact_last_comp">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Posisi apa yang anda lamar?</p>
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" name="position_applied" id="position_applied"
                                        class="form-control">
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Apa posisi alternatif yang anda inginkan?</p>
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" name="position_alternate" id="position_alternate"
                                        class="form-control">
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Berapa gaji yang anda harapkan?</p>
                            <div class="row">
                                <div class="col-8">
                                    <input type="number" name="expected_salary" id="expected_salary"
                                        class="form-control">
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Apa hubungan kerja yang anda inginkan?</p>
                            <div class="row">
                                <div class="col-8">
                                    <select class="form-select" id="hubungan_kerja_answer" name="hubungan_kerja_answer">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($hubungan_kerja_rows = mysqli_fetch_array($hubungan_kerja_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $hubungan_kerja_rows["hubungan_kerja_id"]; ?>">
                                                <?php echo $hubungan_kerja_rows["hubungan_kerja_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Apakah anda pernah mendapatkan prestasi?</p>
                            <div class="row d-flex align-items-center">
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes" id="is_ever_award"
                                            name="is_ever_award">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="no" id="is_ever_award"
                                            name="is_ever_award">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="is_ever_award_exp" id="is_ever_award_exp"
                                        class="form-control">
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Apa hobby, olahraga atau minat anda?</p>
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" name="hobby_answer" id="hobby_answer" class="form-control">
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Apakah anda pernah menjadi bagian dari sebuah organisasi?
                            </p>
                            <div class="row d-flex align-items-center">
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes" id="is_ever_org"
                                            name="is_ever_org">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="no" id="is_ever_org"
                                            name="is_ever_org">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="is_ever_org_exp" id="is_ever_org_exp" class="form-control">
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Apakah ada hari tertentu anda tidak dapat bekerja?</p>
                            <div class="row d-flex align-items-center">
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes" id="is_day_unv"
                                            name="is_day_unv">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="no" id="is_day_unv"
                                            name="is_day_unv">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="is_day_unv_exp" id="is_day_unv_exp" class="form-control">
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Apakah anda memiliki SIM?</p>
                            <div class="row d-flex align-items-center">
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes" id="is_any_sim"
                                            name="is_any_sim">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="np" id="is_any_sim"
                                            name="is_any_sim">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <p class="form-new-question mt-4">Masa Akhir SIM A</p>
                                    <input type="date" name="sim_a_end" id="sim_a_end" class="form-control">
                                </div>
                                <div class="col">
                                    <p class="form-new-question mt-4">Masa Akhir SIM C</p>
                                    <input type="date" name="sim_c_end" id="sim_c_end" class="form-control">
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Apakah anda diberhentikan dari perusahaan sebelumnya?</p>
                            <div class="row d-flex align-items-center">
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes" id="is_fired"
                                            name="is_fired">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="no" id="is_fired"
                                            name="is_fired">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="is_fired_exp" id="is_fired_exp" class="form-control">
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Apakah anda pernah dihukum?</p>
                            <div class="row d-flex align-items-center">
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes" id="is_jailed"
                                            name="is_jailed">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="no" id="is_jailed"
                                            name="is_jailed">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="is_jailed_exp" id="is_jailed_exp" class="form-control">
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Apakah anda mempunyai penyakit/cacat yang dapat menganggu
                                aktivitas?</p>
                            <div class="row d-flex align-items-center">
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes" id="is_sick"
                                            name="is_sick">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="no" id="is_sick"
                                            name="is_sick">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="is_sick_exp" id="is_sick_exp" class="form-control">
                                </div>
                            </div>

                            <p class="form-new-question mt-4">Apakah anda merokok?</p>
                            <div class="row d-flex align-items-center">
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes" id="is_smoke"
                                            name="is_smoke">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Ya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="no" id="is_smoke"
                                            name="is_smoke">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr class="hr" />

                            <p class="form-new-question mt-4">Kontak darurat</p>
                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-new-employee-emergency-label mb-1">Nama lengkap</label>
                                    <input type="text" name="emergency_name" id="emergency_name" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-emergency-label mb-1">Hubungan</label>
                                    <input type="text" name="emergency_hubungan" id="emergency_hubungan"
                                        class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-emergency-label mb-1">Nomor telepon</label>
                                    <input type="text" name="emergency_phone" id="emergency_phone" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-emergency-label mb-1">Alamat</label>
                                    <textarea class="form-control" name="emergency_address" id="emergency_address"
                                        cols="10" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-emergency-label mb-1">Nama lengkap</label>
                                    <input type="text" name="emergency_name_2" id="emergency_name_2"
                                        class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-emergency-label mb-1">Hubungan</label>
                                    <input type="text" name="emergency_hubungan_2" id="emergency_hubungan_2"
                                        class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-emergency-label mb-1">Nomor telepon</label>
                                    <input type="text" name="emergency_phone_2" id="emergency_phone_2"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-emergency-label mb-1">Alamat</label>
                                    <textarea class="form-control" name="emergency_address_2" id="emergency_address_2"
                                        cols="10" rows="3"></textarea>
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