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

    //get value sent over
    $id = $_GET['id'];

    //create query
    $query = "SELECT * FROM employee WHERE id=" . $id;

    //get the result of query
    $result = mysqli_query($conn, $query);

    if (count(array($result)) == 1) { //I added (array()) to make $result countable
        //fetch data
        $employee = mysqli_fetch_array($result);
        $lastname = $employee['lastname'];
        $firstname = $employee['firstname'];
        $office_id = $employee['office_id'];
        $address = $employee['address'];
    }

    //free result
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);

    ?>

    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <?php include('includes/sidebar.php'); ?>

            </div>
        </div>
        <div class="main-panel">
            <?php include('includes/navbar.php'); ?>
            <?php

            require('config/db.php');

            //check if submitted
            if (isset($_POST['submit'])) {
                //get form data
                $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
                $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
                $office_id = mysqli_real_escape_string($conn, $_POST['office_id']);
                $address = mysqli_real_escape_string($conn, $_POST['address']);

                //create insert query
                $query = "UPDATE employee SET lastname='$lastname', firstname='$firstname', office_id='$office_id', address='$address'
        WHERE id=" . $id;

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
                                                    <input name="lastname" type="text" class="form-control" value="<?php echo $lastname; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label> First Name </label>
                                                    <input name="firstname" type="text" class="form-control" value="<?php echo $firstname; ?>">
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
                                                            if ($row['id'] == $office_id) {
                                                                echo "<option value=" . $row['id'] . "selected>" . $row['name'] . "</option>";
                                                            } else {
                                                                echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                            }
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
                                                    <input name="address" type="text" class="form-control" value="<?php echo $address; ?>">
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