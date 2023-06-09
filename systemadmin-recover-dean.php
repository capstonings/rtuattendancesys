<?php 
include('server.php');
include('system-restriction/systemadmin.php');
include('buttons/recover-acc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css?v=1">
    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">
	<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css?v=1">
    <link rel="shortcut icon" href="assets\images\background\RTU LOGO.png" type="image/x-icon">
</head>

<body>
    <div id="app">
        <?php include('sidebar/sysad_sidebar.html') ?>
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
				<section class="col-md-12">
					<div class="card">
						<div class="card-header" style="background-color:#3365c1; color:white"><strong><center>DEAN Account Information</center></strong></div>
						<?php
							$sqlSelect = "SELECT * FROM user WHERE accesslevel = 'DEAN'";
							$result = mysqli_query($db, $sqlSelect);
										
							if (mysqli_num_rows($result) > 0) {
								$users = [];
								$count = 1;
						?>
						<div class="form-group position-relative has-icon-left">
                            <div class="position-relative">
                                <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for Student ID..">
                                <div class="form-control-icon">
                                    <i data-feather="search"></i>
                                </div>
                            </div>
                        </div>
						<form class="table-responsive" method='post' style = "height: 500px; overflow: scroll">
							<table id="myTable" class="table table-bordered table-sm" cellspacing="0" width="100%">
								<thead>
								<tr>
									<th style = "width:18%; font-size: 14px" onclick="sort(1)">Name</th>
									<th style = "width:14%; font-size: 14px">Email</th>
									<th style = "width:8%; font-size: 14px">Username</th>
									<th style = "width:8%; font-size: 14px">Password</th>
									<th style = "width:12%; font-size: 14px">Password Status</th>
									<th style = "width:8%; font-size: 14px"><center>Action</center></th>
								</tr>
								</thead>
								<?php
								while ($row = mysqli_fetch_array($result)) {
									$array[] = $row["username"];
								?>
									<tbody>
										<?php
										if($count == 1){
										?>
										<tr>
											<td><?php  echo $row['lastname']; ?>, <?php  echo $row['firstname']; ?> <?php  echo substr($row['middlename'], 0, 1); ?>.</td>
											<td><?php  echo $row['email']; ?></td>
											<td><?php  echo $row['username']; ?></td>
											<?php 
											$_SESSION['resemail1'] = $row['email'];
											$_SESSION['reslastname1'] = $row['lastname'];
											if($row['password'] == $row['lastname']): ?>
												<td><?php echo $row['lastname']; ?></td>
												<td style = 'color:green'>Password is DEFAULT</td>
											<?php endif ?>
											<?php if($row['password'] != $row['lastname']): ?>
												<td>********</td>
												<td style = 'color:red'>Password is 'NOT' DEFAULT</td>
											<?php endif ?>
											<td>
												<div class="clearfix">
													<center><input type="submit" name="resetpass1" value="RESET" style = "background-color:gray; color:white" onclick="return  confirm('Do you really want to RESET password?')"></center>
												</div>
											</td>
										</tr>
										<?php
										}
										elseif($count == 2){
										?>
										<tr>
											<td><?php  echo $row['lastname']; ?>, <?php  echo $row['firstname']; ?> <?php  echo substr($row['middlename'], 0, 1); ?>.</td>
											<td><?php  echo $row['email']; ?></td>
											<td><?php  echo $row['username']; ?></td>
											<?php 
											$_SESSION['resemail2'] = $row['email'];
											$_SESSION['reslastname2'] = $row['lastname'];
											if($row['password'] == $row['lastname']): ?>
												<td><?php echo $row['lastname']; ?></td>
												<td style = 'color:green'>Password is DEFAULT</td>
											<?php endif ?>
											<?php if($row['password'] != $row['lastname']): ?>
												<td>********</td>
												<td style = 'color:red'>Password is 'NOT' DEFAULT</td>
											<?php endif ?>
											<td>
												<div class="clearfix">
													<center><input type="submit" name="resetpass2" value="RESET" style = "background-color:gray; color:white" onclick="return  confirm('Do you really want to RESET password?')"></center>
												</div>
											</td>
										</tr>
										<?php
										}
										elseif($count == 3){
										?>
										<tr>
											<td><?php  echo $row['lastname']; ?>, <?php  echo $row['firstname']; ?> <?php  echo substr($row['middlename'], 0, 1); ?>.</td>
											<td><?php  echo $row['email']; ?></td>
											<td><?php  echo $row['username']; ?></td>
											<?php 
											$_SESSION['resemail3'] = $row['email'];
											$_SESSION['reslastname3'] = $row['lastname'];
											if($row['password'] == $row['lastname']): ?>
												<td><?php echo $row['lastname']; ?></td>
												<td style = 'color:green'>Password is DEFAULT</td>
											<?php endif ?>
											<?php if($row['password'] != $row['lastname']): ?>
												<td>********</td>
												<td style = 'color:red'>Password is 'NOT' DEFAULT</td>
											<?php endif ?>
											<td>
												<div class="clearfix">
													<center><input type="submit" name="resetpass3" value="RESET" style = "background-color:gray; color:white" onclick="return  confirm('Do you really want to RESET password?')"></center>
												</div>
											</td>
										</tr>
										<?php
										}
										elseif($count == 4){
										?>
										<tr>
											<td><?php  echo $row['lastname']; ?>, <?php  echo $row['firstname']; ?> <?php  echo substr($row['middlename'], 0, 1); ?>.</td>
											<td><?php  echo $row['email']; ?></td>
											<td><?php  echo $row['username']; ?></td>
											<?php 
											$_SESSION['resemail4'] = $row['email'];
											$_SESSION['reslastname4'] = $row['lastname'];
											if($row['password'] == $row['lastname']): ?>
												<td><?php echo $row['lastname']; ?></td>
												<td style = 'color:green'>Password is DEFAULT</td>
											<?php endif ?>
											<?php if($row['password'] != $row['lastname']): ?>
												<td>********</td>
												<td style = 'color:red'>Password is 'NOT' DEFAULT</td>
											<?php endif ?>
											<td>
												<div class="clearfix">
													<center><input type="submit" name="resetpass4" value="RESET" style = "background-color:gray; color:white" onclick="return  confirm('Do you really want to RESET password?')"></center>
												</div>
											</td>
										</tr>
										<?php
										}
										elseif($count == 5){
										?>
										<tr>
											<td><?php  echo $row['lastname']; ?>, <?php  echo $row['firstname']; ?> <?php  echo substr($row['middlename'], 0, 1); ?>.</td>
											<td><?php  echo $row['email']; ?></td>
											<td><?php  echo $row['username']; ?></td>
											<?php 
											$_SESSION['resemail5'] = $row['email'];
											$_SESSION['reslastname5'] = $row['lastname'];
											if($row['password'] == $row['lastname']): ?>
												<td><?php echo $row['lastname']; ?></td>
												<td style = 'color:green'>Password is DEFAULT</td>
											<?php endif ?>
											<?php if($row['password'] != $row['lastname']): ?>
												<td>********</td>
												<td style = 'color:red'>Password is 'NOT' DEFAULT</td>
											<?php endif ?>
											<td>
												<div class="clearfix">
													<center><input type="submit" name="resetpass5" value="RESET" style = "background-color:gray; color:white" onclick="return  confirm('Do you really want to RESET password?')"></center>
												</div>
											</td>
										</tr>
										<?php
										}
										elseif($count == 6){
										?>
										<tr>
											<td><?php  echo $row['lastname']; ?>, <?php  echo $row['firstname']; ?> <?php  echo substr($row['middlename'], 0, 1); ?>.</td>
											<td><?php  echo $row['email']; ?></td>
											<td><?php  echo $row['username']; ?></td>
											<?php 
											$_SESSION['resemail6'] = $row['email'];
											$_SESSION['reslastname6'] = $row['lastname'];
											if($row['password'] == $row['lastname']): ?>
												<td><?php echo $row['lastname']; ?></td>
												<td style = 'color:green'>Password is DEFAULT</td>
											<?php endif ?>
											<?php if($row['password'] != $row['lastname']): ?>
												<td>********</td>
												<td style = 'color:red'>Password is 'NOT' DEFAULT</td>
											<?php endif ?>
											<td>
												<div class="clearfix">
													<center><input type="submit" name="resetpass6" value="RESET" style = "background-color:gray; color:white" onclick="return  confirm('Do you really want to RESET password?')"></center>
												</div>
											</td>
										</tr>
										<?php
										}
										elseif($count == 7){
										?>
										<tr>
											<td><?php  echo $row['lastname']; ?>, <?php  echo $row['firstname']; ?> <?php  echo substr($row['middlename'], 0, 1); ?>.</td>
											<td><?php  echo $row['email']; ?></td>
											<td><?php  echo $row['username']; ?></td>
											<?php 
											$_SESSION['resemail7'] = $row['email'];
											$_SESSION['reslastname7'] = $row['lastname'];
											if($row['password'] == $row['lastname']): ?>
												<td><?php echo $row['lastname']; ?></td>
												<td style = 'color:green'>Password is DEFAULT</td>
											<?php endif ?>
											<?php if($row['password'] != $row['lastname']): ?>
												<td>********</td>
												<td style = 'color:red'>Password is 'NOT' DEFAULT</td>
											<?php endif ?>
											<td>
												<div class="clearfix">
													<center><input type="submit" name="resetpass7" value="RESET" style = "background-color:gray; color:white" onclick="return  confirm('Do you really want to RESET password?')"></center>
												</div>
											</td>
										</tr>
										<?php
										}
										elseif($count == 8){
										?>
										<tr>
											<td><?php  echo $row['lastname']; ?>, <?php  echo $row['firstname']; ?> <?php  echo substr($row['middlename'], 0, 1); ?>.</td>
											<td><?php  echo $row['email']; ?></td>
											<td><?php  echo $row['username']; ?></td>
											<?php 
											$_SESSION['resemail8'] = $row['email'];
											$_SESSION['reslastname8'] = $row['lastname'];
											if($row['password'] == $row['lastname']): ?>
												<td><?php echo $row['lastname']; ?></td>
												<td style = 'color:green'>Password is DEFAULT</td>
											<?php endif ?>
											<?php if($row['password'] != $row['lastname']): ?>
												<td>********</td>
												<td style = 'color:red'>Password is 'NOT' DEFAULT</td>
											<?php endif ?>
											<td>
												<div class="clearfix">
													<center><input type="submit" name="resetpass8" value="RESET" style = "background-color:gray; color:white" onclick="return  confirm('Do you really want to RESET password?')"></center>
												</div>
											</td>
										</tr>
										<?php
										}
										elseif($count == 9){
										?>
										<tr>
											<td><?php  echo $row['lastname']; ?>, <?php  echo $row['firstname']; ?> <?php  echo substr($row['middlename'], 0, 1); ?>.</td>
											<td><?php  echo $row['email']; ?></td>
											<td><?php  echo $row['username']; ?></td>
											<?php 
											$_SESSION['resemail9'] = $row['email'];
											$_SESSION['reslastname9'] = $row['lastname'];
											if($row['password'] == $row['lastname']): ?>
												<td><?php echo $row['lastname']; ?></td>
												<td style = 'color:green'>Password is DEFAULT</td>
											<?php endif ?>
											<?php if($row['password'] != $row['lastname']): ?>
												<td>********</td>
												<td style = 'color:red'>Password is 'NOT' DEFAULT</td>
											<?php endif ?>
											<td>
												<div class="clearfix">
													<center><input type="submit" name="resetpass9" value="RESET" style = "background-color:gray; color:white" onclick="return  confirm('Do you really want to RESET password?')"></center>
												</div>
											</td>
										</tr>
										<?php
										}
										elseif($count == 10){
										?>
										<tr>
											<td><?php  echo $row['lastname']; ?>, <?php  echo $row['firstname']; ?> <?php  echo substr($row['middlename'], 0, 1); ?>.</td>
											<td><?php  echo $row['email']; ?></td>
											<td><?php  echo $row['username']; ?></td>
											<?php 
											$_SESSION['resemail10'] = $row['email'];
											$_SESSION['reslastname10'] = $row['lastname'];
											if($row['password'] == $row['lastname']): ?>
												<td><?php echo $row['lastname']; ?></td>
												<td style = 'color:green'>Password is DEFAULT</td>
											<?php endif ?>
											<?php if($row['password'] != $row['lastname']): ?>
												<td>********</td>
												<td style = 'color:red'>Password is 'NOT' DEFAULT</td>
											<?php endif ?>
											<td>
												<div class="clearfix">
													<center><input type="submit" name="resetpass10" value="RESET" style = "background-color:gray; color:white" onclick="return  confirm('Do you really want to RESET password?')"></center>
												</div>
											</td>
										</tr>
										<?php
										}
										
										?>
									</tbody>
								<?php
								$count = $count + 1;
								}
								#echo '<pre>';
								#print_r($array);
								?>
							</table>
						</form>
					</div>
				</section>
            </div>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
	<?php } ?>
	<script>
		function sort(n) {
		  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
		  table = document.getElementById("myTable");
		  switching = true;
		  //Set the sorting direction to ascending:
		  dir = "asc"; 
		  /*Make a loop that will continue until
		  no switching has been done:*/
		  while (switching) {
			//start by saying: no switching is done:
			switching = false;
			rows = table.rows;
			/*Loop through all table rows (except the
			first, which contains table headers):*/
			for (i = 1; i < (rows.length - 1); i++) {
			  //start by saying there should be no switching:
			  shouldSwitch = false;
			  /*Get the two elements you want to compare,
			  one from current row and one from the next:*/
			  x = rows[i].getElementsByTagName("TD")[n];
			  y = rows[i + 1].getElementsByTagName("TD")[n];
			  /*check if the two rows should switch place,
			  based on the direction, asc or desc:*/
			  if (dir == "asc") {
				if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
				  //if so, mark as a switch and break the loop:
				  shouldSwitch= true;
				  break;
				}
			  } else if (dir == "desc") {
				if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
				  //if so, mark as a switch and break the loop:
				  shouldSwitch = true;
				  break;
				}
			  }
			}
			if (shouldSwitch) {
			  /*If a switch has been marked, make the switch
			  and mark that a switch has been done:*/
			  rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
			  switching = true;
			  //Each time a switch is done, increase this count by 1:
			  switchcount ++;      
			} else {
			  /*If no switching has been done AND the direction is "asc",
			  set the direction to "desc" and run the while loop again.*/
			  if (switchcount == 0 && dir == "asc") {
				dir = "desc";
				switching = true;
			  }
			}
		  }
		}
		function myFunction() {
		  // Declare variables
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("myInput");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("myTable");
		  tr = table.getElementsByTagName("tr");

		  // Loop through all table rows, and hide those who don't match the search query
		  for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
			if (td) {
			  txtValue = td.textContent || td.innerText;
			  if (txtValue.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			  } else {
				tr[i].style.display = "none";
			  }
			}
		  }
		}
	</script>
</body>

</html>