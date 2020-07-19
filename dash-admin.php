<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="jq/bootstrap.min.js"></script>
    <script src="jq/angular.min.js"></script>
    <style>
        body {
            font-family: Segoe Print;
            font-weight: 400;
            background-image: url("pics/bg.PNG");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .card {
            box-shadow: 2px 5px 5px 5px #888888;
            height: 300px;
        }
    </style>
</head>
<body  >
    <nav class="navbar navbar-expand-sm sticky-top navbar-dark bg-dark ">
        <a href="#" class="navbar-brand" style="font-size: 23px;"><img src="pics/exigency_logo.PNG" alt="" height="40px" width="80px">&nbsp;www.Exigency.com</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarmenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarmenu">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="#" class="nav-link" style="font-size: 20px;color:white;"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
            </ul>
        </div>
    </nav>
    <center>
        <h2 class="bg-info text-white bg-dark">ADMIN'S-DASHBOARD:</h2>
    </center>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-4">
                <div class="card">
                    <a href="Manager-workers-front.php" target="_blank">
                        <img src="pics/user-manager.PNG" class="card-img-top" alt="..." width="200" height="170">
                        <div class="card-body">
                            <center>
                                <h5 class="card-title"><b>Admin Panel</b></h5>
                                <H6 class="card-text">BLOCK OR UNBLOCK USERS</H6>
                            </center>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>