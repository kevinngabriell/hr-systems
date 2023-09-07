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

$employee_name = $_SESSION['employee_name'];

//retrieve company name
$company_data_query = "SELECT cy.company_name, cy.company_address FROM users us JOIN company cy ON us.company_id = cy.company_id;";
$company_data_result = $connect->query($company_data_query);

while ($company_data_row = $company_data_result->fetch_assoc()) {
    $company_name_printed = $company_data_row['company_name'];
    $company_address_printed = $company_data_row['company_address'];
}

if(isset($_POST['submit'])){

    $allowed_ext = array('pdf', 'png', 'jpeg');

    $ktp = $_FILES['file_ktp']['name'];
    $x_ktp = explode('.', $ktp);
    $ekstensi_ktp = strtolower(end($x_ktp));
    $ktp_size = $_FILES['file_ktp']['size'];
    $ktp_tmp = $_FILES['file_ktp']['tmp_name'];
    $ktp_format = "KTP - " . $employee_name;
    $new_format_ktp = $ktp_format . '.' . $ekstensi_ktp;

    if(in_array($ekstensi_ktp, $allowed_ext) == true){
        if($ktp_size < 10044070){
            move_uploaded_file($ktp_tmp, 'file/'.$new_format_ktp);
        } else {
            $message = "Ukuran KTP terlalu besar";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    $sim_a = $_FILES['file_sim_a']['name'];
    $x_sim_a = explode('.', $sim_a);
    $ekstensi_sim_a = strtolower(end($x_sim_a));
    $sim_a_size = $_FILES['file_sim_a']['size'];
    $sim_a_tmp = $_FILES['file_sim_a']['tmp_name'];
    $sim_a_format = "SIM A - " . $employee_name;
    $new_format_sim_a = $sim_a_format . '.' . $ekstensi_sim_a;

    if(in_array($ekstensi_sim_a, $allowed_ext) == true){
        if($sim_a_size < 10044070){
            move_uploaded_file($sim_a_tmp, 'file/'.$new_format_sim_a);
        } else {
            $message = "Ukuran SIM A terlalu besar";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    $sim_c = $_FILES['file_sim_c']['name'];
    $x_sim_c = explode('.', $sim_c);
    $ekstensi_sim_c = strtolower(end($x_sim_c));
    $sim_c_size = $_FILES['file_sim_c']['size'];
    $sim_c_tmp = $_FILES['file_sim_c']['tmp_name'];
    $sim_c_format = "SIM C - " . $employee_name;
    $new_format_sim_c = $sim_c_format . '.' . $ekstensi_sim_c;

    if(in_array($ekstensi_sim_c, $allowed_ext) == true){
        if($sim_c_size < 10044070){
            move_uploaded_file($sim_c_tmp, 'file/'.$new_format_sim_c);
        } else {
            $message = "Ukuran SIM C terlalu besar";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    $npwp = $_FILES['file_npwp']['name'];
    $x_npwp = explode('.', $npwp);
    $ekstensi_npwp = strtolower(end($x_npwp));
    $npwp_size = $_FILES['file_npwp']['size'];
    $npwp_tmp = $_FILES['file_npwp']['tmp_name'];
    $npwp_format = "NPWP - " . $employee_name;
    $new_format_npwp = $npwp_format . '.' . $ekstensi_npwp;

    if(in_array($ekstensi_npwp, $allowed_ext) == true){
        if($npwp_size < 10044070){
            move_uploaded_file($npwp_tmp, 'file/'.$new_format_npwp);
        } else {
            $message = "Ukuran NPWP terlalu besar";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    $bpjs = $_FILES['file_bpjs']['name'];
    $x_bpjs = explode('.', $bpjs);
    $ekstensi_bpjs = strtolower(end($x_bpjs));
    $bpjs_size = $_FILES['file_bpjs']['size'];
    $bpjs_tmp = $_FILES['file_bpjs']['tmp_name'];
    $BPJS_format = "BPJS - " . $employee_name;
    $new_format_bpjs = $BPJS_format . '.' . $ekstensi_bpjs;

    if(in_array($ekstensi_bpjs, $allowed_ext) == true){
        if($bpjs_size < 10044070){
            move_uploaded_file($bpjs_tmp, 'file/'.$new_format_bpjs);
        } else {
            $message = "Ukuran BPJS terlalu besar";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    $get_id_query = "SELECT id FROM employee ORDER BY id DESC LIMIT 1";
    $last_id = mysqli_query($connect, $get_id_query);

    while($last_id_row = $last_id->fetch_assoc()){
        $employee_id = $last_id_row['id'];
    }

    $agreement_docs_query = "INSERT INTO employee_docs_agreement (id, is_agree, file_ktp, file_sim_a, file_sim_c, file_npwp, file_bpjs) VALUES ('$employee_id', 'Yes', '$new_format_ktp', '$new_format_sim_a', '$new_format_sim_c', '$new_format_npwp', '$new_format_bpjs');";
    $agreement_docs_result = mysqli_query($connect, $agreement_docs_query);

    if($agreement_docs_result){
        $message = "Data telah berhasil diinput !!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        unset($_SESSION['employee_name']);
        header("location: ../employee.php");
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
                <div class="main-menu-text">Main Menu</div>

                <!-- Navigation links in sidebar-->
                <a href="../../dashboard.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Asset20.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Dashboard</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../employee.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu">
                        <div class="col-3">
                            <img src="../../../Assets/Asset21.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Employee</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../payroll.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Asset11.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Payroll</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../performance.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Asset9.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Performance</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../training.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Asset16.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Training</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../event.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Asset8.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Event</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../report.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Asset12.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Report</div>
                    </div>
                </a>

                <!-- main menu text -->
                <div class="mt-4 main-menu-text">Settings</div>

                <!-- Navigation links in sidebar-->
                <a href="../../company-setting.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Asset14.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Company Settings</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../structure.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Asset13.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Structure</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../attandance-setting.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../Assets/Asset7.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Attandance Setting</div>
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

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row mt-4 mb-5 d-flex justify-items-center">
                        <div class="col justify-items-center">

                            <div class="mb-3">
                                <label for="formFile" class="form-label form-new-question">Upload file KTP</label>
                                <input class="form-control" type="file" id="file_ktp" name="file_ktp" accept="image/jpeg,image/png,application/pdf">
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label form-new-question">Upload file SIM A</label>
                                <input class="form-control" type="file" id="file_sim_a" name="file_sim_a" accept="image/jpeg,image/png,application/pdf" >
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label form-new-question">Upload file SIM C</label>
                                <input class="form-control" type="file" id="file_sim_c" name="file_sim_c" accept="image/jpeg,image/png,application/pdf" >
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label form-new-question">Upload file NPWP</label>
                                <input class="form-control" type="file" id="file_npwp" name="file_npwp" accept="image/jpeg,image/png,application/pdf" >
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label form-new-question">Upload file BPJS</label>
                                <input class="form-control" type="file" id="file_bpjs" name="file_bpjs" accept="image/jpeg,image/png,application/pdf" >
                            </div>

                            <p class="form-new-question mt-5" style="text-align: center;">Pernyataan</p>
                            <p style="text-align: justify;">1. Saya menyatakan bahwa keterangan di atas saya buat dengan
                                benar, dan mengerti apabila keterangan tersebut tidak benar maka saya bersedia
                                mempertanggung jawabkannya sesuai dengan ketentuan perusahaan dan atau hukum yang
                                berlaku.</p>
                            <p style="text-align: justify;">2. Saya menyetujui untuk mengikuti peraturan
                                perusahaan/kebijaksanaan yang ditujukan kepada saya atau yang tercantum dalam
                                KKB/peraturan perusahaan yang berlaku.</p>
                            <p style="text-align: justify;">3. Saya mengerti bahwa penerimaan menjadi karyawan bisa
                                batal apabila hasil pemeriksaan yang diselenggarakan oleh perusahaan membuktikan bahwa
                                saya memberikan keterangan palsu atau yang dipalsukan baik sebelum atau pada saat saya
                                bekerja dengan perusahaan</p>

                            <button type="submit" id="submit" name="submit" class="btn mt-4 btn-submit-form-employee">Submit</button>

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