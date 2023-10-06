<?php

//check session when started
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('location: ../../login.php');
}

//connection 
include("../../Conn/connection.php");

//set username variable from session
$username = $_SESSION['username'];

//retrieve company name
$company_data_query = "SELECT cy.company_id, cy.company_name, cy.company_address FROM users us JOIN company cy ON us.company_id = cy.company_id WHERE us.username = '$username';";
$company_data_result = $connect->query($company_data_query);

while ($company_data_row = $company_data_result->fetch_assoc()) {
    $company_name_printed = $company_data_row['company_name'];
    $company_address_printed = $company_data_row['company_address'];
    $company_id_printed = $company_data_row['company_id'];
}

$user_data_query = "SELECT em.employee_name, ecd.employee_email, em.id FROM users us JOIN employee em ON us.employee_id = em.id JOIN employee_contact_details_db ecd ON us.employee_id = ecd.id WHERE us.username = '$username';";
$user_data_results = $connect->query($user_data_query);

while ($user_data_row = $user_data_results->fetch_assoc()) {
    $employee_id = $user_data_row['id'];
    $employee_name_printed = $user_data_row['employee_name'];
    $employee_email_printed = $user_data_row['employee_email'];
}

//retrieve permission type
$permission_type_query = "SELECT * FROM permission_type";
$permission_type_result = mysqli_query($connect, $permission_type_query);

//get employee data
$employee_summary_query = "SELECT em.employee_name, pd.position_name, dp.department_name FROM employee em JOIN department dp ON em.department_id = dp.department_id JOIN position_db pd ON em.position_id = pd.position_id JOIN users us ON em.id = us.employee_id WHERE us.username = '$username';";
$employee_summary_result = $connect->query($employee_summary_query);

while ($employee_summary_rows = $employee_summary_result->fetch_assoc()) {
    $employee_name = $employee_summary_rows['employee_name'];
    $position_name = $employee_summary_rows['position_name'];
    $department_name = $employee_summary_rows['department_name'];
}

//retrieve leave remaining allowance
$remain_leave = "SELECT leave_remaining FROM leave_allowance WHERE employee_id = '$employee_id'";
$remain_result = mysqli_query($connect, $remain_leave);

while ($remain_rows = $remain_result->fetch_assoc()) {
    $leave_remaining = $remain_rows['leave_remaining'];
}

//retrieve employee list
$list_employee = "SELECT employee.id,employee.employee_name FROM employee;";
$list_result = mysqli_query($connect, $list_employee);

