<?php

error_reporting(E_ERROR);

//check session when started
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('location: ../../../login.php');
}

function sendMessage($chatID, $messaggio, $token)
{
    //echo "sending message to " . $chatID . "\n";
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
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

$user_data_query = "SELECT em.id, em.employee_name, ecd.employee_email FROM users us JOIN employee em ON us.employee_id = em.id JOIN employee_contact_details_db ecd ON us.employee_id = ecd.id WHERE us.username = '$username';";
$user_data_results = $connect->query($user_data_query);

while ($user_data_row = $user_data_results->fetch_assoc()) {
    $employee_id_printed = $user_data_row['id'];
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

$supervised_query = "SELECT em.id, em.employee_name FROM employee em ;";
$supervised_result = $connect->query($supervised_query);

if (isset($_POST['submit'])) {

    $spv_id = $_POST['spv_id'];
    $_SESSION['spv_id'] = $spv_id;

    $search_chat_id = "SELECT chat_id FROM telegram_info WHERE employee_id = '$employee_id_printed'";
    $chat_id_result = $connect->query($search_chat_id);

    while ($chat_id_rows = $chat_id_result->fetch_assoc()) {
        $chat_id = $chat_id_rows['chat_id'];
    }

    $id_otp = rand(0000000000, 9999999999);
    $otp = rand(0000000, 999999);
    date_default_timezone_set('Asia/Jakarta');
    $created_date = date('Y-m-d H:i:s');
    $expired_date = date('Y-m-d H:i:s', strtotime('+ 15 minutes', strtotime($created_date)));

    $token = "6663215498:AAHPYjolpr-i4ti0clZrxEVNKVXJnqwUT4s";
    $chatid = "$chat_id";
    sendMessage($chatid, "Dear Bapak/Ibu Kevin,

Kode OTP anda adalah $otp. Kode tersebut akan berakhir dalam 15 menit. 

Abaikan pesan ini jika anda tidak melakukan hal apapun yang membutuhkan verifikasi lebih lanjut

Best Regards,
IT Support HR Systems", $token);

    $insert_otp_query = "INSERT IGNORE INTO otp_log (otp, created_time, expired_time) VALUES ('$otp', '$created_date', '$expired_date');";
    $insert_otp_process = mysqli_query($connect, $insert_otp_query);

    if ($insert_otp_process) {
        header("location: spv-otp-checker.php?employee_id=$employee_id");
    } else {
        $message = "OTP Gagal Dikirim!!";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
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


                <nav class="nav flex-column flex-sm-row">
                    <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="#">Overview</a>
                    <a class="flex-sm-fill text-sm-center nav-link"
                        href="employee-details-absensi.php?employee_id=<?php echo $employee_id ?>">Absensi</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-perfoma.html">Perfoma</a>
                    <a class="flex-sm-fill text-sm-center nav-link"
                        href="employee-details-permohonan.php?employee_id=<?php echo $employee_id ?>">Permohonan</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-dokumen.html">Dokumen</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-catatan.html">Catatan</a>
                    <a class="flex-sm-fill text-sm-center nav-link"
                        href="employee-details-riwayat.php?employee_id=<?php echo $employee_id ?>">Riwayat</a>
                </nav>

                <form action="" method="post">
                    <div class="row mt-3" style="text-align : left;">
                        <div class="col">
                            <div class="row d-flex align-items-center mt-1">
                                <div class="col-4">
                                    <div class="employee-name-label">Nama karyawan</div>
                                </div>
                                <div class="col">
                                    <div class="employee-name-value">
                                        <?php echo $data_employee_name ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center mt-2">
                                <div class="col-4">
                                    <div class="employee-name-label">Departemen</div>
                                </div>
                                <div class="col">
                                    <div class="employee-name-value">
                                        <?php echo $data_employee_department ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center mt-2">
                                <div class="col-4">
                                    <div class="employee-name-label">Posisi</div>
                                </div>
                                <div class="col">
                                    <div class="employee-name-value">
                                        <?php echo $data_employee_position ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center mt-2">
                                <div class="col-4">
                                    <label for="" class="employee-name-label">Supervisor</label>
                                </div>
                                <div class="col">
                                    <select name="spv_id" id="spv_id" class="form-select">
                                        <?php
                                        while ($supervised_rows = mysqli_fetch_array($supervised_result)):
                                            ?>
                                            <option value="<?php echo $supervised_rows['id'] ?>">
                                                <?php echo $supervised_rows['employee_name'] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>
                            </div>



                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <button class="btn btn-submit-form-employee" id="submit" name="submit" type="submit">Submit</button>
                </form>


            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
        <script>


        </script>
</body>

</html>