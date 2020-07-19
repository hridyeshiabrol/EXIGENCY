<html>
<?php
    session_start();
    if(isset($_SESSION["activeuser"])==false)
    {
        header("location:index.php");
    }
    ?>
<head>
    <title>Profile-citizen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="jq/jquery-1.8.2.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!--********************CSS************************************-->
    <style>
        body {
            font-family: Segoe Print;
            font-weight: 400;
             background-image: url("pics/form-bg.PNG");
            background-repeat: no-repeat;
            background-size: cover;
        }
        input[type=text] {
            border-radius: 30px;
        }

    </style>
    <script>
        function showpreview(file) {

            if (file.files && file.files[0]) {
                var reader = new FileReader();
                reader.onload = function(ev) {
                    $('#preview').attr('src', ev.target.result);
                }
                reader.readAsDataURL(file.files[0]);
            }

        }

    </script>
    <script>
        $(document).ready(function() {
            //--=-=-=-=-JSON=-=-=-=-=-=-=-=-=
            $("#btnFetchProfile").click(function() {
                var uid = $("#txtUid").val();
                var url = "profile-citizen-json.php?uid=" + uid;
                $.getJSON(url, function(jsonAryResponse) {
                    if (jsonAryResponse.length == 0)
                        alert("Fill your record first");
                    else {
                        $("#txtname").val(jsonAryResponse[0].name); 
                        $("#txtmob").val(jsonAryResponse[0].mobile); 
                        $("#txtadd").val(jsonAryResponse[0].address); 
                        $("#txtcity").val(jsonAryResponse[0].city);
                        $("#txtstat").val(jsonAryResponse[0].stat); 
                        $("#preview").attr("src", "upload/" + jsonAryResponse[0].pic);
                        $("#txtemail").val(jsonAryResponse[0].email);
                    }

                });
            });
        });

    </script>
</head>

<body >
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
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <form action="profile-citizen-process.php" method="post" enctype="multipart/form-data" class="form-container">
                    <input type="hidden" id="hdn" name="hdn">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <h2><strong>Your Personal Info.</strong></h2>
                            </center>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 form-group ">
                            <div class="fontuser">
                                <label for=""><b>User id</b></label>
                                <input type="text" class="form-control id" id="txtuid" name="txtuid" value='<?php echo $_SESSION["activeuser"];?>'>
                                <i class="fa fa-user fa-lg"></i>
                            </div> <span id="errUid">*</span>

                        </div>
                        <div class="col-md-2 form-group ">
                            <label for="">&nbsp;&nbsp;&nbsp;</label>
                            <input type="button" id="btnFetchProfile" class="form-control btn btn-danger" value="Fetch Profile" style="border-radius:300px;">
                        </div>
                        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
                        <div class="col-md-3 " align="right">
                            <h5><b>Profile-Photo</b></h5>
                            <img src="pics/user1.PNG" id="preview" width="100" height="100" alt="profile-pic">
                        </div>
                    </div>
                    <!--uid next citizen name--->
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <div class="fontuser">
                                <label for=""><b>Name</b></label>
                                <input type="text" class="form-control id" id="txtname" name="txtname" placeholder="full name">
                                <i class="fa fa-user fa-lg"></i>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="fontusers">
                                <label for=""><b>Mobile</b></label>
                                <input type="text" class="form-control id" name="txtmob" id="txtmob">
                                <i class="fa fa-mobile"></i>
                            </div>
                        </div>
                    </div>
                    <!--name and mobile--->
                    <div class="form-row">
                        <div class="col-md-12 form-group">
                            <div class="fontusers">
                                <label for=""><b>Address</b></label>
                                <input type="text" class="form-control ids" name="txtadd" id="txtadd">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <!--address--->
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for=""><b>City</b></label>
                            <input type="text" class="form-control " name="txtcity" id="txtcity">
                        </div>
                        <div class="col-md-6 form-group" >
                            <label for=""><b>State</b></label><br>
                            <select name="txtstat" id="txtstat" class="comb" style="border-radius:300px;height:40px;width:550px;">
                                <option Selected>None</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for=""><b>Upload Pic</b></label> <br>

                            <input type="file" name="profilePic" id="profilePic" onchange="showpreview(this);">
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="fontuser">
                                <label for=""><b>Email</b></label>
                                <input type="text" class="form-control id" name="txtemail" id="txtemail" placeholder="abc@gmail.com">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                        </div>

                    </div>
                    <!-------------------------------------------------------------->
                    <div class="form-row">
                        <div class="col-md-12">
                            <center>
                                <input type="submit" value="Save" name="btn" class="btn btn-danger" style="width:100px">
                                <input type="submit" value="update" name="btn" class="btn btn-danger " style="width:100px">

                            </center>
                        </div>
                    </div>

                </form>
                <!--form******************************************************************-->
            </div>
        </div>
    </div>
</body>
