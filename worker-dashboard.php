<!DOCTYPE html>
<html lang="en">
<?php
 session_start();
    if(isset($_SESSION["activeuser"])==false)
    {
        header("location:index.php");
    }
    ?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="jq/jquery-1.8.2.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
        body {
            font-family: Segoe Print;
            font-weight: 400;
            background-image: url("pics/bg.PNG");
            background-repeat: no-repeat;
            background-size: cover;
        }

        h4 {
            color: cornsilk;
        }

        .navbar-brand {
            color: cornsilk;
            font-weight: 800;
        }

        .card {
            box-shadow: 2px 5px 5px 5px #888888;
            height: 300px;
        }

        .card-body {
            color: blue;
        }
          input[type=text]{
            border-radius: 300px;
        }
         input[type=password]{
            border-radius: 300px;
        }

    </style>
</head>
<script>
    $(document).ready(function() {
        $("#submit").click(function() {
            var citizenuid = $("#txtCit").val();
            var workeruid = $("#txtWor").val();

            var actionUrl = "w-rating-process.php?citizenuid=" + citizenuid + "&workeruid=" + workeruid;
            //alert(actionUrl);
            $.get(actionUrl, function(response) {
                $("#success").html(response).css("color", "red");
            });
        });
    });

</script>

<body >
    <nav class="navbar navbar-expand-sm sticky-top navbar-dark bg-dark ">
        <a href="#" class="navbar-brand" style="font-size: 23px;"><img src="pics/exigency_logo.PNG" alt="" height="40px" width="80px">&nbsp;www.Exigency.com</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarmenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarmenu">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="logout.php" class="nav-link" style="font-size: 20px;color:white;"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
            </ul>
        </div>
    </nav>
    <center>
        <h2 class="bg-dark text-white">
            WORKER'S DASHBOARD:
        </h2>
    </center>
    <span style="color:red;font-size:21px;float:right;font-weight:800;">
            You logged in as:-
            <?php echo $_SESSION["activeuser"]; ?>
        </span>
    <br><br>
    <div class="container1">
        <div class="row ">
            <div class="col-md-3 offset-1 ">
                <a href="profile-worker-front.php">
                    <div class="card">
                        <img src="pics/user.PNG" class="card-img-top" alt="..." width="200" height="170">
                        <div class="card-body">
                            <center>
                                <h5 class="card-title"><b>Personal Information</b></h5>
                                <p class="card-text">Save and Update profile</p>
                            </center>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
            <a href="citizen-search-by-worker.php" target="_blank">
                <div class="card">
                    <img src="pics/searchworker111.PNG" class="card-img-top" alt="..." width="200" height="170">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title"><b>Search Work</b></h5>
                            <p class="card-text">Get work from users</p>
                        </center>
                    </div>
                </div>
            </a>
        </div>
            <div class="col-md-3 ">
                <div class="card">
                    <img src="pics/rating.PNG" class="card-img-top" alt="..." width="200" height="170" data-toggle="modal" data-target="#rating-model">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title"><b>Request Rating<br><img src="pics/STAR.PNG" alt="" width="100" height="40"></b></h5>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="rating-model" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content"  style="background-color:gray;">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="exampleModalLabel"><b>REQUEST RATING:</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="container">
                            <div class="form-row">
                                <div class="col-md-12 form-group">
                                    <div class="fontuser">
                                        <label for=""><b>Your User-Id:</b></label>
                                        <input type="text" class="form-control" id="txtWor" name="txtWor" value='<?php echo $_SESSION["activeuser"];?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 form-group">
                                    <div class="fontuser">
                                        <center></center>
                                        <label for=""><b>Citizen's User-Id:</b></label>
                                        <input type="text" class="form-control" id="txtCit" name="txtCit">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <br>
                                    <span id="success">*</span>
                                    <br>
                                    <center>
                                        <input value="Send Request" id="submit" name="btn" class="btn btn-danger" style="width:400px" readonly>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
