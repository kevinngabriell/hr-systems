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

//retrieve ability
$ability_query = "SELECT * FROM ability_db";
$ability_result = mysqli_query($connect, $ability_query);
$ability_result_2 = mysqli_query($connect, $ability_query);
$ability_result_3 = mysqli_query($connect, $ability_query);
$ability_result_4 = mysqli_query($connect, $ability_query);
$ability_result_5 = mysqli_query($connect, $ability_query);
$ability_result_6 = mysqli_query($connect, $ability_query);
$ability_result_7 = mysqli_query($connect, $ability_query);
$ability_result_8 = mysqli_query($connect, $ability_query);
$ability_result_9 = mysqli_query($connect, $ability_query);
$ability_result_10 = mysqli_query($connect, $ability_query);
$ability_result_11 = mysqli_query($connect, $ability_query);
$ability_result_12 = mysqli_query($connect, $ability_query);
$ability_result_13 = mysqli_query($connect, $ability_query);
$ability_result_14 = mysqli_query($connect, $ability_query);
$ability_result_15 = mysqli_query($connect, $ability_query);
$ability_result_16 = mysqli_query($connect, $ability_query);

if (isset($_POST['submit'])) {

    //gather user ability
    $language_1 = $_POST['language_1'];
    $ability_1 = $_POST['ability_1'];
    $ability_2 = $_POST['ability_2'];
    $ability_3 = $_POST['ability_3'];
    $ability_4 = $_POST['ability_4'];

    $language_2 = $_POST['language_2'];
    $ability_5 = $_POST['ability_5'];
    $ability_6 = $_POST['ability_6'];
    $ability_7 = $_POST['ability_7'];
    $ability_8 = $_POST['ability_8'];

    $language_3 = $_POST['language_3'];
    $ability_9 = $_POST['ability_9'];
    $ability_10 = $_POST['ability_10'];
    $ability_11 = $_POST['ability_11'];
    $ability_12 = $_POST['ability_12'];

    $language_4 = $_POST['language_4'];
    $ability_13 = $_POST['ability_13'];
    $ability_14 = $_POST['ability_14'];
    $ability_15 = $_POST['ability_15'];
    $ability_16 = $_POST['ability_16'];

    $get_id_query = "SELECT id FROM employee ORDER BY id DESC LIMIT 1";
    $last_id = mysqli_query($connect, $get_id_query);

    while($last_id_row = $last_id->fetch_assoc()){
        $employee_id = $last_id_row['id'];
    }

    $insert_language_query = "INSERT INTO employee_language_professional (id, language_name_1, ability_1, ability_2, ability_3, ability_4, language_name_2, ability_5, ability_6, ability_7, ability_8, language_name_3, ability_9, ability_10, ability_11, ability_12, language_name_4, ability_13, ability_14, ability_15, ability_16) VALUES ('$employee_id', '$language_1', '$ability_1', '$ability_2', '$ability_3', '$ability_4', '$language_2', '$ability_5', '$ability_6', '$ability_7', '$ability_8', '$language_3', '$ability_9', '$ability_10', '$ability_11', '$ability_12', '$language_4', '$ability_13', '$ability_14', '$ability_15', '$ability_16');";
    $insert_language_result = mysqli_query($connect, $insert_language_query);

    if($insert_language_result){
        header("location: form-new-employee-family-data.php");
    } else {
        mysqli_error($connect);
    }

    // echo $language_1;
    // echo $ability_1;
    // echo $ability_2;
    // echo $ability_3;
    // echo $ability_4;

    // echo $language_2;
    // echo $ability_5;
    // echo $ability_6;
    // echo $ability_7;
    // echo $ability_8;

    // echo $language_3;
    // echo $ability_9;
    // echo $ability_10;
    // echo $ability_11;
    // echo $ability_12;

    // echo $language_4;
    // echo $ability_13;
    // echo $ability_14;
    // echo $ability_15;
    // echo $ability_16;
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
                                    <label for="" class="form-new-employee-label mb-1">Bahasa</label>
                                    <input type="text" name="language_1" id="language_1" class="form-control"
                                        value="Bahasa Indonesia" readonly>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Mendengar</label>
                                    <select class="form-select" id="ability_1" name="ability_1">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_1 = mysqli_fetch_array($ability_result, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_1["ability_id"]; ?>">
                                                <?php echo $ability_rows_1["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Berbicara</label>
                                    <select class="form-select" id="ability_2" name="ability_2">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_2 = mysqli_fetch_array($ability_result_2, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_2["ability_id"]; ?>">
                                                <?php echo $ability_rows_2["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Membaca</label>
                                    <select class="form-select" id="ability_3" name="ability_3">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_3 = mysqli_fetch_array($ability_result_3, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_3["ability_id"]; ?>">
                                                <?php echo $ability_rows_3["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Menulis</label>
                                    <select class="form-select" id="ability_4" name="ability_4">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_4 = mysqli_fetch_array($ability_result_4, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_4["ability_id"]; ?>">
                                                <?php echo $ability_rows_4["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Bahasa</label>
                                    <input type="text" name="language_2" id="language_2" class="form-control"
                                        value="Bahasa Inggris" readonly>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Mendengar</label>
                                    <select class="form-select" id="ability_5" name="ability_5">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_5 = mysqli_fetch_array($ability_result_5, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_5["ability_id"]; ?>">
                                                <?php echo $ability_rows_5["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Berbicara</label>
                                    <select class="form-select" id="ability_6" name="ability_6">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_6 = mysqli_fetch_array($ability_result_6, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_6["ability_id"]; ?>">
                                                <?php echo $ability_rows_6["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Membaca</label>
                                    <select class="form-select" id="ability_7" name="ability_7">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_7 = mysqli_fetch_array($ability_result_7, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_7["ability_id"]; ?>">
                                                <?php echo $ability_rows_7["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Menulis</label>
                                    <select class="form-select" id="ability_8" name="ability_8">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_8 = mysqli_fetch_array($ability_result_8, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_8["ability_id"]; ?>">
                                                <?php echo $ability_rows_8["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Bahasa asing/daerah</label>
                                    <input type="text" name="language_3" id="language_3" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Mendengar</label>
                                    <select class="form-select" id="ability_9" name="ability_9">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_9 = mysqli_fetch_array($ability_result_9, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_9["ability_id"]; ?>">
                                                <?php echo $ability_rows_9["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Berbicara</label>
                                    <select class="form-select" id="ability_10" name="ability_10">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_10 = mysqli_fetch_array($ability_result_10, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_10["ability_id"]; ?>">
                                                <?php echo $ability_rows_10["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Membaca</label>
                                    <select class="form-select" id="ability_11" name="ability_11">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_11 = mysqli_fetch_array($ability_result_11, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_11["ability_id"]; ?>">
                                                <?php echo $ability_rows_11["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Menulis</label>
                                    <select class="form-select" id="ability_12" name="ability_12">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_12 = mysqli_fetch_array($ability_result_12, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_12["ability_id"]; ?>">
                                                <?php echo $ability_rows_12["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Bahasa asing/daerah</label>
                                    <input type="text" name="language_4" id="language_4" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Mendengar</label>
                                    <select class="form-select" id="ability_13" name="ability_13">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_13 = mysqli_fetch_array($ability_result_13, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_13["ability_id"]; ?>">
                                                <?php echo $ability_rows_13["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Berbicara</label>
                                    <select class="form-select" id="ability_14" name="ability_14">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_14 = mysqli_fetch_array($ability_result_14, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_14["ability_id"]; ?>">
                                                <?php echo $ability_rows_14["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Membaca</label>
                                    <select class="form-select" id="ability_15" name="ability_15">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_15 = mysqli_fetch_array($ability_result_15, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_15["ability_id"]; ?>">
                                                <?php echo $ability_rows_15["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="" class="form-new-employee-label mb-1">Menulis</label>
                                    <select class="form-select" id="ability_16" name="ability_16">
                                        <!-- starting php to get value -->
                                        <?php
                                        while ($ability_rows_16 = mysqli_fetch_array($ability_result_16, MYSQLI_ASSOC)):
                                            ;
                                            ?>
                                            <option value="<?php echo $ability_rows_16["ability_id"]; ?>">
                                                <?php echo $ability_rows_16["ability_name"] ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                        <!-- end php to get value -->
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn mt-4 btn-submit-form-employee align-items-end" id="submit"
                                name="submit">Next</button>

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