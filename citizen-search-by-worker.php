<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <title>Citizen Search</title>
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
        }

    </style>
    <script>
        var varModule = angular.module("mymodule", []);
        varModule.controller("mycontroller", function($scope, $http) {
            $scope.jsonArray;
            $scope.jsonArrayCity;
            $scope.jsonArraySelected;

            $scope.doFetchCity = function() {
                $http.get("JSON-citizen-city.php").then(okFx, notOkFx);

                function okFx(response) {
                    //alert(JSON.stringify(response.data));
                    $scope.jsonArrayCity = response.data;
                    $scope.selObjectCity = $scope.jsonArrayCity[0];
                }

                function notOkFx(response) {
                    alert(response.data);
                }
            }


            $scope.doFetchCat = function() {
                $http.get("JSON-citizen-category.php").then(okFx, notOkFx);

                function okFx(response) {
                    //alert(JSON.stringify(response.data));
                    $scope.jsonArray = response.data;
                    $scope.selObject = $scope.jsonArray[0];
                }

                function notOkFx(response) {
                    alert(response.data); //shows error
                }
            }
            //works on button click
            $scope.doFetchSelected = function() {
                //alert($scope.selObject.mobile);
                $http.get("JSON-citizen-city$cat.php?category=" + $scope.selObject.category + "&city=" + $scope.selObjectCity.city).then(okFx, notOkFx);

                function okFx(response) {
                    //alert(JSON.stringify(response.data));
                    $scope.jsonArraySelected = response.data;
                }

                function notOkFx(response) {
                    alert(response.data);
                }
            }
            $scope.showDetails = function(uid) {
                $http.get("JSON-worker-contact.php?uid=" + uid).then(ok, notok)

                function ok(response) {
                    $scope.jsonArrayshowmodel = response.data;
                }

                function notok(response) {
                    alert(response.data);
                }
            }

        });

    </script>
</head>

<body ng-app="mymodule" ng-controller="mycontroller" ng-init="doFetchCat();doFetchCity();">

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
        <h3 class="bg-dark text-white">SEARCH WORK </h3>
    </center>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <span style="font-size: 20px; color:white;"><b>Select Category:</b></span>
                    <br>
                    <select ng-model="selObject" ng-options="obj.category for obj in jsonArray">SELECT</select>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <span style="font-size: 20px;color:white;"><b>Select City:</b></span>
                    <br>
                    <select ng-model="selObjectCity" ng-options="obj.city for obj in jsonArrayCity">SELECT</select>
                </center>
            </div>
        </div><br>
        <center>
            <div class="btn btn-danger" ng-click="doFetchSelected();">Search Work</div>
        </center>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-3" ng-repeat="obj in jsonArraySelected">
                <div class="card" style="height:300px;background-color:black; color:white;">
                    <div class="card-body">
                        <CENTER>
                            <h4 style="background-color:lightgray;"><b>Task</b></h4>
                        </CENTER>
                        <h6 class="card-title" style="font-size:15px;"><b>Task:&nbsp;</b>{{obj.problem}}</h6>
                        <p class="card-text" style="font-size:15px;">
                            <b>Location:</b>&nbsp;{{obj.location}}<br>
                            <b>City:</b> {{obj.city}}<br>
                            <b>Deadline:</b> {{obj.deadline}}</p>
                        <center>
                            <div ng-click="showDetails(obj.uid);" class="btn btn-danger" data-toggle="modal" data-target="#details">Get Contact Details</div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="details" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header" style="background-color:gray;color:white;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color:lightgray;color:black ;">
                    <div class="container">
                        <table cellpadding="10">
                            <tr>
                                <center>
                                    <td>
                                        <h3><b>Citizen's Info:</b></h3>
                                        <img src="upload/{{jsonArrayshowmodel[0].pic}}" class="card-img-top" style="width:150px;height:150px;border:2px solid black">
                                    </td>
                                </center>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <h6><b>Name:&nbsp;&nbsp;{{jsonArrayshowmodel[0].name}}</b></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <b> Address:</b>&nbsp;{{jsonArrayshowmodel[0].address}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <b>Contact:</b> {{jsonArrayshowmodel[0].mobile}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
