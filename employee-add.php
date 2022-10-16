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
    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <?php include('includes/sidebar.php'); ?>

            </div>
        </div>
        <div class="main-panel">
            <?php include('includes/navbar.php'); ?>
            <?php
            require('config/config.php');
            require('config/db.php');

            //check if submitted
            if (isset($_POST['submit'])) {
                //get form data
                $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
                $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
                $office_id = mysqli_real_escape_string($conn, $_POST['office_id']);
                $address = mysqli_real_escape_string($conn, $_POST['address']);

                //create insert query
                $query = "INSERT INTO employee(lastname, firstname, office_id, address)
        VALUES('$lastname', '$firstname', '$office_id', '$address')";

                //execute query
                if (mysqli_query($conn, $query)) {
                } else {
                    echo 'ERROR: ' . mysqli_error($conn);
                }
            }


            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="section">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label> Last Name </label>
                                                    <input name="lastname" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label> First Name </label>
                                                    <input name="firstname" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail">Office</label>
                                                    <select class="form-control" name="office_id">
                                                        <option>Select...</option>
                                                        <?php
                                                        $query = "SELECT id, name FROM office";
                                                        $result = mysqli_query($conn, $query);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            echo "<option value=" . $row['id'] . "> " . $row['name'] . "</option>";
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label> Address / Building </label>
                                                    <input name="address" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" value="Submit" name="submit" class="btn btn-info btn-fill pull-right">Save</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('../recordApp/includes/footer.php'); ?>