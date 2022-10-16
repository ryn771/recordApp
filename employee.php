<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Light Bootstrap Dashboard - Free Bootstrap 4 Admin Dashboard by Creative Tim</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <?php
    require('config/config.php');
    require('config/db.php');

    //gets the value sent over the search form
    $search = isset($_GET['search']) ? $_GET['search'] : null; //I added some code due to some error

    //define total number of results you want per page
    $results_per_page = 25;

    //find the total number of results/rows stored in the database
    $query = "SELECT * FROM employee";
    $result = mysqli_query($conn, $query);
    $number_of_result = mysqli_num_rows($result);

    //determine the total number of pages available
    $number_of_page = ceil($number_of_result / $results_per_page);

    //determine which page number visitor currently on
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    //determine the sql LIMIT starting number for the results on the display page
    $page_first_result = ($page - 1) * $results_per_page;


    //create query
    if (strlen($search) > 0) {
        $query = 'SELECT employee.id, employee.lastname, employee.firstname, employee.address, 
        office.name as office_name FROM employee, office WHERE employee.office_id = office.id and  
        CONCAT(employee.firstname, " ",employee.lastname, " ",employee.firstname) LIKE "%' . $search . '%"
        ORDER BY employee.lastname LIMIT ' . $page_first_result . ',' . $results_per_page;
    } else {
        $query = 'SELECT employee.id, employee.lastname, employee.firstname, employee.address, office.name as office_name
        FROM employee, office WHERE employee.office_id = office.id ORDER BY employee.lastname
        LIMIT ' . $page_first_result . ',' . $results_per_page;
    }

    //get the result
    $result = mysqli_query($conn, $query);

    //fetch the data
    $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free result
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);

    ?>
    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <?php include('includes/sidebar.php'); ?>

            </div>
        </div>

        <div class="main-panel">
            <?php include('includes/navbar.php'); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="section">
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card striped-tabled-with-hover">
                                <br />
                                <div class="col-md-12">
                                    <form action="employee.php" method="GET">
                                        <input type="text" name="search" />
                                        <input type="submit" value="Search" class="btn btn-info btn-fill" />
                                    </form>
                                </div>


                                <div class="col-md-12">
                                    <!-- REMOVE ../recordApp -->
                                    <a href="../recordApp/employee-add.php">
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Add New Employee</button>
                                    </a>
                                </div>
                                <div class="card-header">
                                    <h4 class="card-title">Employees</h4>
                                    <p class="card-category">Here is a subtitle for this table</p>
                                </div>
                                <div class="card-body table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Last name</th>
                                            <th>First name</th>
                                            <th>Address</th>
                                            <th>Office</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($employees as $employee) : ?>
                                                <tr>
                                                    <td><?php echo $employee['lastname']; ?></td>
                                                    <td><?php echo $employee['firstname']; ?></td>
                                                    <td><?php echo $employee['address']; ?></td>
                                                    <td><?php echo $employee['office_name']; ?></td>
                                                    <td>
                                                        <!-- remove ../recordApp -->
                                                        <a href="../recordApp/employee-edit.php? id=<?php echo $employee['id']; ?>">
                                                            <button type="submit" class="btn btn-warning btn-fill pull-right"> Edit </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    for ($page = 1; $page <= $number_of_page; $page++) {
                        echo '<a href = "employee.php?page=' . $page . '">' . $page . '</a>';
                    }

                    ?>
                </div>
            </div>
            <?php include('../recordApp/includes/footer.php'); ?>