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
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x mt-10 font-bold text-2xl xl:text-3xl text-center xl:text-left">
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