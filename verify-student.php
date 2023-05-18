<?php 
include('server.php');
include('system-restriction/dean.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Records</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/scs.png" type="image/x-icon">
    <style>
        .square {
            height: 60vh;
            width: 60vh;
            border-width:2px;
            border-style:solid;
            border-color:black;
        }
        .dropbtn {
            background-color: #04590b;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            height: 50px;
        }
        .dropdown {
            position: relative;
            display: block;
        }
        .dropdown-content {
            display: none;
            position: static;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 8px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #ddd;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown:hover .dropbtn {
            background-color: #3365c1;
        }
        .button {
        padding: 15px 25px;
        font-size: 14px;
        text-align: center;
        cursor: pointer;
        outline: none;
        color: #fff;
        background-color: #db214c;
        border: none;
        border-radius: 15px;
        box-shadow: 0 9px #999;
        }

        .button:hover {background-color: #b01539}

        .button:active {
        background-color: #ff003b;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
        }
    </style>
</head>
<body>
    <div id="app">
        <?php include('sidebar/dean_sidebar.html'); ?>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <?php 
                                    $file = 'assets/images/avatar/' . $_SESSION['username'] . '.jpg';
                                    if(file_exists($file)): ?>
                                        <img src="assets/images/avatar/<?php echo $_SESSION['username']; ?>.jpg" alt="" srcset="">
                                    <?php endif ?>
                                    <?php 
                                    if(!(file_exists($file))):  ?>
                                        <img src="assets/images/avatar/default.png" height="80">
                                    <?php endif ?>
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, <?php echo $_SESSION['lastname']; ?>, <?php echo $_SESSION['firstname']; ?>!</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="change-password.php"><i data-feather="settings"></i> Change Password</a>
                                <div class="dropdown-divider"></div>
                                <form class = 'row' style = 'height:22px' method ='post'>
                                    <input class = "col-md-6" type="submit" name="logout" value="LOGOUT" style = 'border:none; background-color:white; position:relative; left:34px; height:18px'>
                                    <p class="col-md-6" style = 'width:5px; position:relative; right:92px; bottom:2px'><i data-feather="log-out"></i></p>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <section class="section">
                    <form class="row mb-4" method='post'>
                        <center><div class="col-md-12">
                            <div class="card" style='height:530px; width: 700px;'>
                                <div class='card-header' style='background-color: gray;'>
                                    <center><h4 style="color: white"><strong>Please Verify Student</strong></h4></center>
                                </div>
                                <div class='card-body'>
                                    <br>
                                    <div class = 'col-md-12' >
                                        <?php 
                                        $file = 'assets/images/avatar/' . $_SESSION['vstudent_id'] . '.jpg';
                                        if(file_exists($file)): ?>
                                            <center><img src="assets/images/avatar/<?php echo $_SESSION['vstudent_id']; ?>.jpg" height="230"></center>
                                        <?php endif ?>
                                        <?php 
                                        if(!(file_exists($file))):  ?>
                                            <center><img src="assets/images/avatar/default.png" height="230"></center>
                                        <?php endif ?>
                                    </div>
                                    <br>
                                    <h4><center><strong>Student ID: </strong><?php echo $_SESSION['vstudent_id'] ?></center></h4>
                                    <br>
                                    <?php
                                    $all = "SELECT * from student WHERE student_id = '" . $_SESSION['vstudent_id'] . "';";
                                    $all = mysqli_query($db,$all);
                                    $all = mysqli_fetch_assoc($all);
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <p style='font-size:18px; text-align:left'><strong>Name: </strong><?php echo $all['lastname'] ?>, <?php echo $all['firstname'] ?> <?php echo substr($all['middlename'], 0, 1) ?></p>
                                        </div>
                                    </div>
                                    <p style='font-size:18px; text-align:left'><strong>Course/Year/Section: </strong><?php echo $all['course'] ?><?php echo $all['year'] ?>-<?php echo $all['section'] ?></u></p>
                                    <div class = 'row'>
                                        <div class = 'col-md-6'>
                                            <div class="clearfix">
                                                <center><input type="submit" name="cancelverify" value="CANCEL" class="btn btn-primary" style = 'background-color:red'></center>
                                            </div>
                                        </div>
                                        <div class = 'col-md-6'>
                                            <div class="clearfix">
                                                <center><input type="submit" name="selectStud" value="PROCEED" class="btn btn-primary"></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></center>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/sweetAlert.js"></script>
</body>
</html>