//cek if submit
if (isset($_POST['submit'])) {

    $start_leave = $_POST['start_leave'];
    $end_leave = $_POST['end_leave'];
    $phone_number = $_POST['phone_number'];
    $reason = $_POST['reason'];
    $employee_change = $_POST['employee_change'];

    $random_id = rand(100, 9999999999);
    $set_leave_status = "1";

    $start_leave_formatted = strtotime($start_leave);
    $end_leave_formatted = strtotime($end_leave);
    $countdays = $end_leave_formatted - $start_leave_formatted;
    $countdays = $countdays / (60 * 60 * 24);
    $leave_operation = $leave_remaining - $countdays;

    date_default_timezone_set('Asia/Jakarta');
    $current_date = date('Y-m-d H:i:s');

    if ($countdays > $leave_remaining) {
        $message = "Jatah cuti anda tidak mencukupi !!";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='../dashboard.php';</script>";
    } else {
        $insert_log_query = "INSERT IGNORE INTO leave_allowance_log (id_leave_log, employee_id, start_leave, end_leave, phone_number, reason, employee_change, id_leave_status, reject_reason, request_date, last_update_date) VALUES ('$random_id', '$employee_id', '$start_leave', '$end_leave', '$phone_number', '$reason', '$employee_change', '$set_leave_status', NULL, '$current_date', '$current_date');";
        $insert_log_process = mysqli_query($connect, $insert_log_query);

        $update_leave_query = "UPDATE leave_allowance SET leave_remaining = '$leave_operation' WHERE employee_id = '$employee_id';";
        $update_leave_process = mysqli_query($connect, $update_leave_query);

        if ($insert_log_process) {
            $message = "Sukses !!";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='../dashboard.php';</script>";
        } else {
            $message = "Gagal !!";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='../dashboard.php';</script>";
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard HR Systems</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="dashboardstyle.css" />
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
                        <img src="../../Assets/company-logo.png" alt="" />
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
                <a href="../dashboard.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu">
                        <div class="col-3">
                            <img src="../../Assets/home-logo-active.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Beranda</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../employee/employee.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../Assets/Employee-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Karyawan</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../payroll.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../Assets/Payroll-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Gaji</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../performance.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../Assets/Performance-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Performa</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../training.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../Assets/Training-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Pelatihan</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../event.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../Assets/Event-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Acara</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../report.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../Assets/Report-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Laporan</div>
                    </div>
                </a>

                <!-- main menu text -->
                <div class="mt-4 main-menu-text">Pengaturan</div>

                <!-- Navigation links in sidebar-->
                <a href="../company-setting.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../Assets/CompanySetting-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Perusahaan</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../structure.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../Assets/Structure-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Struktur</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../attandance-setting.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../Assets/Attandance-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Kehadiran</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../logout.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-logout">
                        <div class="col-3">
                            <img src="../../Assets/Asset15.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Keluar</div>
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
                            <a href="dashboard.php" class="nav-item nav-text-dashboard">Izin</a>
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
                                    <img src="../../Assets/Asset17.png" class="img-right-side" />
                                </div>
                            </div>
                        </div>
                        <!-- third column of top navbar -->
                        <div class="col">
                            <!-- row of profile @top navbar -->
                            <div class="row d-flex align-items-center">
                                <!-- profile picture -->
                                <div class="col-2">
                                    <img src="../../Assets/company-logo.png" class="img-right-side" />
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
                    <div class="col">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly value="<?= $employee_name ?>"
                                        name="" id="">
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="" class="col-sm-3 col-form-label">Jabatan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly value="<?= $position_name ?>"
                                        name="" id="">
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="" class="col-sm-3 col-form-label">Divisi</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly value="<?= $department_name ?>"
                                        name="" id="">
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="" class="col-sm-3 col-form-label">Periode cuti</label>
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col">
                                            <input type="date" class="form-control" name="start_leave" id="start_leave">
                                        </div>
                                        <div class="col">
                                            <input type="date" class="form-control" name="end_leave" id="end_leave">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="" class="col-sm-3 col-form-label">Sisa cuti</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly
                                        value=" <?php $isset = isset($leave_remaining);
                                        if ($isset == false) {
                                            echo "Belum ada data cuti";
                                        } else {
                                            echo $leave_remaining;
                                        } ?>"
                                        name="" id="">
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="" class="col-sm-3 col-form-label">Nomor telepon</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="phone_number" id="phone_number">
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="" class="col-sm-3 col-form-label">Alasan</label>
                                <div class="col-sm-5">
                                    <textarea name="reason" id="reason" class="form-control" cols="30"
                                        rows="2"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="" class="col-sm-3 col-form-label">Pengganti</label>
                                <div class="col-sm-5">
                                    <select name="employee_change" id="employee_change" class="form-select">
                                        <?php
                                        while ($list_rows = mysqli_fetch_array($list_result, MYSQLI_ASSOC)):
                                            ?>
                                            <option value="<?php echo $list_rows["id"] ?>">
                                                <?php echo $list_rows["employee_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-submit-permission mt-4" id="submit" name="submit"
                                type="submit">Submit</button>
                        </form>
                    </div>
                    <div class="col-4">
                        <!-- <div class="card card-style-1">
                            Riwayat cuti
                        </div> -->
                    </div>
                </div>


            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>



    <script>
        var chrt = document.getElementById("chartId").getContext("2d");
        var chartId = new Chart(chrt, {
            type: 'doughnut',
            data: {
                labels: ["HTML", "CSS", "JAVASCRIPT", "CHART.JS", "JQUERY", "BOOTSTRP"],
                datasets: [{
                    label: "online tutorial subjects",
                    data: [20, 40, 13, 35, 20, 38],
                    backgroundColor: ['yellow', 'aqua', 'pink', 'lightgreen', 'gold', 'lightblue'],
                    hoverOffset: 5
                }],
            },
            options: {
                responsive: false,
            },
        });
    </script>
</body>

</html>