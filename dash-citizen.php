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

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script src=jq/angular.min.js></script>
    <title>CITIZEN'S DASHBOARD</title>
    <style>
        body {
            font-family: Segoe Print;
            font-weight: 400;
            background-image: url("pics/bg.PNG");
            background-repeat: no-repeat;
            background-size: cover;
        }

        h4 {
            color: aliceblue;
        }

        p {
            font-size: 13px;
        }

        .navbar-brand {
            color: cornsilk;
            font-weight: 800;
        }

        img {
            border-radius: 50%;
        }

        .card {
            box-shadow: 2px 5px 5px 5px #888888;
            height: 260px;
        }

        .card-body {
            color: blue;
        }

        .hide {
            display: none;
        }

        .rating {
            direction: rtl;
        }

        .rating>label:hover::before,
        .rating>label:hover~label:before,
        .rating>input:checked~label:before {
            color: gold;
            content: "\2605";
            position: absolute;
        }

        rating>label:hover::before,
        .rating>label:hover~label:before {
            background-color: aqua;
        }
        input[type=text]{
            border-radius: 300px;
        }
         input[type=password]{
            border-radius: 300px;
        }

    </style>
    <script>
        var varModule = angular.module("mymodule", []);
        varModule.controller("mycontroller", function($scope, $http) {
            $scope.jsonArray;
            $scope.selObject;
            $scope.showdetails = function() {

                $http.get("Json-req-manager.php?uid=" + $scope.selObject).then(okFx, notokFx);

                function okFx(response) {
                    //alert(JSON.stringify(response.data));
                    $scope.jsonArray = response.data;
                }

                function notokFx(response) {
                    alert(response.data);
                }
            }
            $scope.doDel = function(item) {
                //alert(item);
                $http.get("JSON-delete-rid.php?rid=" + item).then(ok, notok);

                function ok(response) {
                    //alert(JSON.stringify(response.data));
                    $scope.showdetails();
                    $scope.jsonArray = response.data;
                    $scope.jsonArray.slice(item, 1);
                    $scope.object = " ";
                }

                function notok(response) {
                    alert(response.data);
                }
            }
            //for rating
            $scope.ratingsInfo;
            $scope.selObjectrate;
            $scope.fetchRequests = function() {
                $http.get("Citizen-fetch-rating.php?citizenuid=" + $scope.selObjectrate).then(okFx, notokFx);

                function okFx(response) {
                    //alert(JSON.stringify(response.data));
                    $scope.ratingsInfo = response.data;
                    console.log($scope.ratingsInfo);
                }

                function notokFx(response) {
                    alert(response.data);
                }
            }

            //post rating of stars
            $scope.ratingsInfo;
            $scope.ratingsValue;
            $scope.updateRatings = function(rid, workerUsername, index) {
                console.log(rid);
                var ele = document.getElementsByName(rid);
                for (i = 0; i < ele.length; i++) {
                    if (ele[i].checked) {
                        $scope.ratingsValue = ele[i].value;
                        $http.get("citizen-updateRatings.php?uid=" + workerUsername + "&total=" + $scope.ratingsValue + "&rid=" + rid).then(ok, notok);

                        function ok(response) {
                            if (response.data == "ok") {
                                alert("Done Sucessfully! THANKS FOR RATING.");
                                $scope.ratingsInfo.splice(index, 1);
                            }
                        }

                        function notok(response) {
                            alert(response.data); //shows error
                        }
                    }
                }

            }
        });

    </script>
</head>

<script>
    $(document).ready(function() {
        $("#submit").click(function() {
            var uid = $("#txtUid").val();
            var category = $("#txtCat").val();
            var problem = $("#txtArea").val();
            var location = $("#txtLoc").val();
            var city = $("#txtCity").val();

            var actionUrl = "citizen-post-req-process.php?uid=" + uid + "&category=" + category + "&problem=" + problem + "&location=" + location + "&city=" + city;
            $.get(actionUrl, function(response) {
                $("#req-msg").html(response).css("color", "red");
            });
        });
    });

