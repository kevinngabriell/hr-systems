<?php

//check session when started
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('location:../../../login.php');
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

//retrieve education type
$education_type_query = "SELECT * FROM education_db";
$education_type_result = mysqli_query($connect, $education_type_query);
$education_type_result_2 = mysqli_query($connect, $education_type_query);
$education_type_result_3 = mysqli_query($connect, $education_type_query);
$education_type_result_4 = mysqli_query($connect, $education_type_query);
$education_type_result_5 = mysqli_query($connect, $education_type_query);

if(isset($_POST['submit'])){

    //gather employee education
    $education_type_1 = $_POST['education_type_1'];
    $education_name_1 = $_POST['education_name_1'];
    $education_major_1 = $_POST['education_major_1'];
    $education_grade_1 = $_POST['education_grade_1'];
    $education_start_1 = $_POST['education_start_1'];
    $education_end_1 = $_POST['education_end_1'];
    $education_desc_1 = $_POST['education_desc_1'];

    $education_type_2 = $_POST['education_type_2'];
    $education_name_2 = $_POST['education_name_2'];
    $education_major_2 = $_POST['education_major_2'];
    $education_grade_2 = $_POST['education_grade_2'];
    $education_start_2 = $_POST['education_start_2'];
    $education_end_2 = $_POST['education_end_2'];
    $education_desc_2 = $_POST['education_desc_2'];

    $education_type_3 = $_POST['education_type_3'];
    $education_name_3 = $_POST['education_name_3'];
    $education_major_3 = $_POST['education_major_3'];
    $education_grade_3 = $_POST['education_grade_3'];
    $education_start_3 = $_POST['education_start_3'];
    $education_end_3 = $_POST['education_end_3'];
    $education_desc_3 = $_POST['education_desc_3'];

    $education_type_4 = $_POST['education_type_4'];
    $education_name_4 = $_POST['education_name_4'];
    $education_major_4 = $_POST['education_major_4'];
    $education_grade_4 = $_POST['education_grade_4'];
    $education_start_4 = $_POST['education_start_4'];
    $education_end_4 = $_POST['education_end_4'];
    $education_desc_4 = $_POST['education_desc_4'];

    $education_type_5 = $_POST['education_type_5'];
    $education_name_5 = $_POST['education_name_5'];
    $education_major_5 = $_POST['education_major_5'];
    $education_grade_5 = $_POST['education_grade_5'];
    $education_start_5 = $_POST['education_start_5'];
    $education_end_5 = $_POST['education_end_5'];
    $education_desc_5 = $_POST['education_desc_5'];

    $get_id_query = "SELECT id FROM employee ORDER BY id DESC LIMIT 1";
    $last_id = mysqli_query($connect, $get_id_query);

    while($last_id_row = $last_id->fetch_assoc()){
        $employee_id = $last_id_row['id'];
    }

    $insert_education_history_query = "INSERT IGNORE INTO employee_education_history (id, emp_edu_id_1, emp_name_1, emp_major_1, emp_grade_1, emp_start_1, emp_end_1, emp_desc_1, emp_edu_id_2, emp_edu_id_3, emp_edu_id_4, emp_edu_id_5, emp_name_2, emp_name_3, emp_name_4, emp_name_5, emp_major_2, emp_major_3, emp_major_4, emp_major_5, emp_grade_2, emp_grade_3, emp_grade_4, emp_grade_5, emp_start_2, emp_start_3, emp_start_4, emp_start_5, emp_end_2, emp_end_3, emp_end_4, emp_end_5, emp_desc_2, emp_desc_3, emp_desc_4, emp_desc_5) VALUES ('$employee_id', '$education_type_1', '$education_name_1', '$education_major_1', '$education_grade_1', '$education_start_1', '$education_end_1', '$education_desc_1', '$education_type_2', '$education_type_3', '$education_type_4', '$education_type_5', '$education_name_2', '$education_name_3', '$education_name_4', '$education_name_5', '$education_major_2', '$education_major_3', '$education_major_4', '$education_major_5', '$education_grade_2', '$education_grade_3', '$education_grade_4', '$education_grade_5', '$education_start_2', '$education_start_3', '$education_start_4', '$education_start_5', '$education_end_2', '$education_end_3', '$education_end_4', '$education_end_5', '$education_desc_2', '$education_desc_3', '$education_desc_4', '$education_desc_5');"; 
    $insert_education_history_result = mysqli_query($connect, $insert_education_history_query);

    if($insert_education_history_result){
        header("location: form-new-employee-language-professional.php");
    } else {
        mysqli_error($connect);
    }

    // echo $education_type_1;
    // echo $education_name_1;
    // echo $education_major_1;
    // echo $education_grade_1;
    // echo $education_start_1;
    // echo $education_end_1;
    // echo $education_desc_1;

    // echo $education_type_2;
    // echo $education_name_2;
    // echo $education_major_2;
    // echo $education_grade_2;
    // echo $education_start_2;
    // echo $education_end_2;
    // echo $education_desc_2;

    // echo $education_type_3;
    // echo $education_name_3;
    // echo $education_major_3;
    // echo $education_grade_3;
    // echo $education_start_3;
    // echo $education_end_3;
    // echo $education_desc_3;

    // echo $education_type_4;
    // echo $education_name_4;
    // echo $education_major_4;
    // echo $education_grade_4;
    // echo $education_start_4;
    // echo $education_end_4;
    // echo $education_desc_4;

    // echo $education_type_5;
    // echo $education_name_5;
    // echo $education_major_5;
    // echo $education_grade_5;
    // echo $education_start_5;
    // echo $education_end_5;
    // echo $education_desc_5;

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
                    <img
                    src="../../../Assets/Dashboard-Inactive.png"
                    alt=""
                    class="img-right-side"
                    />
                </div>
                <div class="col">Beranda</div>
                </div>
            </a>

            <!-- Navigation links in sidebar-->
            <a href="../employee.php" class="sidebar-menu">
                <div class="row row-sidebar-menu">
                <div class="col-3">
                    <img
                    src="../../../Assets/Asset21.png"
                    alt=""
                    class="img-right-side"
                    />
                </div>
                <div class="col">Karyawan</div>
                </div>
            </a>

            <!-- Navigation links in sidebar-->
            <a href="../../payroll.php" class="sidebar-menu">
                <div class="row row-sidebar-menu-inactive">
                <div class="col-3">
                    <img
                    src="../../../Assets/Payroll-Inactive.png"
                    alt=""
                    class="img-right-side"
                    />
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
                    <img
                    src="../../../Assets/Training-Inactive.png"
                    alt=""
                    class="img-right-side"
                    />
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
                    <img
                    src="../../../Assets/Report-Inactive.png"
                    alt=""
                    class="img-right-side"
                    />
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
                    <img
                    src="../../../Assets/CompanySetting-Inactive.png"
                    alt=""
                    class="img-right-side"
                    />
                </div>
                <div class="col">Perusahaan</div>
                </div>
            </a>

            <!-- Navigation links in sidebar-->
            <a href="../../structure.php" class="sidebar-menu">
                <div class="row row-sidebar-menu-inactive">
                <div class="col-3">
                    <img
                    src="../../../Assets/Structure-Inactive.png"
                    alt=""
                    class="img-right-side"
                    />
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
                    <img
                    src="../../../Assets/Asset15.png"
                    alt=""
                    class="img-right-side"
                    />
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
                    <div class="row mt-4 mb-5 d-flex">
                        <div class="col">

                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tingkat pendidikan</label>
                                    <select class="form-select" id="education_type_1" name="education_type_1">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($education_type_rows = mysqli_fetch_array($education_type_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $education_type_rows["education_id"]; ?>">
                                                <?php echo $education_type_rows["education_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nama sekolah</label>
                                    <input type="text" name="education_name_1" id="education_name_1"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Jurusan</label>
                                    <input type="text" name="education_major_1" id="education_major_1"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nilai</label>
                                    <input type="text" name="education_grade_1" id="education_grade_1"
                                        class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tahun Masuk</label>
                                    <input type="date" name="education_start_1" id="education_start_1"
                                        class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tahun Selesai</label>
                                    <input type="date" name="education_end_1" id="education_end_1" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Deskripsi Pendidikan</label>
                                    <textarea class="form-control" name="education_desc_1" id="education_desc_1"
                                        cols="10" rows="3"></textarea>
                                </div>
                            </div>

                            <hr class="hr" />

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tingkat pendidikan</label>
                                    <select class="form-select" id="education_type_2" name="education_type_2">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($education_type_rows_2 = mysqli_fetch_array($education_type_result_2, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $education_type_rows_2["education_id"]; ?>">
                                                <?php echo $education_type_rows_2["education_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nama sekolah</label>
                                    <input type="text" name="education_name_2" id="education_name_2" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Jurusan</label>
                                    <input type="text" name="education_major_2" id="education_major_2" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nilai</label>
                                    <input type="text" name="education_grade_2" id="education_grade_2" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tahun Masuk</label>
                                    <input type="date" name="education_start_2" id="education_start_2" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tahun Selesai</label>
                                    <input type="date" name="education_end_2" id="education_end_2" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Deskripsi Pendidikan</label>
                                    <textarea class="form-control" name="education_desc_2" id="education_desc_2" cols="10" rows="3"></textarea>
                                </div>
                            </div>

                            <hr class="hr" />

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tingkat pendidikan</label>
                                    <select class="form-select" id="education_type_3" name="education_type_3">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($education_type_rows_3 = mysqli_fetch_array($education_type_result_3, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $education_type_rows_3["education_id"]; ?>">
                                                <?php echo $education_type_rows_3["education_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nama sekolah</label>
                                    <input type="text" name="education_name_3" id="education_name_3" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Jurusan</label>
                                    <input type="text" name="education_major_3" id="education_major_3" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nilai</label>
                                    <input type="text" name="education_grade_3" id="education_grade_3" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tahun Masuk</label>
                                    <input type="date" name="education_start_3" id="education_start_3" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tahun Selesai</label>
                                    <input type="date" name="education_end_3" id="education_end_3" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Deskripsi Pendidikan</label>
                                    <textarea class="form-control" name="education_desc_3" id="education_desc_3" cols="10" rows="3"></textarea>
                                </div>
                            </div>

                            <hr class="hr" />

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tingkat pendidikan</label>
                                    <select class="form-select" id="education_type_4" name="education_type_4">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($education_type_rows_4 = mysqli_fetch_array($education_type_result_4, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $education_type_rows_4["education_id"]; ?>">
                                                <?php echo $education_type_rows_4["education_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nama sekolah</label>
                                    <input type="text" name="education_name_4" id="education_name_4" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Jurusan</label>
                                    <input type="text" name="education_major_4" id="education_major_4" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nilai</label>
                                    <input type="text" name="education_grade_4" id="education_grade_4" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tahun Masuk</label>
                                    <input type="date" name="education_start_4" id="education_start_4" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tahun Selesai</label>
                                    <input type="date" name="education_end_4" id="education_end_4" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Deskripsi Pendidikan</label>
                                    <textarea class="form-control" name="education_desc_4" id="education_desc_4" cols="10" rows="3"></textarea>
                                </div>
                            </div>

                            <hr class="hr" />

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tingkat pendidikan</label>
                                    <select class="form-select" id="education_type_5" name="education_type_5">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($education_type_rows_5 = mysqli_fetch_array($education_type_result_5, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $education_type_rows_5["education_id"]; ?>">
                                                <?php echo $education_type_rows_5["education_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nama sekolah</label>
                                    <input type="text" name="education_name_5" id="education_name_5" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Jurusan</label>
                                    <input type="text" name="education_major_5" id="education_major_5" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nilai</label>
                                    <input type="text" name="education_grade_5" id="education_grade_5" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tahun Masuk</label>
                                    <input type="date" name="education_start_5" id="education_start_5" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tahun Selesai</label>
                                    <input type="date" name="education_end_5" id="education_end_5" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Deskripsi Pendidikan</label>
                                    <textarea class="form-control" name="education_desc_5" id="education_desc_5" cols="10" rows="3"></textarea>
                                </div>
                            </div>

                            <button type="submit"
                                class="btn mt-4 btn-submit-form-employee align-items-end" id="submit" name="submit" >Next</button>

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