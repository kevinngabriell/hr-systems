<?php
//set timezone
date_default_timezone_set('Asia/Jakarta');
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
//send message function
function sendMessage($chatID, $messaggio, $token)
{
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true);
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
//Function to generate a random ID
function generateRandomID()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomID = '';
    $length = 8; // You can adjust the length of the ID as needed

    for ($i = 0; $i < $length; $i++) {
        $randomID .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomID;
}

function isPermissionIdUnique($connect, $id_permission_log)
{
    $check_same_query = "SELECT id_permission_log FROM permission_log WHERE id_permission_log = '$id_permission_log'";
    $check_same_result = $connect->query($check_same_query);
    return $check_same_result->num_rows === 0;
}

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

//cek if submit
if (isset($_POST['submit'])) {

    $date = $_POST['date'];
    $reason = $_POST['reason'];
    $absen_time = $_POST['absen_time'];
    $current_date = date('Y-m-d H:i:s');
    $set_leave_status = "1";
    $permission_type = "PMTYPE-002";
    //generate random id 
    do {
        $randomIdPermission = generateRandomID();
    } while (!isPermissionIdUnique($connect, $randomIdPermission));
    //insert proses 
    $insert_permission_query = "INSERT IGNORE INTO permission_log (id_permission_log, permission_type, employee, permission_status, request_date, last_update_date, date, reason, time) VALUES ('$randomIdPermission', '$permission_type', '$employee_id', '1', '$current_date', '$current_date', '$date', '$reason', '$absen_time');";
    $insert_log_process = mysqli_query($connect, $insert_permission_query);
    if ($insert_log_process) {
        //looking for chat id data query
        $telegram_id_query = "SELECT chat_id FROM telegram_info WHERE employee_id = '$employee_id'";
        $telegram_id_result = $connect->query($telegram_id_query);
        //retrieve chat id
        while ($telegram_id_rows = $telegram_id_result->fetch_assoc()) {
            $chat_id = $telegram_id_rows['chat_id'];
        }
        //looking for spv employee id 
        $spv_query = "SELECT employee_spv FROM employee WHERE id = '$employee_id'";
        $spv_result = $connect->query($spv_query);
        //retrieve spv id
        while ($spv_rows = $spv_result->fetch_assoc()) {
            $spv_id = $spv_rows['employee_spv'];
        }
        //looking for spv chat id
        $telegram_spv_query = "SELECT chat_id FROM telegram_info WHERE employee_id = '$spv_id'";
        $telegram_spv_result = $connect->query($telegram_spv_query);
        //retrieve spv chat id
        while ($telegram_spv_rows = $telegram_spv_result->fetch_assoc()) {
            $spv_chat_id = $telegram_spv_rows['chat_id'];
        }
        //token and call chat id
        $token = "6663215498:AAHPYjolpr-i4ti0clZrxEVNKVXJnqwUT4s";
        $chatid = "$chat_id";
        sendMessage($chatid, "Dear Bapak/Ibu $employee_name_printed,

Pengajuan izin anda saat ini telah berhasil dilakukan. Anda akan menerima notifikasi jika izin anda telah disetujui. 
Pantau terus permohonan izin anda pada halaman dashboard.

Best Regards,
IT Support HR Systems", $token);
        $formatted_date = date("d M Y", strtotime($date));
        sendMessage($spv_chat_id, "Dear Bapak/Ibu, 

Saat ini salah satu anggota tim anda telah mengajukan izin masuk lebih siang melalui dashboard HR. Detail dari permohonan izin tersebut sebagai berikut : 

Nama karyawan : $employee_name_printed 
Izin : masuk siang 
Tanggal : $formatted_date 
Waktu : $absen_time
Alasan : $reason

Sebagai bagian dari prosedur perusahaan, kami membutuhkan konfirmasi dari Bapak/Ibu sebagai atasan agar dapat diproses lebih lanjut. 

Akses konfirmasi dapat Bapak/Ibu temukan pada halaman beranda sistem HR. 

Best Regards, 
IT Support HR Systems", $token);
        $message = "Pengajuan izin anda telah berhasil diajukan!!";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='../dashboard.php'; </script>";
    } else {

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
                                <label for="" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-5">
                                    <input type="date" class="form-control" name="date" id="date">
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="" class="col-sm-3 col-form-label">Alasan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="reason" id="reason">
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="" class="col-sm-3 col-form-label">Absen pada</label>
                                <div class="col-sm-5">
                                    <input type="time" class="form-control" name="absen_time" id="absen_time">
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


</body>

</html>