</script>
<body ng-app="mymodule" ng-controller="mycontroller" >
<nav class="navbar navbar-expand-sm sticky-top navbar-dark bg-dark ">
    <a href="#" class="navbar-brand" style="font-size: 23px;"><img src="pics/exigency_logo.PNG" alt="" height="40px" width="80px">&nbsp;www.Exigency.com</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarmenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarmenu">
        <ul class="navbar-nav ml-auto">
            <span style="color:red;font-size:17px;float:right;margin-top:5px;font-weight:800;">
                You logged in as:-
                <?php echo $_SESSION["activeuser"]; ?>
            </span> &nbsp;
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-power-off" aria-hidden="true"></i>Logout</a></li>
        </ul>
    </div>
</nav>
<center>
    <h3 class="bg-dark text-white">Citizen's Dashboard</h3>
</center>
<div class="container">
    <div class="row ">
        <div class="col-md-4">
            <a href="citizen-front.php">
                <div class="card">
                    <img src="pics/user.PNG" class="card-img-top" alt="..." width="200" height="170">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title"><b>Personal Information</b></h5>
                            <p class="card-text">Save and update profile</p>
                        </center>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="pics/reqired.PNG" class="card-img-top" alt="..." width="200" height="170" data-toggle="modal" data-target="#post-model">
                <div class="card-body">
                    <center>
                        <h5 class="card-title"><b>Post Requirement</b></h5>
                        <p class="card-text">Post the work requirement</p>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <a href="worker-search.php" >
                <div class="card">
                    <img src="pics/searchworker111.PNG" class="card-img-top" alt="..." width="200" height="170">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title"><b>Search Worker</b></h5>
                            <p class="card-text">Fetch the required worker</p>
                        </center>
                    </div>
                </div>
            </a>
        </div>
    </div><br>
    <div class="row ">
        <div class="col-md-4 offset-2">
            <div class="card">
                <img src="pics/searchworker.PNG" class="card-img-top" alt="..." width="200" height="170" data-toggle="modal" data-target="#req-manager-model">
                <div class="card-body">
                    <center>
                        <h5 class="card-title"><b>Requirement Manager</b></h5>
                        <p class="card-text">See all your posted requirements</p>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="pics/rating.PNG" class="card-img-top" alt="..." width="200" height="170" data-toggle="modal" data-target="#rating-model">
                <div class="card-body">
                    <center>
                        <h5 class="card-title"><b>Rate Worker</b></h5>
                        <p class="card-text">You can rate the work</p>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="post-model" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:gray;">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="exampleModalLabel" style="color:white;"><b>Post Requirement</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="wait"></div>
                <form action="citizen-post-req-process.php" method="post">
                    <div class="container">
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <div class="fontuser">
                                    <label for=""><b>User-Id:</b></label>
                                    <input type="text" class="form-control" id="txtUid" name="txtUid" value='<?php echo $_SESSION["activeuser"]; ?>' readonly>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="fontuser">
                                    <label for=""><b>Category:</b></label>
                                    <select name="txtcategory" id="txtCat" name="txtCat" style="border-radius:300px;height:40px;">
                                        <option Selected>None</option>
                                        <option value="Carpenter">Carpenter</option>
                                        <option value="Cobbler">Cobbler</option>
                                        <option value="Electrician">Electrician</option>
                                        <option value="Mason">Mason</option>
                                        <option value="Painter">Painter</option>
                                        <option value="Plumber">Plumber</option>
                                        <option value="Pest Control">Pest Control</option>
                                        <option value="Tailor">Tailor</option>
                                        <option value="Tank Cleaner">Tank Cleaner</option>
                                        <option value="Barber">Barber</option>
                                        <option value="Car Cleaner">Car Cleaner</option>
                                        <option value="AC Service">AC Service</option>
                                        <option value="Chimney Service">Chimney Service</option>
                                        <option value="Refrigerator Repair">Refrigerator Repair</option>
                                        <option value="Geyser Repair">Geyser Repair</option>
                                        <option value="TV Repair">TV Repair</option>
                                        <option value="Washing Machine Repair">Washing Machine Repair</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for=""><b>What is fault/problem?</b></label>
                                <center>
                                    <textarea id="txtArea" name="txtArea" name="w3review" rows="6" cols="48">
                                    </textarea>
                                </center>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <div class="fontuser">
                                    <label for=""><b>Location of task:</b></label>
                                    <input type="text" class="form-control" id="txtLoc" name="txtLoc">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="fontuser">
                                    <label for=""><b>City:</b></label>
                                    <input type="text" class="form-control" id="txtCity" name="txtCity">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <br>
                                <center><span id="req-msg">*</span></center>
                                <br>
                                <center>
                                    <input value="Post Requirement" id="submit" name="btn" class="btn btn-danger" style="width:400px" readonly>
                                </center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--req manager-->
