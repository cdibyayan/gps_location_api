<?php 
session_start();
if ($_SESSION['uid']=="") {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPS Trcack: Dashboard</title>
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="asset/style.css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    
</head>
<body>
<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
    <!-- Vertical Navbar -->
    <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
            <img src="asset/logo.png" alt="...">
            </a>
            <!-- User menu (mobile) -->
            <div class="navbar-user d-lg-none">
                <!-- Dropdown -->
                <div class="dropdown">
                    <!-- Toggle -->
                    <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-parent-child">
                            <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar- rounded-circle">
                            <span class="avatar-child avatar-badge bg-success"></span>
                        </div>
                    </a>
                    <!-- Menu -->
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Settings</a>
                        <a href="#" class="dropdown-item">Billing</a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-bar-chart"></i> Zone Track
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <!-- <hr class="navbar-divider my-5 opacity-20"> -->
                <!-- Push content down -->
                <!-- <div class="mt-auto"></div> -->
                <!-- User (md) -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person-square"></i> Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="bi bi-box-arrow-left"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <main class="py-6 bg-surface-secondary">
            <div class="container-fluid">
                <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <div class="row">
                        <div class="col-sm-6 col-12">
                        <h5 class="mb-0">Updated Zone Details</h5>
                        </div>


                        <div class="col-sm-6 col-12 text-sm-end">

                        </div>
                        </div>
                 
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Last Updated Zone</th>
                                    <th scope="col">Last Updated Location</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Last Updated At</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                            <?php 
                                    include "db.php";
                                    //date_default_timezone_set("Asia/Kolkata");
                                    $sql = "SELECT * FROM `zone_track`";
                                    $res = mysqli_query($mysqli, $sql);
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    
                                    $status = $row['status'];

                                    ?> 
                                    <tr>
                                                <td><?=$row['uid'];?></td>
                                                <td><?=$row['last_zone'];?></td>
                                                <td><?=$row['last_loc'];?></td>
                                                <td>
                                                    <?php 
                                                    if ($status == "online" or $status == "button pressed") {
                                                    ?>
                                                    <span class="badge badge-lg badge-dot">
                                                        <i class="bg-success"></i><?=$status;?>
                                                    </span>
                                                <?php
                                                }
                                                else{
                                                ?>
                                                    <span class="badge badge-lg badge-dot">
                                                            <i class="bg-danger"></i><?=$status;?>
                                                    </span>
                                                <?php
                                                }
                                                ?>
                                                </td>
                                                <td><?=$row['last_update'];?></td>
                                            </tr>
                                    <?php
                                        }
                                    ?>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Data</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
          <form>
                <div class="form-group">
                    <label for="uid">Uid:</label>
                    <input type="text" class="form-control" id="uid" placeholder="Enter uid" name="uid">
                </div>

                <div class="form-group">
                    <label for="uid">last Updated Zone:</label>
                    <input type="text" class="form-control" id="zone" placeholder="Enter last Updated Zone" name="zone">
                </div>
                <div class="form-group">
                    <label for="uid">last Updated Location:</label>
                    <input type="text" class="form-control" id="uid" placeholder="Enter last Updated Location" name="location">
                </div>
                <div class="form-group">
                    <label for="uid">Status:</label>
                    <input type="text" class="form-control" id="status" placeholder="Enter status" name="status">
                </div>
                <button type="submit" class="btn d-inline-flex btn-sm btn-primary mx-1">Submit</button>
            </form>
          </div>
        </div>        
      </div>
    </div>
  </div>

<script>
//     setInterval(function () {
//         $.ajax({
// 		url: "display-zone.php",
// 		type: "POST",
// 		cache: false,
// 		success: function(data){
// 			//alert(data);
// 			$('#table').html(data); 
// 		}
// 	});
//  }, 1000);

 $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf'
        ]
    } );
} );


</script>
</body>
</html>