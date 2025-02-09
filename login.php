<?php
session_start();
include('./conex/conex.php');
include('./clases/tron.php');

$website = 'https://tronvault.io';

if(isset($_POST['email_user']) and isset($_POST['pass_user'])){
    $email_user = $_POST['email_user'];
    $pass_user = $_POST['pass_user'];

    $obc = new cTrons();
    $matriz = $obc->loguearUsuario($email_user, $pass_user);
    $fila = mysqli_fetch_array($matriz);
    if (isset($fila['cod_user']) && $fila['cod_user'] != "") {
        $_SESSION['cod_user'] = $fila['cod_user'];
        $_SESSION['email_user'] = $fila['email_user'];
        echo "<script>window.location.href = '".$website."';</script>";
    }else{
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wallet</title>
  <link rel="icon" type="image/png" href="<?php echo $website;?>/assets/images/favicon.png" sizes="16x16">
  <!-- remix icon font css  -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/remixicon.css">
  <!-- BootStrap css -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/bootstrap.min.css">
  <!-- Apex Chart css -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/apexcharts.css">
  <!-- Data Table css -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/dataTables.min.css">
  <!-- Text Editor css -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/editor-katex.min.css">
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/editor.atom-one-dark.min.css">
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/editor.quill.snow.css">
  <!-- Date picker css -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/flatpickr.min.css">
  <!-- Calendar css -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/full-calendar.css">
  <!-- Vector Map css -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/jquery-jvectormap-2.0.5.css">
  <!-- Popup css -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/magnific-popup.css">
  <!-- Slick Slider css -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/slick.css">
  <!-- prism css -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/prism.css">
  <!-- file upload css -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/file-upload.css">
  
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/lib/audioplayer.css">
  <!-- main css -->
  <link rel="stylesheet" href="<?php echo $website;?>/assets/css/style.css">
</head>
<body>

<section class="auth bg-base d-flex flex-wrap">  
    <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="<?php echo $website;?>/assets/images/tronvault.jpg" alt="">
        </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <a href="<?php echo $website;?>" class="mb-40 max-w-100-px">
                    <img src="<?php echo $website;?>/assets/images/logo-chatgpt.png" alt="">
                </a>
                <h4 class="mb-12">Sign In to your Account</h4>
                <p class="mb-32 text-secondary-light text-lg">Welcome back! please enter your detail</p>
            </div>
            <form action="" method="post" enctype="multipart/form-data" >
                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" class="form-control h-56-px bg-neutral-50 radius-12" name="email_user" placeholder="Email">
                </div>
                <div class="position-relative mb-20">
                    <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span> 
                        <input type="password" class="form-control h-56-px bg-neutral-50 radius-12" name="pass_user" id="your-password" placeholder="Password">
                    </div>
                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                </div>
                <div class="">
                    <div class="d-flex justify-content-between gap-2">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input border border-neutral-300" type="checkbox" value="" id="remeber">
                            <label class="form-check-label" for="remeber">Remember me </label>
                        </div>
                        <a href="javascript:void(0)" class="text-primary-600 fw-medium d-none">Forgot Password?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign In</button>

                
                <div class="mt-32 text-center text-sm">
                    <p class="mb-0">Don’t have an account? <a href="<?php echo $website;?>/register/" class="text-primary-600 fw-semibold">Sign Up</a></p>
                </div>
                
            </form>
        </div>
    </div>
</section>

  <!-- jQuery library js -->
  <script src="<?php echo $website;?>/assets/js/lib/jquery-3.7.1.min.js"></script>
  <!-- Bootstrap js -->
  <script src="<?php echo $website;?>/assets/js/lib/bootstrap.bundle.min.js"></script>
  <!-- Apex Chart js -->
  <script src="<?php echo $website;?>/assets/js/lib/apexcharts.min.js"></script>
  <!-- Data Table js -->
  <script src="<?php echo $website;?>/assets/js/lib/dataTables.min.js"></script>
  <!-- Iconify Font js -->
  <script src="<?php echo $website;?>/assets/js/lib/iconify-icon.min.js"></script>
  <!-- jQuery UI js -->
  <script src="<?php echo $website;?>/assets/js/lib/jquery-ui.min.js"></script>
  <!-- Vector Map js -->
  <script src="<?php echo $website;?>/assets/js/lib/jquery-jvectormap-2.0.5.min.js"></script>
  <script src="<?php echo $website;?>/assets/js/lib/jquery-jvectormap-world-mill-en.js"></script>
  <!-- Popup js -->
  <script src="<?php echo $website;?>/assets/js/lib/magnifc-popup.min.js"></script>
  <!-- Slick Slider js -->
  <script src="<?php echo $website;?>/assets/js/lib/slick.min.js"></script>
  <!-- prism js -->
  <script src="<?php echo $website;?>/assets/js/lib/prism.js"></script>
  <!-- file upload js -->
  <script src="<?php echo $website;?>/assets/js/lib/file-upload.js"></script>
  <!-- audioplayer -->
  <script src="<?php echo $website;?>/assets/js/lib/audioplayer.js"></script>
  
  <!-- main js -->
  <script src="<?php echo $website;?>/assets/js/app.js"></script>

<script>
      // ================== Password Show Hide Js Start ==========
      function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function() {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    // Call the function
    initializePasswordToggle('.toggle-password');
  // ========================= Password Show Hide Js End ===========================
</script>
</body>
</html>

