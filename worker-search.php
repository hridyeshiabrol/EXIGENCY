`
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search Worker</title>
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
        varModule.controller("myController", function($scope, $http) {

            $scope.jsonArray; //just declared
            $scope.jsonArrayCity;
            $scope.jsonArraySelected; //just declared

            $scope.doFetchCity = function() {

                $http.get("JSON-fetch-city.php").then(okFx, notOkFx);

                function okFx(response) {
                    //alert(JSON.stringify(response.data));//data contains jsonArray-shows jsonArray 
                    $scope.jsonArrayCity = response.data; //point, from local to global
                    $scope.selObjectCity = $scope.jsonArrayCity[0]; //point
                }

                function notOkFx(response) {
                    alert(response.data); //shows error
                }
            }


            $scope.doFetchCat = function() {
                $http.get("JSON-fetch-worker-all.php").then(okFx, notOkFx);

                function okFx(response) {
                    //alert(JSON.stringify(response.data));//data contains jsonArray-shows jsonArray 
                    $scope.jsonArray = response.data; //point, from local to global
                    $scope.selObject = $scope.jsonArray[0]; //point
                }

                function notOkFx(response) {
                    alert(response.data); //shows error
                }
            }
            //=-=-=-=-=-=-=-=-=
            //works on button click
            $scope.doFetchSelected = function() {
                //alert($scope.selObject.mobile);
                $http.get("JSON-sel-city$cat.php?category=" + $scope.selObject.category + "&city=" + $scope.selObjectCity.city).then(okFx, notOkFx);

                function okFx(response) {
                    //alert(JSON.stringify(response.data));//data contains jsonArray-shows jsonArray 
                    $scope.jsonArraySelected = response.data;
                    //alert($scope.jsonArraySelected);
                }

                function notOkFx(response) {
                    alert(response.data); //shows error
                }

            }

            $scope.showDetails = function(index) {
                $scope.name = $scope.jsonArraySelected[index].name;
                $scope.orgName = $scope.jsonArraySelected[index].orgName;
                $scope.mobile = $scope.jsonArraySelected[index].mobile;
                $scope.address = $scope.jsonArraySelected[index].address;
                $scope.stat = $scope.jsonArraySelected[index].stat;
                $scope.city = $scope.jsonArraySelected[index].city;
                $scope.exp = $scope.jsonArraySelected[index].exp;
                $scope.special = $scope.jsonArraySelected[index].special;
                $scope.shop = $scope.jsonArraySelected[index].shop;
                $scope.other = $scope.jsonArraySelected[index].other;
            }
        });

    </script>
</head>

<body ng-app="mymodule" ng-controller="myController" ng-init="doFetchCat();doFetchCity();">
    
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
        <h3 class="bg-dark text-white">SEARCH WORKER<i class="fa fa-search" aria-hidden="true"></i>  </h3>
    </center>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <span style="font-size: 20px;"><b>Select Category:</b></span>
                    <br>
                    <select ng-model="selObject" ng-options="obj.category for obj in jsonArray">SELECT</select>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <span style="font-size: 20px;"><b>Select City:</b></span>
                    <br>
                    <select ng-model="selObjectCity" ng-options="obj.city for obj in jsonArrayCity">SELECT</select>
                </center>
            </div>
        </div><br>
        <center>
            <div class="btn btn-danger" ng-click="doFetchSelected();">Search Workers</div>
        </center>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3" ng-repeat="obj in jsonArraySelected" >
                <div class="card" style="height:350px;background-color:lightgray;">
                    <img src="workers/{{obj.orgName}}" height="130" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">
                            <center><b>NAME:&nbsp;{{obj.name}}</b></center>
                        </h6>
                        <p class="card-text"><b>Experience:</b>&nbsp;{{obj.exp}} &nbsp;years</p>
                        <p class="card-text"><b>Specialization:</b> {{obj.special}}</p>
                        <center>
                            <div ng-click="showDetails($index);" class="btn btn-danger" data-toggle="modal" data-target="#details">More Details</div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="details" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:gray;color:white;">
                    <h5 class="modal-title" id="exampleModalLabel"><b>WORKER'S DETAILS</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color:lightgray;color:black;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <center> <img src="workers/{{orgName}}" alt="worker-profile-pic" height="120px"></center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <b>NAME:</b> &nbsp;{{jsonArraySelected[0].name}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <b>MOBILE NO.</b> &nbsp;{{jsonArraySelected[0].mobile}}
                            </div>
                        </div>
                    <div class="form-row">
                        <div class="col-md-12 form-group">
                            <b>ADDRESS:</b> &nbsp;{{jsonArraySelected[0].address}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <b>STATE:</b> &nbsp;{{jsonArraySelected[0].stat}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <b>CITY:</b>&nbsp;{{jsonArraySelected[0].city}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <b>EXPERIENCE:</b>&nbsp;{{jsonArraySelected[0].exp}}
                        </div>
                    </div>
                       <div class="row">
                        <div class="col-md-12 form-group">
                            <b>SPECIALIZATION:</b>&nbsp;{{jsonArraySelected[0].special}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12  form-group">
                            <b>FIRM/SHOP:</b>&nbsp;{{jsonArraySelected[0].shop}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <b>OTHER INFO:</b>&nbsp;{{jsonArraySelected[0].other}}
                        </div>
                    </div>
                    </div></div></div></div>
    </div>
</body>
</html>
