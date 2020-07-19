<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="jq/jquery-1.8.2.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>www.Exigency.com</title>
    <style>
        body {
            font-family: Segoe Print;
            font-weight: 400;
        }

        .nav-link {
            font-size: 20px;
            font-weight: 900;
            color: white;
        }

        .link:hover {
            color: red;
        }

        input[type=text] {
            border-radius: 300px;
        }

        input[type=password] {
            border-radius: 300px;
        }

        .card {
            box-shadow: 2px 5px 5px 5px #888888;
        }
     #wait {
			width: 100px;
			height: 100px;
			background-image: url(pics/load1.gif);
			background-size: contain;
           background-repeat: no-repeat;
			display: none;
			position: absolute;
			left: 37%;
			z-index: 10;
        }
    </style>
</head>
<script>
    $(document).ready(function() {
        $("#txtUid").blur(function() {
            var uid = $("#txtUid").val();
            if(uid=="")
					{
						alert("FILL USER-ID:");
						
					}
            var actionUrl = "submit-ajax.php?uid=" + uid;
            $.get(actionUrl, function(response) {
                $("#errUid").html(response).css("color", "red");
            });
        });
        //-------------signup wait-------------- 
        $(document).ajaxStart(function() {
				$("#wait").show(900);
			});

			$(document).ajaxStop(function() {
				$("#wait").hide(900);
			});
        //checking uid available or not
        $("#submit").click(function() {
            var uid = $("#txtUid").val();
            var pass = $("#txtPass").val();
            var mobile = $("#txtMob").val();
            var category =$("input[name='option']:checked").val();
            var actionUrl = "submit-process.php?uid=" + uid + "&pass=" + pass + "&mobile=" + mobile + "&category=" + category;
            $.get(actionUrl, function(response) {
                $("#successmsg").html(response).css("color", "red");
            });
        });

        $("#txtMob").blur(function() {
            var r = /^[6-9]{1}[0-9]{9}$/;
            var pwd = $("#txtMob").val();

            if (r.test(pwd) == false) {
                $("#errmob").html("Invalid Mobile number").css("color", "red");
            } else {
                $("#errmob").html("Valid").css("color", "green");

            }
        });
        $("#login").click(function() {
            var uid = $("#txtuid").val();
            var pass = $("#txtpass").val();
            var actionUrl = "login-process.php?uid=" + uid + "&pass=" + pass;
            $.get(actionUrl, function(response) {
                $("#login-success").html(response).css("color", "red");
                if (response == "citizen") {
                    location.href = "dash-citizen.php";
                } else
                if (response.trim() == "worker") {

                    location.href = "worker-dashboard.php";
                }
            });
        });

        $("#loginnew").click(function() {
            $("#loginf").trigger("reset");
            $("#loginmsg").html("");
        });

        $("#submitnew").click(function() {
            $("#submitf").trigger("reset");
            $("#errUid").html("");
            $("#errmob").html("");
            $("#successmsg").html("");
        });

        $("#forget").click(function() {
            var uid = $("#txtuid").val();

            var actionUrl = "sms-send.php?uid=" + uid;
            $.get(actionUrl, function(response) {
                if (response == "Message sent to your mobile no.")
                    
                    alert("Msg done on registered mobile no.");
                else
                    alert("Msg done on registered mobile no.");
            });
        });

        //validations----on password--------------------------------------------------------------------------------->
        $("#txtPass").blur(function() {
            var r = /(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;

            var pwd = $("#txtPass").val();

            if (r.test(pwd) == false) {
                $("#errPwd").html("enter min-8 characters,numerics,spl symbol...").css("color", "red");
            } else {
                $("#errPwd").html("VALID").css("color", "green");

            }
        });
        
        $("#btnPwd").click(function(){
					if($("#txtPass").prop("type")=="password")
						$("#txtPass").prop("type","text");
					else
						$("#txtPass").prop("type","password");
						
				});

    });

</script>

<body style="background-color:lightgray;">
    <!--nav bar------------------------------------------------------------------------>
    <nav class="navbar navbar-expand-sm sticky-top navbar-dark bg-dark ">
        <a href="#" class="navbar-brand" style="font-size: 23px;"><img src="pics/exigency_logo.PNG" alt="" height="40px" width="80px">&nbsp;www.Exigency.com</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarmenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarmenu">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="#" class="nav-link link"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                <li class="nav-item"><a href="#about" class="nav-link link"><i class="fa fa-phone" aria-hidden="true"></i>Contact Us</a></li>
                <li class="nav-item"><a href="#" class="nav-link link" data-toggle="modal" data-target="#exampleModal" id="submitnew"><i class="fa fa-user-plus" aria-hidden="true"></i>SignUp</a></li>
                <li class="nav-item"><a href="#" class="nav-link link" data-toggle="modal" data-target="#loginmodal" id="loginnew"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</a></li>
            </ul>
        </div>
    </nav>
    <!--carousel--->
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="pics/c2.PNG" class="d-block w-100" alt="..." style="height:590px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="font-weight:900;color:yellow;">Every boss once started as a worker...</h5>
                    <p></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="pics/c1.jpg" class="d-block w-100" alt="..." style="height:590px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="font-weight:900; color:yellow;">Alone we can do so little; together we can do so much...</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="pics/c3.PNG" class="d-block w-100" alt="..." style="height:590px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="font-weight:900;color:yellow;">No human masterpiece has been created without a great labour...</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="pics/C4.PNG" class="d-block w-100" alt="..." style="height:590px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="font-weight:900;color:yellow;">Pleasure in job puts perfection in work</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="pics/c5.PNG" class="d-block w-100" alt="..." style="height:590px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="font-weight:900;color:yellow;">Without labours nothing prospers</h5>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <h2 style="font-weight:900;background-color:gray">
        <center>OUR SERVICES</center>
    </h2>
    <div class="container">
        <div class="row ">
            <div class="col-md-3">
                <div class="card">
                    <img src="pics/S1.PNG" class="card-img-top" alt="..." width="200" height="170">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title"><b>SEARCH WORKERS</b></h5>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="pics/S2.PNG" class="card-img-top" alt="..." width="200" height="170">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title"><b>GET WORK</b></h5>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="pics/post.PNG" class="card-img-top" alt="..." width="200" height="170">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title"><b>POST WORK</b></h5>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="pics/rating.PNG" class="card-img-top" alt="..." width="200" height="170">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title"><b>RATE WORKER</b></h5>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <h2 style="font-weight:900;background-color:gray">
        <center>MEET THE DEVELOPER</center>
    </h2>
    <div class="container">
        <div class="row">
            <div class="col-md-3" id="about">
                <div class="card">
                    <img src="pics/l.PNG" class="card-img-top" alt="..." width="200" height="190">
                    <div class="card-body">
                        <center>
                            <h6 class="card-title"><b>Hridyeshi Abrol</b></h6>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">ABOUT THE DEVELOPER</span>
                    </div>
                    <textarea class="form-control text-muted" aria-label="With textarea" rows="9" cols="90" readonly>(Certified FULL STACK WEB DEVELOPER) 
 CSE student
 #Email : cse.18bcs2401@gmail.com
 #Contact : 9149667032                            
                    </textarea>
                </div>
            </div>
            <div class="col-md-3" id="about">
                <div class="card">
                    <img src="pics/sir.PNG" class="card-img-top" alt="..." width="200" height="190">
                    <div class="card-body">
                        <center>
                            <h6 class="card-title"><b>Prog Rajesh K. Bansal</b></h6>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">ABOUT THE CONSULTANT</span>
                    </div>
                    <textarea class="form-control text-muted" aria-label="With textarea" rows="9" cols="90" readonly>Rajesh K. Bansal (SCJP-Sun Certified Java Programmer)
17 Years experience in Training & Development. Founder of realJavaOnline.com, loves coding in Java(J2SE, J2EE), C++,PHP, Python, AngularJS, Android. If you like tutorials and want to know more in depth about Java , buy his book "Real Java" available on amazon.in.
#Email : bcebti@gmail.com #Contact : 98722-46056
                    </textarea>
                </div>
            </div>

        </div>
    </div>
    <br>
    <h2 style="font-weight:900;background-color:gray">
        <center>REACH US</center>
    </h2>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <b>OUR LOCATION:</b>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3447.8807331546304!2d74.9523281!3d30.211951299999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391732a4f07278a9%3A0x4a0d6293513f98ce!2sBanglore%20Computer%20Education%20(C%20C%2B%2B%20Android%20J2EE%20PHP%20Python%20AngularJs%20Spring%20Java%20Training%20Institute)!5e0!3m2!1sen!2sin!4v1594663030172!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="col-md-5">
                <b>OUR FACEBOOK PAGE:</b>
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fpg%2FExigency-106816621109689%2Fposts%2F&tabs=timeline&width=500&height=500&small_header=true&adapt_container_width=false&hide_cover=true&show_facepile=false&appId" width="500" height="450" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
            </div>
        </div>
    </div>

    <!--SIGNUP MODEL-->
    <div class="modal " id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:gray;">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white " id="exampleModalLabel"><b><i class="fa fa-user-plus" aria-hidden="true"></i>SignUp</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="wait"></div>
                    <form action="submit-process.php" method="post" id="submitf">
                        <div class="form-group">
                            <div class="fontuser">
                                <label for="txtUid"><b>User-Id:</b></label>
                                <input type="text" class="form-control id" id="txtUid" name="txtUid" placeholder="Enter User Id" maxlength="16" required>
                                <i class="fa fa-user fa-lg"></i>
                            </div> <span id="errUid">*</span>
                        </div>
                        <div class="form-group">
                            <div class="fontusers">
                                <label for="exampleInputPassword1"><b>Password:</b></label>
                                <input type="password" class="form-control id" name="txtPass" id="txtPass" placeholder="Enter Password" required>
                                <button id="btnPwd" style="float:right;border-radius:300px;">
                                    <i class="fa fa-eye"></i>

                                </button>
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </div> <span id="errPwd">*</span>
                        </div>
                        <div class="form-group">
                            <div class="fontusers">
                                <label for="txtMob"><b>Mobile Number:</b></label>
                                <input type="text" class="form-control id" name="txtMob" id="txtMob" required>
                                <i class="fa fa-phone"></i>
                            </div><span id="errmob">*</span>
                        </div>
                        <label for="txtCat"><b>Select Category:</b></label><br>
                        <input type="radio" name="option" id="txtRad" value="worker"> Worker &nbsp; <br>
                        <input type="radio" name="option" id="txtRadc" value="citizen"> Citizen <br />
                        <div class="form-group">
                            <center> <input type="button" value="Signup" name="btn" class="btn btn-danger" id="submit" style="width:100px"></center>
                            <span id="successmsg" name="successmsg"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--login-model-->
    <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:gray;">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="exampleModalLabel"><b>Login</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="wait1"></div>
                    <form action="index-login.php" method="post" id="loginf">
                        <div class="form-group">
                            <label for="txtUid"><b>User-Id</b></label>
                            <input type="text" class="form-control" id="txtuid" name="uid" required>
                            <i class="fa fa-user fa-lg"></i>
                            <span id="login-success">*</span>
                            <!------------------------------------------------>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"><b>Password</b></label>
                            <input type="password" class="form-control" name="pass" id="txtpass">
                            <i class="fa fa-phone"></i>
                            <span id="errpassword"></span>
                        </div>
                        <div style="text-align: right;">
                            <a href="#" id="forget" style="color:red;font-weight:900;">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            <span id="errboth"></span>
                            <span id="loginmsg" name="loginmsg"></span>
                            <center> <input type="button" value="login" name="login" class="btn btn-danger" id="login" style="width:100px"></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
