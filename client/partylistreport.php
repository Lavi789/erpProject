<?php
session_start();
if ((!isset($_SESSION['user_name']))) {
    header('refresh: 1;url=login.php');
    die('Please Login First...<br><br>Redirectiing in a sec to Login Page');
}
?>

<!DOCTYPE html>
<html lang="en" class="light">

<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="dist/images/hindalco.png" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hindalco</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="dist/css/app.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <!-- END: CSS Assets-->
</head>

<style>
    .dataTables_length select {
        width: 60px;
    }
</style>
<!-- END: Head -->

<body class="py-5 md:py-0">

    <!-- BEGIN: Mobile Menu Menu -->
    <?php
    $amenu = "master";
    include 'layout/mob.php'
    ?>
    <!-- END: Mobile Menu Menu -->

    <!-- BEGIN: Top Bar -->
    <?php
    $currentPage = 'Bank';
    include 'layout/top.php'
    ?>
    <!-- END: Top Bar -->

    <!-- BEGIN: Top Menu -->
    <?php
    $amenu = "master";
    include 'layout/masternav.pho'
    ?>
    <!-- END: Top Menu -->
	<style>
        .dataTables_length select
        {
            width:60px;
        }
    </style>	

<style>
        /* Hard-coded styles for badges */
        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
        }

        /* Custom badge styles for "Transferred, InActive and Resigned" status */
        .badge-other {
            color: white;
            background-color: red;
        }

        /* Custom badge styles for "Active" statuses */
        .badge-active {
            color: white;
            background-color: green;
        }
    </style>
    <!-- END: Head -->
                              
    <body>
    
                       <div class="box">
                            <div class="grid grid-cols-2  gap-2 m-5">

                                <div class="col-span-1  m-5">
                            
                                       <div class="form-group mt-5">
                                            <!-- <h3 class="intro-x font-bold text-2xl xl:text-xl text-center xl:text-left mt-5"><u>List For :</u></h3></br> -->
                                            <label  class="intro-x font-bold text-xl xl:text-xl text-center xl:text-left mt-5" for="listfor">Report For :</label>

                                      </div>
                                         <div class="mt-3 mb-3 form-check">
                                           <label for="flexRadioDefault1" class="max-w-xs flex p-3 block w-72 bg-white border border-cyan-600 rounded-none text-sm">
                                            <input type="radio" name="select"  id="flexRadioDefault1" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border-gray-700 checked:bg-blue-500 checked:border-blue-500 "checked>
                                            <label for="flexRadioDefault1" class="form-check-label ml-2">Branch </label>
                                        </label>
                                        </div>
                                        <div class=" mb-3 form-check">
                                           <label for="flexRadioDefault2" class="max-w-xs flex p-3 block w-72 bg-white border border-cyan-600 rounded-none text-sm">
                                            <input type="radio" name="select"  id="flexRadioDefault2" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border-gray-700 checked:bg-blue-500 checked:border-blue-500">
                                            <label for="flexRadioDefault2" class="form-check-label ml-2">Customer</label>
                                        </label>
                                        </div>
                                        <div class=" mb-3 form-check">
                                        <label for="flexRadioDefault3" class="max-w-xs flex p-3 block w-72 bg-white border border-cyan-600 rounded-none text-sm">
                                            <input type="radio" name="select"  id="flexRadioDefault3" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border-gray-700 checked:bg-blue-500 checked:border-blue-500">
                                            <label for="flexRadioDefault3" class="form-check-label ml-2">Contractor</label>
                                        </label>
                                        </div>
                                        <div class=" mb-3 form-check">
                                        <label for="flexRadioDefault4" class="max-w-xs flex p-3 block w-72 bg-white border border-cyan-600 rounded-none text-sm">
                                            <input type="radio" name="select"  id="flexRadioDefault4" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border-gray-700 checked:bg-blue-500 checked:border-blue-500">
                                            <label for="flexRadioDefault54" class="form-check-label ml-2">Other</label>
                                        </label>
                                        </div>
                                        <div class=" mb-3 form-check">
                                         <label for="flexRadioDefault5" class="max-w-xs flex p-3 block w-72 bg-white border border-cyan-600 rounded-none text-sm">
                                            <input type="radio" name="select"  id="flexRadioDefault5" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border-gray-700 checked:bg-blue-500 checked:border-blue-500">
                                            <label for="flexRadioDefault5" class="form-check-label ml-2">Supplier</label>
                                        </label>
                                        </div>
                                        <div class=" mb-3 form-check">
                                           <label for="flexRadioDefault6" class="max-w-xs flex p-3 block w-72 bg-white border border-cyan-600 rounded-none text-sm">
                                            <input type="radio" name="select"  id="flexRadioDefault6" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border-gray-700 checked:bg-blue-500 checked:border-blue-500">
                                            <label for="flexRadioDefault6" class="form-check-label ml-2">Transporter</label>
                                        </label>
                                        </div>
                                        
                                        
                                        
                               </div>
                              <div class="col-span-1">
                              <div class="mt-5 "> 
                                        <button class="btn btn-primary w-20 shadow-md mr-2 rounded-full" style="padding-right:16px;"  type="button" id="button">
                                            Show
                                        </button>
                                    </div>

                                    
                                    
                                    
                                </div> 
                                    
                
                            </div>
                         </div>
            </div>
             <!-- END: Content -->
        
       
            <script src="dist/js/app.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="dist/js/sweetalert2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </div>
    </body>
	<script>
    <script>
        $(document).ready(function() {
            $('#button').click(function() {
                var selectedRadio = $("input[name='select']:checked").val();
                var pageMapping = {
                    'Branch': 'generate_excel_branch.php',
                  
                };

                var pageUrl = pageMapping[selectedRadio];
                if (pageUrl) {
                    window.location.href = pageUrl;
                } else {
                    alert('Selected report not found!');
                }
            });
        });
    </script>

   
</html>  