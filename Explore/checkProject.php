<?php
// Start session
session_start();

// Include database connection
include('../config/db.php');

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $getUserDetails = "SELECT * FROM `users` WHERE `email` = '$email'";
    $getUserDetailsStatus = mysqli_query($conn, $getUserDetails);
    $getUserDetailsRow = mysqli_fetch_assoc($getUserDetailsStatus);
    $name = $getUserDetailsRow['name'];
} else {
    header('Location: ../index.php?message=Please login first!');
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Project Description</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/darkmode.css">

    <style>
        body {
            background-color: #3aafa9;
        }
        .table-fill {
            background: white;
            border-radius: 3px;
            margin: auto;
            width: 100%;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 20px;
            text-align: left;
            color: black;
            font-size: 18px;
        }
        th {
            background: #1b1e24;
            color: #D5DDE5;
        }
        tr:nth-child(odd) td {
            background: #EBEBEB;
        }
        tr:hover td {
            background: #3aafa9;
            color: #FFFFFF;
        }
        .btn-btn-info {
            background-color: #2b7a78;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn-btn-primary {
            background-color: #2b7a78;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn-btn-secondary {
            background-color: #2b7a78;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark navbar-expand-md py-0 bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand py-0" href="/DevFuse/index.php" style="font-size: 30px;font-family: Aclonica, sans-serif;">
                <img src="../assets/logos/logo_white.png" alt="" height="80px" width="100px">DevFuse
            </a>
            <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="/DevFuse/index.php" style="padding: 8px;font-size: 20px;">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/DevFuse/index.php" style="padding: 8px;font-size: 20px;">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="../logout.php" style="font-size:20px;">LogOut</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <h1 class="text-center my-2 py-2">Project Details</h1>

    <?php
    // Fetch the project details
    $id = $_GET['id'];
    $getProject = "SELECT * FROM `projects` WHERE id=$id";
    $getProjectsStatus = mysqli_query($conn, $getProject) or die(mysqli_error($conn));
    $getAllProjectsRow = mysqli_fetch_assoc($getProjectsStatus);

    $userEmail = $getAllProjectsRow['email'];
    $projectName = $getAllProjectsRow['pname'];
    $projectDesc = $getAllProjectsRow['pdes'];
    $projectLink = $getAllProjectsRow['plink'];
    $projectField = $getAllProjectsRow['field'];
    $projectSS = $getAllProjectsRow['screenshot'];
    ?>

    <div class="container col-lg-7 px-0">
        <div class="card ">
            <img src="projects/<?=$projectName?>/<?=$projectSS?>" class="card-img-top" alt="Project Screenshot">
        </div>
        <div>
            <table class="table-fill">
                <tbody class="table-hover">
                    <tr>
                        <td class="text-left">Project Name</td>
                        <td class="text-left"><?php print($projectName); ?></td>
                    </tr>
                    <tr>
                        <td class="text-left">Project Field</td>
                        <td class="text-left"><?php print($projectField); ?></td>
                    </tr>
                    <tr>
                        <td class="text-left">Description</td>
                        <td class="text-left"><?php print($projectDesc); ?></td>
                    </tr>
                    <tr>
                        <td class="text-left">Owner Email</td>
                        <td class="text-left"><?php print($userEmail); ?></td>
                    </tr>
                    <tr>
                        <td class="text-left">Project Link</td>
                        <td class="text-left">
                            <a href="<?= $projectLink ?>" class="btn-btn-info" target="_blank">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <a href="mailto:<?php echo $userEmail; ?>?subject=Interested in Your Project - <?php echo urlencode($projectName); ?>&body=Hi,%0A%0AI am interested in your project '<?php echo urlencode($projectName); ?>'.%0A%0APlease let me know more details.%0A%0ARegards," 
                               class="btn-btn-primary">
                                I'm Interested
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer-distributed mt-5 pt-5 pb-2 px-0 bg-dark">
        <div class="container px-2">
            <div class="row">
                <div class="col-lg-7 col-sm-11">
                    <div class="footer-left">
                        <h3>Dev<span>Fuse</span></h3>
                        <p class="footer-links">
                            <a href="/DevFuse/index.php" class="link-1">Home</a>
                            <a href="/DevFuse/index.php#about_us">About</a>
                            <a href="/DevFuse/index.php#faq">FAQs</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-11">
                    <div class="footer-right text-center">
                        <p class="footer-company-about">
                            <span>About the company</span>
                            Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
                        </p>
                        <div class="rounded-social-buttons my-2">
                            <a class="social-button facebook" href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="social-button twitter" href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="social-button linkedin" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></a>
                            <a class="social-button github" href="https://www.github.com" target="_blank"><i class="fab fa-github"></i></a>
                            <a class="social-button instagram" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a class="social-button whatsapp" href="https://web.whatsapp.com/" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-dark px-1 text-center">
            <p class="text-white mt-2">Copyright &copy <?php echo date('Y') . " "; ?>DevFuse
            <a href="/DevFuse/admin/admin_login.php" class="btn-btn-secondary" style="margin-left:10px;">Admin Login</a>
            </span></p>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="../assets/js/darkmode.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
</body>

</html>
