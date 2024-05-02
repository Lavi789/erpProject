<?php
session_start();
if ((!isset($_SESSION['user_name']))) {
    header('refresh: 1;url=login.php');
    die('Please Login First...<br><br>Redirectiing in a sec to Login Page');
    require_once '../server/config/db.php';
}
// Include your database connection file
include '../server/config/db.php'; 

// Fetch itemgroup names from the database
try {
    

    $sql = "SELECT itemg_name FROM erpproj.itemgroup";
    $stmt = $conn->query($sql);
    $itemgroups = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $conn = null;
} catch (PDOException $e) {
    // Handle database connection error
    die('Database Error: ' . $e->getMessage());
}
?>
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
    include 'layout/nav.php'
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
                              
    <body class="py-5 md:py-0">
    <!-- Include your mobile menu, top bar, and top menu here -->

    <div class="box">
        <div class="grid grid-cols-2 gap-2 m-5">
        <div class="col-span-1 m-5" style="max-height: 300px; overflow-y: auto;">
    <div class="form-group mt-5">
        <label class="intro-x font-bold text-xl xl:text-xl text-center xl:text-left mt-5" for="listfor">Report For :</label>
    </div>

    <!-- Display itemgroup radio buttons -->
    <?php foreach ($itemgroups as $itemgroup) : ?>
        <div class="mb-3 form-check">
            <label for="<?= $itemgroup ?>" class="max-w-xs flex p-3 block w-72 bg-white border border-cyan-600 rounded-none text-sm">
                <input type="radio" name="select" id="<?= $itemgroup ?>" value="<?= $itemgroup ?>" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none border-gray-700 checked:bg-blue-500 checked:border-blue-500">
                <label for="<?= $itemgroup ?>" class="form-check-label ml-2"><?= $itemgroup ?></label>
            </label>
        </div>
    <?php endforeach; ?>
</div>
            <div class="col-span-1">
                <div class="mt-5">
                    <button class="btn btn-primary w-20 shadow-md mr-2 rounded-full" style="padding-right:16px;" type="button" id="button">
                        Show
                    </button>
                </div>
            </div>
        </div>
    </div>

    
                      
        
       
            <script src="dist/js/app.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="dist/js/sweetalert2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
        $(document).ready(function() {
            $('#button').click(function() {
                var selectedRadio = $("input[name='select']:checked").val();
                var pageMapping = {
                    'Branch': 'generate_excel_branch.php',
                    // Add other mappings here if needed
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
</body>

</html>
        
    </body>
	

   
</html>  