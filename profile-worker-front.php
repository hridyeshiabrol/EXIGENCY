<html>
<?php
    session_start();
    if(isset($_SESSION["activeuser"])==false)
    {
        header("location:index.php");
    }
?>
<head>
    <title>Profile-worker</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="jq/jquery-1.8.2.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!--********************style************************************-->
    <style>
        body {
            font-family: Segoe Print;
            font-weight: 400;
            background-image: url("pics/form-bg.PNG");
            background-repeat: no-repeat;
            background-size: cover;
        }
        input[type=text] {
            border-radius: 300px;
        }
    </style>

    <script>
        function showpreview(file) {

            if (file.files && file.files[0]) {
                var reader = new FileReader();
                reader.onload = function(ev) {
                    $('#prev').attr('src', ev.target.result);
                }
                reader.readAsDataURL(file.files[0]);
            }

        }

    </script>

    <script>
        function showpreviews(file) {

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
                var uid = $("#txtuid").val();
                var url = "profile-worker-json.php?uid=" + uid;
                $.getJSON(url, function(jsonAryResponse) {
                    if (jsonAryResponse.length == 0)
                        alert("invalid id or fill your record first");
                    else {
                        $("#txtname").val(jsonAryResponse[0].name).fadeIn(800);
                        $("#txtmob").val(jsonAryResponse[0].mobile).fadeIn(800);
                        $("#txtemail").val(jsonAryResponse[0].email).fadeIn(800);
                        $("#txtadd").val(jsonAryResponse[0].address).fadeIn(800);
                        $("#txtstat").val(jsonAryResponse[0].stat).fadeIn(800);
                        $("#txtcity").val(jsonAryResponse[0].city).fadeIn(800);
                        $("#txtshop").val(jsonAryResponse[0].shop).fadeIn(800);
                        $("#txtcategory").val(jsonAryResponse[0].category).fadeIn(800);
                        $("#txtspecial").val(jsonAryResponse[0].special).fadeIn(800);
                        $("#txtexp").val(jsonAryResponse[0].exp).fadeIn(800);
                        $("#txtother").val(jsonAryResponse[0].other);
                        $("#prev").attr("src", "workers/" + jsonAryResponse[0].orgName).fadeIn(800);
                        $("#hdn").val(jsonAryResponse[0].orgName).fadeIn(800);
                        $("#preview").attr("src", "aadhar/" + jsonAryResponse[0].adharname).slideDown(2800);
                        $("#hdnad").val(jsonAryResponse[0].adharname).slideDown(2800);
                    }
                });
            });
        });
    </script>
</head>

<body style="background-color:lightgray;">
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
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <center>
                    <h3><strong>Your Personal Info.</strong></h3>
                </center>
            </div>
            <div class="container">
                <form action="profile-worker-process.php" method="post" enctype="multipart/form-data" class="form-container">
                    <input type="hidden" id="hdn" name="hdn">
                    <input type="hidden" id="hdnad" name="hdnad">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="fontuser">
                                <label for="">&nbsp;&nbsp;&nbsp;<b>User id</b></label>
                                <input type="text" class="form-control" id="txtuid" name="txtuid" placeholder="Enter your user-id" value='<?php echo $_SESSION["activeuser"]; ?>'>
                                <i class="fa fa-user fa-lg"></i>
                            </div>

                        </div>
                        <div class="col-md-2 form-group">
                            <label for="">&nbsp;</label>
                            <input type="button" id="btnFetchProfile" style="border-radius:300px;" class="form-control btn btn-danger" value="Fetch Profile">

                        </div>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <div class="col-md-3">
                            <img src="pics/user1.PNG" id="prev" width="150" height="100" alt="" style="border:1px solid black;box-shadow: 2px 5px 5px 5px #888888;">
                        </div>
                    </div>
                    <!--uid next citizen name--->
                    <div class="form-row">
                        <div class="col-md-4 form-group">
                            <div class="fontuser">
                                <label for=""><b>Name</b></label>
                                <input type="text" class="form-control id" id="txtname" name="txtname" placeholder="Enter your full name">
                                <i class="fa fa-user fa-lg"></i>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <div class="fontusers">
                                <label for=""><b>Mobile</b></label>
                                <input type="text" class="form-control id" name="txtmob" id="txtmob" placeholder="Enter your contact no.">
                                <i class="fa fa-mobile"></i>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="fontuser">
                                <label for=""><b>Email</b></label>
                                <input type="text" class="form-control id" name="txtemail" id="txtemail" placeholder="abc@gmail.com">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <!--name and mobile--->
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <div class="fontusers">
                                <label for=""><b>Address</b></label>
                                <input type="text" class="form-control ids" name="txtadd" id="txtadd">
                                <i class="fa fa-map-marker"></i>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for=""><b>City</b></label>
                            <input type="text" class="form-control " name="txtcity" id="txtcity">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for=""><b>State</b></label><br>
                            <select name="txtstat" id="txtstat" class="comb" style="border-radius:300px;height:38px">
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

                        <div class="col-md-6 form-group">
                            <label for=""><b>Shop/Firm name</b></label><br>
                            <input type="text" class="form-control" name="txtshop" id="txtshop">
                        </div>
                        <div class="col-md-5 form-group">
                            <label for=""><b>Specialization</b></label><br>
                            <input type="text" class="form-control" name="txtspec" id="txtspec">

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for=""><b>Category</b></label><br>
                            <select name="txtcategory" id="txtcategory" class="comb" style="border-radius:300px;height:38px;width:550px">
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
                                <option value="AC Service and Repair">AC Service and Repair</option>
                                <option value="Chimney Service and Repair">Chimney Service and Repair</option>
                                <option value="Refrigerator Repair">Refrigerator Repair</option>
                                <option value="Geyser Service and Repair">Geyser Service and Repair</option>
                                <option value="TV Repair">TV Repair</option>
                                <option value="Washing Machine Service and Repair">Washing Machine Service and Repair</option>
                            </select>


                        </div>
                        <div class="col-md-5 form-group">
                            <label for=""><b>Experience</b></label>
                            <input type="text" class="form-control " name="txtexp" id="txtexp">
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="col-md-11 form-group">
                            <label for=""><b>Other information</b></label><br>
                            <input type="text" class="form-control" name="txtother" id="txtother">


                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <label for=""><b>Upload your Pic:</b></label>
                            <input type="file" name="profilePic" id="profilePic" onchange="showpreview(this);">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for=""><b>Aadhar card Pic:</b></label>
                            <input type="file" name="profilePics" id="profilePics" onchange="showpreviews(this);">
                        </div>
                        <div class="col-md-6">
                            <img src="pics/aadhar1.PNG" id="preview" width="425" height="200" alt="" style="border:1px solid black">
                        </div>
                    </div>
                    <div class="form-row">
                        
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <center><br><br>
                                <input type="submit" value="Save" name="btn" class="btn btn-danger" style="width:100px">

                                <input type="submit" value="Update" name="btn" class="btn btn-danger" style="width:100px">
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
