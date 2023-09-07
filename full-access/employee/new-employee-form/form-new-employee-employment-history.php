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

while ($company_data_row = $company_data_result->fetch_assoc()){
  $company_name_printed = $company_data_row['company_name'];
  $company_address_printed = $company_data_row['company_address'];
}

if(isset($_POST['submit'])){

    $company_name_1 = $_POST['company_name_1']; 
    $company_position_1 = $_POST['company_position_1'];
    $company_address_1 = $_POST['company_address_1'];
    $company_type_1 = $_POST['company_type_1'];
    $company_date_from_1 = $_POST['company_date_from_1'];
    $company_date_to_1 = $_POST['company_date_to_1'];
    $company_leader_1 = $_POST['company_leader_1'];
    $company_salary_1 = $_POST['company_salary_1'];
    $company_job_desc_1 = $_POST['company_job_desc_1'];
    $company_exit_1 = $_POST['company_exit_1'];

    $company_name_2 = $_POST['company_name_2']; 
    $company_position_2 = $_POST['company_position_2'];
    $company_address_2 = $_POST['company_address_2'];
    $company_type_2 = $_POST['company_type_2'];
    $company_date_from_2 = $_POST['company_date_from_2'];
    $company_date_to_2 = $_POST['company_date_to_2'];
    $company_leader_2 = $_POST['company_leader_2'];
    $company_salary_2 = $_POST['company_salary_2'];
    $company_job_desc_2 = $_POST['company_job_desc_2'];
    $company_exit_2 = $_POST['company_exit_2'];

    $company_name_3 = $_POST['company_name_3']; 
    $company_position_3 = $_POST['company_position_3'];
    $company_address_3 = $_POST['company_address_3'];
    $company_type_3 = $_POST['company_type_3'];
    $company_date_from_3 = $_POST['company_date_from_3'];
    $company_date_to_3 = $_POST['company_date_to_3'];
    $company_leader_3 = $_POST['company_leader_3'];
    $company_salary_3 = $_POST['company_salary_3'];
    $company_job_desc_3 = $_POST['company_job_desc_3'];
    $company_exit_3 = $_POST['company_exit_3'];

    $get_id_query = "SELECT id FROM employee ORDER BY id DESC LIMIT 1";
    $last_id = mysqli_query($connect, $get_id_query);

    while($last_id_row = $last_id->fetch_assoc()){
        $employee_id = $last_id_row['id'];
    }

    $insert_employment_history_query = "INSERT IGNORE INTO employee_employement_history (id, company_name_1, company_position_1, company_address_1, company_type_1, company_start_1, company_end_1, company_leader_1, company_salary_1, company_jobdesc_1, company_leave_1, company_name_2, company_position_2, company_address_2, company_type_2, company_start_2, company_end_2, company_leader_2, company_salary_2, company_jobdesc_2, company_leave_2, company_name_3, company_position_3, company_address_3, company_type_3, company_start_3, company_end_3, company_leader_3, company_salary_3, company_jobdesc_3, company_leave_3) VALUES ('$employee_id', '$company_name_1', '$company_position_1', '$company_address_1', '$company_type_1', '$company_date_from_1', '$company_date_to_1', '$company_leader_1', '$company_salary_1', '$company_job_desc_1', '$company_exit_1', '$company_name_2', '$company_position_2', '$company_address_2', '$company_type_2', '$company_date_from_2', '$company_date_to_2', '$company_leader_2', '$company_salary_2', '$company_job_desc_2', '$company_exit_2', '$company_name_3', '$company_position_3', '$company_address_3', '$company_type_3', '$company_date_from_3', '$company_date_to_3', '$company_leader_3', '$company_salary_3', '$company_job_desc_3', '$company_exit_3');"; 
    $insert_employment_history_result = mysqli_query($connect, $insert_employment_history_query);

    if($insert_employment_history_result){
        header("location: form-new-employee-educational.php");
    } else {
        mysqli_error($connect);
    }

    // echo $company_name_1;
    // echo $company_position_1;
    // echo $company_address_1;
    // echo $company_type_1;
    // echo $company_date_from_1;
    // echo $company_date_to_1;
    // echo $company_leader_1;
    // echo $company_salary_1;
    // echo $company_job_desc_1;
    // echo $company_exit_1;

    // echo $company_name_2;
    // echo $company_position_2;
    // echo $company_address_2;
    // echo $company_type_2;
    // echo $company_date_from_2;
    // echo $company_date_to_2;
    // echo $company_leader_2;
    // echo $company_salary_2;
    // echo $company_job_desc_2;
    // echo $company_exit_2;

    // echo $company_name_3;
    // echo $company_position_3;
    // echo $company_address_3;
    // echo $company_type_3;
    // echo $company_date_from_3;
    // echo $company_date_to_3;
    // echo $company_leader_3;
    // echo $company_salary_3;
    // echo $company_job_desc_3;
    // echo $company_exit_3;




}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Employee HR Systems</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="employeestyle.css" />
    <!-- font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Nokora:wght@100;300;400;700;900&display=swap"
      rel="stylesheet"
    />

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
                    <img
                    src="../../../Assets/Asset20.png"
                    alt=""
                    class="img-right-side"
                    />
                </div>
                <div class="col">Dashboard</div>
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
                <div class="col">Employee</div>
                </div>
            </a>

            <!-- Navigation links in sidebar-->
            <a href="../../payroll.php" class="sidebar-menu">
                <div class="row row-sidebar-menu-inactive">
                <div class="col-3">
                    <img
                    src="../../../Assets/Asset11.png"
                    alt=""
                    class="img-right-side"
                    />
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
                    <img
                    src="../../../Assets/Asset16.png"
                    alt=""
                    class="img-right-side"
                    />
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
                    <img
                    src="../../../Assets/Asset12.png"
                    alt=""
                    class="img-right-side"
                    />
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
                    <img
                    src="../../../Assets/Asset14.png"
                    alt=""
                    class="img-right-side"
                    />
                </div>
                <div class="col">Company Settings</div>
                </div>
            </a>

            <!-- Navigation links in sidebar-->
            <a href="../../structure.php" class="sidebar-menu">
                <div class="row row-sidebar-menu-inactive">
                <div class="col-3">
                    <img
                    src="../../../Assets/Asset13.png"
                    alt=""
                    class="img-right-side"
                    />
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
                    <a href="../employee.php" class="nav-item nav-text-dashboard"
                    >Employee</a
                    >
                </div>
                <!-- second column of top navbar -->
                <div class="col">
                    <!-- search and notif logo -->
                    <div class="row d-flex align-items-center">
                    <!-- search form -->
                    <div class="col">
                        <input
                        class="form-control"
                        type="text"
                        placeholder="Search here"
                        aria-label="default input example"
                        />
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
                        <img
                        src="../../../Assets/company-logo.png"
                        class="img-right-side"
                        />
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
                <div class="row mt-4 d-flex">
                    <div class="col">
                    
                        <div class="row">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Nama perusahaan</label>
                                <input type="text" name="company_name_1" id="company_name_1" class="form-control">
                            </div>
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Posisi</label>
                                <input type="text" name="company_position_1" id="company_position_1" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Alamat perusahaan</label>
                                <textarea class="form-control" name="company_address_1" id="company_address_1" cols="10" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Jenis usaha</label>
                                <input type="text" name="company_type_1" id="company_type_1" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="" class="form-new-employee-label mb-1">Dari</label>
                                <input type="date" name="company_date_from_1" id="company_date_from_1" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="" class="form-new-employee-label mb-1">Sampai</label>
                                <input type="date" name="company_date_to_1" id="company_date_to_1" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Atasan</label>
                                <input type="text" name="company_leader_1" id="company_leader_1" class="form-control">
                            </div>
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Gaji</label>
                                <input type="number" name="company_salary_1" id="company_salary_1" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4 mb-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Deskripsi pekerjaan</label>
                                <textarea class="form-control" name="company_job_desc_1" id="company_job_desc_1" cols="10" rows="3"></textarea>
                            </div>
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Alasan keluar</label>
                                <textarea class="form-control" name="company_exit_1" id="company_exit_1" cols="10" rows="3"></textarea>
                            </div>
                        </div>

                        <hr class="hr" />

                        <div class="row mt-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Nama perusahaan</label>
                                <input type="text" name="company_name_2" id="company_name_2" class="form-control">
                            </div>
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Posisi</label>
                                <input type="text" name="company_position_2" id="company_position_2" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Alamat perusahaan</label>
                                <textarea class="form-control" name="company_address_2" id="company_address_2" cols="10" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Jenis usaha</label>
                                <input type="text" name="company_type_2" id="company_type_2" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="" class="form-new-employee-label mb-1">Dari</label>
                                <input type="date" name="company_date_from_2" id="company_date_from_2" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="" class="form-new-employee-label mb-1">Sampai</label>
                                <input type="date" name="company_date_to_2" id="company_date_to_2" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Atasan</label>
                                <input type="text" name="company_leader_2" id="company_leader_2" class="form-control">
                            </div>
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Gaji</label>
                                <input type="number" name="company_salary_2" id="company_salary_2" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4 mb-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Deskripsi pekerjaan</label>
                                <textarea class="form-control" name="company_job_desc_2" id="company_job_desc_2" cols="10" rows="3"></textarea>
                            </div>
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Alasan keluar</label>
                                <textarea class="form-control" name="company_exit_2" id="company_exit_2" cols="10" rows="3"></textarea>
                            </div>
                        </div>

                        <hr class="hr" />

                        <div class="row mt-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Nama perusahaan</label>
                                <input type="text" name="company_name_3" id="company_name_3" class="form-control">
                            </div>
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Posisi</label>
                                <input type="text" name="company_position_3" id="company_position_3" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Alamat perusahaan</label>
                                <textarea class="form-control" name="company_address_3" id="company_address_3" cols="10" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Jenis usaha</label>
                                <input type="text" name="company_type_3" id="company_type_3" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="" class="form-new-employee-label mb-1">Dari</label>
                                <input type="date" name="company_date_from_3" id="company_date_from_3" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="" class="form-new-employee-label mb-1">Sampai</label>
                                <input type="date" name="company_date_to_3" id="company_date_to_3" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Atasan</label>
                                <input type="text" name="company_leader_3" id="company_leader_3" class="form-control">
                            </div>
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Gaji</label>
                                <input type="number" name="company_salary_3" id="company_salary_3" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Deskripsi pekerjaan</label>
                                <textarea class="form-control" name="company_job_desc_3" id="company_job_desc_3" cols="10" rows="3"></textarea>
                            </div>
                            <div class="col">
                                <label for="" class="form-new-employee-label mb-1">Alasan keluar</label>
                                <textarea class="form-control" name="company_exit_3" id="company_exit_3" cols="10" rows="3"></textarea>
                            </div>
                        </div>

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
                                        <a href="form-new-employee-contact-details.php" style="text-decoration: none;">
                                            Data alamat
                                        </a>
                                    </li>
                                    <li style="list-style-type: none; margin-top: 12%;">
                                        <a href="form-new-employee-employment-history.php" style="text-decoration: none;">
                                            Riwayat bekerja
                                        </a>
                                    </li>
                                    <li style="list-style-type: none; margin-top: 12%;">
                                        <a href="form-new-employee-educational.php" style="text-decoration: none;">
                                            Pendidikan
                                        </a>
                                    </li>
                                    <li style="list-style-type: none; margin-top: 12%;">
                                        <a href="form-new-employee-language-professional.php" style="text-decoration: none;">
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
                <button type="submit" id="submit" name="submit" class="btn mt-4 mb-5 btn-submit-form-employee align-items-end">Next</button>
            </form>

            

        
          
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
  </body>
</html>
