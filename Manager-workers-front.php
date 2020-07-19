<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="jq/bootstrap.min.js"></script>
    <script src="jq/angular.min.js"></script>
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Segoe Print;
            font-weight: 400;
        }

    </style>

    <script>
        var varModule = angular.module("mymodule", []);
        varModule.controller("myController", function($scope, $http) {

            $scope.jsonArray; //just declared
            $scope.selObject
            $scope.jsonArraySelected; //just declared
           //------------inorder to fill combo--------------------------------- 
            $scope.doFetchCat = function() {
                $http.get("json-admin-fetch-category.php").then(okFx, notOkFx);

                function okFx(response) {
                    (JSON.stringify(response.data)); 
                    $scope.jsonArray = response.data; 
                    $scope.selObject = $scope.jsonArray[0];
                }

                function notOkFx(response) {
                    alert(response.data);
                }
            }
            //-----------to display the data at button click-------------------------------
             $scope.doFetchSelected = function() {
                $http.get("json-fetch-users.php?category=" + $scope.selObject.category).then(okFx, notOkFx);

                function okFx(response) { 
                    $scope.jsonArraySelected = response.data;
                }
                function notOkFx(response) {
                    alert(response.data);
                }
            }
            //----------to delete record of user------------------------------------
             $scope.doDel = function(item) {
                $http.get("json-delete-user.php?uid=" + item).then(ok,notok);
                function ok(response) {
                    alert("Record Deleted successfully");
                    $scope.jsonArray = response.data;
                    $scope.jsonArray.slice(item,1);
                    $scope.object=" ";
                }            
                
                function notok(response) {
                    alert(response.data);
                }
			}
             //----------block record of user------------------------------------
             $scope.doBlock = function(item) {
                $http.get("json-blockuser.php?uid=" + item).then(ok,notok);
                function ok(response) {
                    alert("User blocked successfully");
                    $scope.jsonArray = response.data;
                    $scope.object=" ";
                }            
                function notok(response) {
                    alert(response.data);
                }
			}
             //----------unblock record of user------------------------------------
             $scope.doUnblock = function(item) {
                $http.get("json-unblockuser.php?uid=" + item).then(ok,notok);
                function ok(response) {
                    alert("User unblocked successfully");
                    $scope.jsonArray = response.data;
                    $scope.object=" ";
                }            
                
                function notok(response) {
                    alert(response.data);
                }
			}
             
        });

    </script>
</head>
<body style="background-color:lightgray;" ng-app="mymodule" ng-controller="myController" ng-init="doFetchCat()">
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
    <!-------------------------------------------------------------------------------->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <span style="font-size: 20px;"><b>Select Category:</b></span>
                    <br>
                    <select ng-model="selObject" ng-options="obj.category for obj in jsonArray" style="border-radius: 300px;">Fetch Users</select>
                </center>
            </div>
        </div>
        <br>
        <center>
            <div class="btn btn-danger" ng-click="doFetchSelected();">View Users</div>
        </center>
    </div>
    <br><br>
    <center>
        <div class="container">
         <table ng-repeat="obj in jsonArraySelected" border="1" rules="all" style="background-color:white;"> 
            <tr>
                <th>S.NO.</th>
                <th>USER-IDENTITY / NAME</th>
                <th>CONTACT</th>
                <th>CATEGORY</th>
                <th>BLOCK</th>
                <th>RESUME</th>
                <th>REMOVE</th>
            </tr>
             <tr>
                <td>{{$index+1}}</td>
                 <td>{{obj.uid}}</td> 
                 <td>{{obj.mobile}}</td>
                 <td>{{obj.category}}</td>
                 <td> <center><input type="button" ng-click="doBlock(obj.uid);" value="BLOCK" class="btn btn-danger"></center></td>
                 <td> <center><input type="button" ng-click="doUnblock(obj.uid);" value="RESUME" class="btn btn-danger"></center></td>
                 <td> <center><input type="button" ng-click="doDel(obj.uid);" value="DELETE" class="btn btn-danger"></center></td>
             </tr>
         </table>
     </div>
    </center>
     
</body>

</html>
