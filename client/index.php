<?php
session_start();
if ((!isset($_SESSION['user_name']))) {
    header('location:login.php');
    die('Please Login First...<br><br>Redirectiing in a sec to Login Page');
}

require_once '../server/config/db.php';
?>

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
   
    <!-- END: Top Menu -->

    <!-- BEGIN: Content -->
    <div class="content content--top-nav">
        <!-- BEGIN: General Report -->
        <div class="intro-y flex items-center h-10 mt-8">
            <h2 class="text-lg font-small truncate mr-5">
                General Report
            </h2>
            <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
        </div>
        <div class="grid grid-cols-8 gap-6 mt-5">
            <div class="col-span-2">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="credit-card" class="report-box__icon text-primary"></i>
                            <div class="ml-auto">
                                
                            </div>
                        </div>
                        <div class="text-xl font-small leading-8 mt-6">Master</div>
                        <a href="masterindex.php"><div class="text-base text-slate-500 mt-1">open</div></a>
                        
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="shopping-cart" class="report-box__icon text-pending"></i>
                            <div class="ml-auto">
                                
                            </div>
                        </div>
                        <div class="text-xl font-small leading-8 mt-6">Sales</div>
                        <a href="salesindex.php"><div class="text-base text-slate-500 mt-1">open</div></a>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="shopping-bag" class="report-box__icon text-warning"></i>
                            <div class="ml-auto">
                               
                            </div>
                        </div>
                        <div class="text-xl font-small leading-8 mt-6">Purchase</div>
                        <div class="text-base text-slate-500 mt-1">open</div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="briefcase" class="report-box__icon text-success"></i>
                            <div class="ml-auto">
                                
                            </div>
                        </div>
                        <div class="text-xl font-small leading-8 mt-6">Material</div>
                        <div class="text-base text-slate-500 mt-1">open</div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="circle" class="report-box__icon text-success"></i>
                            <div class="ml-auto">
                               
                            </div>
                        </div>
                        <div class="text-xl font-small leading-8 mt-6">Excise</div>
                        <div class="text-base text-slate-500 mt-1">open</div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="user" class="report-box__icon text-success"></i>
                            <div class="ml-auto">
                               
                            </div>
                        </div>
                        <div class="text-xl font-small leading-8 mt-6">HRMS</div>
                        <div class="text-base text-slate-500 mt-1">open</div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="wallet" class="report-box__icon text-success"></i>
                            <div class="ml-auto">
                               
                            </div>
                        </div>
                        <div class="text-xl font-small leading-8 mt-6">FNA</div>
                        <div class="text-base text-slate-500 mt-1">open</div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="box" class="report-box__icon text-success"></i>
                            <div class="ml-auto">
                                
                            </div>
                        </div>
                        <div class="text-xl font-small leading-8 mt-6">Prodcution</div>
                        <div class="text-base text-slate-500 mt-1">open</div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="star" class="report-box__icon text-success"></i>
                            <div class="ml-auto">
                               
                            </div>
                        </div>
                        <div class="text-xl font-small leading-8 mt-6">Quality</div>
                        <div class="text-base text-slate-500 mt-1">open</div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="plus" class="report-box__icon text-success"></i>
                            <div class="ml-auto">
                               
                            </div>
                        </div>
                        <div class="text-xl font-small leading-8 mt-6">MIS</div>
                        <div class="text-base text-slate-500 mt-1">open</div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="user" class="report-box__icon text-success"></i>
                            <div class="ml-auto">
                                
                            </div>
                        </div>
                        <div class="text-xl font-small leading-8 mt-6">Administration</div>
                        <div class="text-base text-slate-500 mt-1">open</div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="menu" class="report-box__icon text-success"></i>
                            <div class="ml-auto">
                              
                            </div>
                        </div>
                        <div class="text-xl font-small leading-8 mt-6">Others</div>
                        <div class="text-base text-slate-500 mt-1">open</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: General Report -->
    </div>
    <!-- END: Content -->

    <!-- BEGIN: JS Assets-->
    <script src="dist/js/app.js"></script>
    <!-- END: JS Assets-->

</body>

</html>