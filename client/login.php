<?php
session_start();
include('../server/config/db.php');

if (isset($_REQUEST['login'])) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE email=:email AND password=:password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch();
    if ($user) {
        $_SESSION['user_name'] = $user['user_name'];
        header('location:index.php');
    } else {
        echo "<script>alert('Invalid Login!!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="dist/images/hindalco.png" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SINGHBHUM MACHINOMETAL (P).LTD</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="dist/css/app.css" />
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<style>
        /* .login::after{
            background-image:url('dist/images/payroll-system.jpg');

        } */
         .my-input-group{
		font-size: 1rem;
		position: relative;
		--primary: #2196f3;
	  }
        .my-input{
            all: unset;
			 color: #333;
            padding: 0.75rem 0.5rem;
            border: 1px solid #9e9e9e;
            border-radius: 5px;
            transition: 150ms
            cubic-bezier(0.4, 0, 0.2, 1);
        }
        .my-label{
            position: absolute;
            top: 1rem;
			left: 1rem;
            color: #d4d4d4;
            pointer-events: none;
            transition: 150ms
            cubic-bezier(0.4, 0, 0.2, 1);
        }
        .my-input:focus{
            border: 1px solid
            var(--primary);
        }
        .my-input:is(:focus, :valid) ~ label{
            transform: translateY(-130%) scale(0.7);
            background-color: white;
            padding-inline: 0.3rem;
            color: var(--primary);
        }
    </style>
<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img class="w-6" src="">
                    <span class="text-white text-lg ml-3"></span>
                </a>
                <div class="my-auto">
                    <img alt="" class="-intro-x w-3 -mt-16" style="border:50%;width:25%;text-align:center;" src="">
                    <div class="-intro-x text-white font-medium text-3xl leading-tight mt-10">
                    SINGHBHUM MACHINOMETAL (P).LTD
                    </div>
                    <div class="-intro-x text-lg text-white text-opacity-70 dark:text-slate-250">
                        </div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <form method="post">

                <!-- <span class="intro-y  text-black absolute font-medium text-3xl leading-tight" style="font-family: 'Libre Baskerville', serif;"> </span> -->
                    <div class="h-screen xl:h-auto flex xl:py-0  xl:mt-0">
                        <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <div class="mt-12 py-5 text-center font-bold text-3xl leading-tight" style="border-radius:100% 100% 0px 0px;font-family: 'Libre Baskerville', serif;">
                        <!-- <img alt="" class="-intro-x w-1/2 mx-auto " src="dist/images/interlinkfoods.png"/> -->
                    </div>

                        <div class="card-body p-5 m-0" style="box-shadow:1px 5px 12px 10px rgba(184,194,230,1)">
                            <h2 class="intro-x mb-10 font-bold text-2xl xl:text-3xl text-center text-white" style="background-color:#02082d ;">
                                Login
                            </h2>
                        <div class="intro-x mt-3">
                            <input type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Email" name="email">
                            <input type="Password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password" name="password">
                        </div>
                        <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto hidden">
                                <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                            </div>
                        </div>
                        <div class="intro-x  text-center xl:text-left">
                            <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" name="login" value="login">Login</button>
                        </div>
                        <div class="mb-8 py-5 text-center font-bold absolute bottom-0 leading-tight">Developed By © Sigma eSolution Private Limited, Ranchi Jharkhand</div>
                            </div>
                    </div>
                </div>
            </form>
            <!-- END: Login Form -->
        </div>
    </div>
    <!-- BEGIN: JS Assets-->
    <script src="dist/js/app.js"></script>
    <!-- END: JS Assets-->
</body>

</html>