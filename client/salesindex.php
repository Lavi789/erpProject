<!DOCTYPE html>
<html lang="en" class="light">

<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="dist/images/erplogo.jpg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ERP</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="dist/css/app.css" />
    <!-- END: CSS Assets-->
    <!-- <style>
        .content--top-nav {
            background-color: #030640; /* Background color for the entire content area */
            padding: 20px; /* Adjust padding as needed */
        }
        .page-title {
            background-color:#030640; /* Background color for the "Master" div */
            padding: 8px 12px; /* Adjust padding as needed */
            border-radius: 4px; /* Optional: Add border-radius for rounded corners */
            display: inline-block; /* Ensures the background color only covers the text */
            
        }
        .page-title h2 {
            color: #ffffff;
        }
    </style> -->
</head>
<!-- END: Head -->

<body class="py-5 md:py-0">

    <!-- BEGIN: Mobile Menu Menu -->
    <?php
    $amenu = "dashboard";
    include 'layout/mob.php'
    ?>
    <!-- END: Mobile Menu Menu -->

    <!-- BEGIN: Top Bar -->
    <?php
    $currentPage = 'Dashboard';
    include 'layout/top.php'
    ?>
    <!-- END: Top Bar -->

    <!-- BEGIN: Top Menu -->
    <?php
    $amenu = "dashboard";
    include 'layout/salesnav.php'
    ?>
    <!-- END: Top Menu -->

    <!-- BEGIN: Content -->
    <div class="content content--top-nav">
        <!-- BEGIN: General Report -->
        <div class="intro-y flex items-center h-10 mt-8">
            <div class="page-title">
                <h2 class="text-lg font-medium  truncate mr-5">
                    Master
                </h2>
            </div>
            <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
        </div>
        
    <!-- Element to animate -->
   <!-- Animated box -->
   
    <!-- END: Content -->

    <!-- BEGIN: JS Assets-->
    <script src="dist/js/app.js"></script>
    <!-- END: JS Assets-->

</body>

</html>