<div class="modal fade" id="req-manager-model" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:gray;">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="exampleModalLabel"><b>Requirement Manager</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for=""><b>Enter Your User Id:</b></label>
                                <input type="text" class="form-control" ng-model="selObject" ng-init="selObject='<?php echo $_SESSION["activeuser"];?>'" >
                            </div>
                        </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                       <center>
                                           <div class="btn btn-danger" style="width:420px" ng-click="showdetails();">Search Workers</div>
                                       </center>
                                        
                                    <br>
                                    <table width="400" style="background-color:white;" >
                                        <tr>
                                            <th>SNo.</th>
                                            <th>Category</th>
                                            <th>Problem</th>
                                            <th>Location</th>
                                            <th>City</th>
                                            <th>Remove</th>

                                        </tr>
                                        <tr ng-repeat="obj in jsonArray">
                                            <td>{{$index+1}}</td>
                                            <td>{{obj.category}}</td>
                                            <td>{{obj.problem}}</td>
                                            <td>{{obj.location}}</td>
                                            <td>{{obj.city}}</td>
                                            <td><input type="button" class="btn btn-danger" ng-click="doDel(obj.rid);" value="DELETE"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!---rating model---->
<div class="modal fade" id="rating-model" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:gray;">
            <div class="modal-header bg-dark" >
                <h5 class="modal-title" id="exampleModalLabel"><b>Rate The Worker</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="container">
                        <div class="form-row">
                            <form action="" method="post">
                                <div class="form-group col-md-12">
                                    <label for=""><b>User-Id</b></label>
                                    <input type="text" class="form-control" ng-model="selObjectrate" ng-init="selObjectrate='<?php echo $_SESSION["activeuser"];?>'" >
                                </div>
                                <div class="form-row">
                                <center>
                                    <div class="col-md-12">
                                    <div class="btn btn-danger" ng-click="fetchRequests();" style="width:420px">Fetch Request</div>
                                    </div>
                                </center>
                                </div>
                                <br><br>
                                <center>
                                <table width="420" style="background-color:white;margin-left:9px;">
                                    <tr>
                                        <th>RID</th>
                                        <th>Name</th>
                                        <th>Ratings</th>
                                        <th>Submit</th>
                                    </tr>
                                    <tr ng-repeat="obj in ratingsInfo">
                                        <td>{{obj.rid}}</td>
                                        <td>{{obj.workeruid}}</td>
                                        <td>
                                            <form>
                                                <div class="rating" >
                                                    <input type="radio" name={{obj.rid}} class="hide" id="star5-{{obj.rid}}" value="5"><label for="star5-{{obj.rid}}">&#9734;</label>
                                                    <input type="radio" name={{obj.rid}} class="hide" id="star4-{{obj.rid}}" value="4"><label for="star4-{{obj.rid}}">&#9734;</label>
                                                    <input type="radio" name={{obj.rid}} class="hide" id="star3-{{obj.rid}}" value="3"><label for="star3-{{obj.rid}}">&#9734;</label>
                                                    <input type="radio" name={{obj.rid}} class="hide" id="star2-{{obj.rid}}" value="2"><label for="star2-{{obj.rid}}">&#9734;</label>
                                                    <input type="radio" name={{obj.rid}} class="hide" id="star1-{{obj.rid}}" value="1"><label for="star1-{{obj.rid}}">&#9734;</label>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" ng-click="updateRatings(obj.rid,obj.workeruid,$index);">Post</button>
                                        </td>
                                    </tr>
                                </table>
                                </center>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>
