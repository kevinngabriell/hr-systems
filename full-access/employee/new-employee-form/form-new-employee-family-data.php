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

//retrieve family data
$family_query = "SELECT * FROM family_db";
$family_result = mysqli_query($connect, $family_query);
$family_result_2 = mysqli_query($connect, $family_query);
$family_result_3 = mysqli_query($connect, $family_query);
$family_result_4 = mysqli_query($connect, $family_query);
$family_result_5 = mysqli_query($connect, $family_query);

//retrieve education data
$education_type_query = "SELECT * FROM education_db";
$education_type_result = mysqli_query($connect, $education_type_query);
$education_type_result_2 = mysqli_query($connect, $education_type_query);
$education_type_result_3 = mysqli_query($connect, $education_type_query);
$education_type_result_4 = mysqli_query($connect, $education_type_query);
$education_type_result_5 = mysqli_query($connect, $education_type_query);

$get_id_query = "SELECT id FROM employee ORDER BY id DESC LIMIT 1";
$last_id = mysqli_query($connect, $get_id_query);

while ($last_id_row = $last_id->fetch_assoc()) {
    $employee_id = $last_id_row['id'];
}

if (isset($_POST['submit'])) {

    //retrieve data 
    $family_1 = $_POST['family_1'];
    $family_name_1 = $_POST['family_name_1'];
    $family_address_1 = $_POST['family_address_1'];
    $family_pob_1 = $_POST['family_pob_1'];
    $family_dob_1 = $_POST['family_dob_1'];
    $family_edu_1 = $_POST['family_edu_1'];
    $family_job_1 = $_POST['family_job_1'];

    $family_2 = $_POST['family_2'];
    $family_name_2 = $_POST['family_name_2'];
    $family_address_2 = $_POST['family_address_2'];
    $family_pob_2 = $_POST['family_pob_2'];
    $family_dob_2 = $_POST['family_dob_2'];
    $family_edu_2 = $_POST['family_edu_2'];
    $family_job_2 = $_POST['family_job_2'];

    $family_3 = $_POST['family_3'];
    $family_name_3 = $_POST['family_name_3'];
    $family_address_3 = $_POST['family_address_3'];
    $family_pob_3 = $_POST['family_pob_3'];
    $family_dob_3 = $_POST['family_dob_3'];
    $family_edu_3 = $_POST['family_edu_3'];
    $family_job_3 = $_POST['family_job_3'];

    $family_4 = $_POST['family_4'];
    $family_name_4 = $_POST['family_name_4'];
    $family_address_4 = $_POST['family_address_4'];
    $family_pob_4 = $_POST['family_pob_4'];
    $family_dob_4 = $_POST['family_dob_4'];
    $family_edu_4 = $_POST['family_edu_4'];
    $family_job_4 = $_POST['family_job_4'];

    $family_5 = $_POST['family_5'];
    $family_name_5 = $_POST['family_name_5'];
    $family_address_5 = $_POST['family_address_5'];
    $family_pob_5 = $_POST['family_pob_5'];
    $family_dob_5 = $_POST['family_dob_5'];
    $family_edu_5 = $_POST['family_edu_5'];
    $family_job_5 = $_POST['family_job_5'];

    $insert_family_query = "INSERT ignore INTO employee_family_background (id, family_type_1, family_name_1, family_address_1, family_pob_1, family_dob_1, family_last_edu_1, family_job_1, family_type_2, family_name_2, family_address_2, family_pob_2, family_dob_2, family_last_edu_2, family_job_2, family_type_3, family_name_3, family_address_3, family_pob_3, family_dob_3, family_last_edu_3, family_job_3, family_type_4, family_name_4, family_address_4, family_pob_4, family_dob_4, family_last_edu_4, family_job_4, family_type_5, family_name_5, family_address_5, family_pob_5, family_dob_5, family_last_edu_5, family_job_5) VALUES ('$employee_id', '$family_1', '$family_name_1', '$family_address_1', '$family_pob_1', '$family_dob_1', '$family_edu_1', '$family_job_1', '$family_2', '$family_name_2', '$family_address_2', '$family_pob_2', '$family_dob_2', '$family_edu_2', '$family_job_2', '$family_3', '$family_name_3', '$family_address_3', '$family_pob_3', '$family_dob_3', '$family_edu_3', '$family_job_3', '$family_4', '$family_name_4', '$family_address_4', '$family_pob_4', '$family_dob_4', '$family_edu_4', '$family_job_4', '$family_5', '$family_name_5', '$family_address_5', '$family_pob_5', '$family_dob_5', '$family_edu_5', '$family_job_5');";
    $insert_family_result = mysqli_query($connect, $insert_family_query);

    if ($insert_family_result) {
        header("location: form-new-employee-question.php");
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

                <form action="" method="post">
                    <div class="row mt-4 mb-5 d-flex">
                        <div class="col">

                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Hubungan keluarga</label>
                                    <select class="form-select" id="family_1" name="family_1">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($family_rows = mysqli_fetch_array($family_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $family_rows["id_family"]; ?>">
                                                <?php echo $family_rows["family_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nama lengkap</label>
                                    <input type="text" name="family_name_1" id="family_name_1" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Alamat</label>
                                    <textarea class="form-control" name="family_address_1" id="family_address_1"
                                        cols="10" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tempat lahir</label>
                                    <input type="text" name="family_pob_1" id="family_pob_1" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tanggal lahir</label>
                                    <input type="date" name="family_dob_1" id="family_dob_1" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Pendidikan terakhir</label>
                                    <select class="form-select" id="family_edu_1" name="family_edu_1">
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
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Pekerjaan</label>
                                    <input type="text" name="family_job_1" id="family_job_1" class="form-control">
                                </div>
                            </div>

                            <hr class="hr" />

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Hubungan keluarga</label>
                                    <select class="form-select" id="family_2" name="family_2">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($family_rows_2 = mysqli_fetch_array($family_result_2, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $family_rows_2["id_family"]; ?>">
                                                <?php echo $family_rows_2["family_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nama lengkap</label>
                                    <input type="text" name="family_name_2" id="family_name_2" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Alamat</label>
                                    <textarea class="form-control" name="family_address_2" id="family_address_2"
                                        cols="10" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tempat lahir</label>
                                    <input type="text" name="family_pob_2" id="family_pob_2" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tanggal lahir</label>
                                    <input type="date" name="family_dob_2" id="family_dob_2" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Pendidikan terakhir</label>
                                    <select class="form-select" id="family_edu_2" name="family_edu_2">
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
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Pekerjaan</label>
                                    <input type="text" name="family_job_2" id="family_job_2" class="form-control">
                                </div>
                            </div>

                            <hr class="hr" />

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Hubungan keluarga</label>
                                    <select class="form-select" id="family_3" name="family_3">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($family_rows_3 = mysqli_fetch_array($family_result_3, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $family_rows_3["id_family"]; ?>">
                                                <?php echo $family_rows_3["family_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nama lengkap</label>
                                    <input type="text" name="family_name_3" id="family_name_3" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Alamat</label>
                                    <textarea class="form-control" name="family_address_3" id="family_address_3"
                                        cols="10" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tempat lahir</label>
                                    <input type="text" name="family_pob_3" id="family_pob_3" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tanggal lahir</label>
                                    <input type="date" name="family_dob_3" id="family_dob_3" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Pendidikan terakhir</label>
                                    <select class="form-select" id="family_edu_3" name="family_edu_3">
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
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Pekerjaan</label>
                                    <input type="text" name="family_job_3" id="family_job_3" class="form-control">
                                </div>
                            </div>

                            <hr class="hr" />

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Hubungan keluarga</label>
                                    <select class="form-select" id="family_4" name="family_4">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($family_rows_4 = mysqli_fetch_array($family_result_4, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $family_rows_4["id_family"]; ?>">
                                                <?php echo $family_rows_4["family_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nama lengkap</label>
                                    <input type="text" name="family_name_4" id="family_name_4" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Alamat</label>
                                    <textarea class="form-control" name="family_address_4" id="family_address_4"
                                        cols="10" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tempat lahir</label>
                                    <input type="text" name="family_pob_4" id="family_pob_4" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tanggal lahir</label>
                                    <input type="date" name="family_dob_4" id="family_dob_4" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Pendidikan terakhir</label>
                                    <select class="form-select" id="family_edu_4" name="family_edu_4">
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
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Pekerjaan</label>
                                    <input type="text" name="family_job_4" id="family_job_4" class="form-control">
                                </div>
                            </div>

                            <hr class="hr" />

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Hubungan keluarga</label>
                                    <select class="form-select" id="family_5" name="family_5">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($family_rows_5 = mysqli_fetch_array($family_result_5, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $family_rows_5["id_family"]; ?>">
                                                <?php echo $family_rows_5["family_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Nama lengkap</label>
                                    <input type="text" name="family_name_5" id="family_name_5" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Alamat</label>
                                    <textarea class="form-control" name="family_address_5" id="family_address_5"
                                        cols="10" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tempat lahir</label>
                                    <input type="text" name="family_pob_5" id="family_pob_5" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Tanggal lahir</label>
                                    <input type="date" name="family_dob_5" id="family_dob_5" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Pendidikan terakhir</label>
                                    <select class="form-select" id="family_edu_5" name="family_edu_5">
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
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Pekerjaan</label>
                                    <input type="text" name="family_job_5" id="family_job_5" class="form-control">
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