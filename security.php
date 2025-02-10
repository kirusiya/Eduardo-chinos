<?php
include('./include/core.php');

// Inicializar la variable $error
$error = 3;

// Resto del código para actualizar el perfil...

if(
    isset($_POST['nom_user']) && $_POST['nom_user']!=='' && 
    isset($_POST['user_name']) && $_POST['user_name']!=='' && 
    isset($_POST['user_phone']) && $_POST['user_phone']!=='' && 
    isset($_POST['user_country']) && $_POST['user_country']!==''
){

    $cod_user = $_SESSION['cod_user'];
    $nom_user = $_POST['nom_user'];
    $user_name = $_POST['user_name'];
    $user_phone = $_POST['user_phone'];
    $user_country = $_POST['user_country'];
    $user_pic = isset($_POST['user_pic']) ? $_POST['user_pic'] : '';

    /*verificar nom_user*/

    $obc_v = new cTrons();
    $matriz_v = $obc_v->verificarUserName($user_name, $cod_user);
    $fila_v = mysqli_fetch_array($matriz_v);
    if (isset($fila_v['cod_user']) && $fila_v['cod_user'] != "") {//verifico si exsite
        $error = 1;// si exsite se muestra el alert danger
    }else{
        /*actualizar usuario*/
        
        //sino existe se realiza la actualizacion y se muestra el alert succes
        $obc_a = new cTrons();
        $matriz_a = $obc_a->actualizarUsuario($cod_user, $nom_user, $user_name, $user_phone, $user_country, $user_pic);
        $error = 0;//no existe error y se muestra el aler success

        /*actualizar usuario*/
    }


    /*verificar nom_user*/
}

// Actualizar contraseña
if(
    isset($_POST['pass_user']) && $_POST['pass_user'] !== '' &&
    isset($_POST['confirm_pass']) && $_POST['confirm_pass'] !== ''
){
    $cod_user = $_SESSION['cod_user'];
    $pass_user = $_POST['pass_user'];

    $obc_p = new cTrons();
    $matriz_p = $obc_p->actualizarPassword($cod_user, $pass_user);
    $error = 2; // Contraseña actualizada con éxito
}

// Obtener datos del usuario
$obc = new cTrons();
$result = $obc->obtenerDatosUsuario($_SESSION['cod_user']);
$user_data = mysqli_fetch_array($result);

// Verificar si se encontró el usuario
if(!isset($user_data['cod_user']) || $user_data['cod_user'] == "") {
    echo "<script>window.location.href = '".$website."/logout/';</script>";
}

// Extraer datos del usuario con operadores ternarios
$nom_user = isset($user_data['nom_user']) ? $user_data['nom_user'] : '';
$email_user = isset($user_data['email_user']) ? $user_data['email_user'] : '';
$user_name = isset($user_data['user_name']) ? $user_data['user_name'] : '';
$user_phone = isset($user_data['user_phone']) ? $user_data['user_phone'] : '';
$user_country = isset($user_data['user_country']) ? $user_data['user_country'] : '';
$user_pic = isset($user_data['user_pic']) ? $user_data['user_pic'] : '';


$avatar_profile = (!empty($user_pic) && $user_pic !== '') ? "avatar/".$user_pic : "user-grid/user-grid-img14.png";


?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Security - BackUp</title>
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
<?php include('./includes/aside.php'); ?>

<main class="dashboard-main">
   <?php include('./includes/navbar.php'); ?>
   
   <div class="dashboard-main-body">
       <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
         <h6 class="fw-semibold mb-0">Back Up</h6>
         <ul class="d-flex align-items-center gap-2">
           <li class="fw-medium">
             <a href="<?php echo $website;?>" class="d-flex align-items-center gap-1 hover-text-primary">
               <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
               Security
             </a>
           </li>
           <li>-</li>
           <li class="fw-medium">BackUp</li>
         </ul>
       </div>






<section class="row gy-4">
    <div class="col-lg-6">
        <div class="card h-100 p-0">
            <div class="card-header border-bottom bg-base py-16 px-24">
                <h6 class="text-lg fw-semibold mb-0">Secret Phrase</h6>
                <p>Enter a 12-word recovery phrase to restore your wallet at any time.</p>
            </div>
            <div class="card-body p-24">
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <button id="generate-btn" type="button" class="btn btn-warning-100 text-warning-600 radius-8 px-32 py-11" 
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-custom-class="tooltip-warning"
                        data-bs-title="Generate a 12-word phrase">
                        Generate the 12 words
                    </button>
                    <button id="download-btn" type="button" class="btn btn-primary-50 text-primary-600 radius-8 px-32 py-11" disabled>
                        Download
                    </button>
                </div>
                <div id="phrase-container" class="mt-3 text-lg fw-semibold"></div>
                <div class="alert alert-warning mt-3" role="alert">
                    Store your 12 words in a safe place.
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    const words = [
        "apple", "banana", "cherry", "dragon", "elephant", "falcon", "grape", "hammer", "island", "jungle", "kite", "lemon", "mountain", "notebook", "octopus", "piano", "quartz", "river", "sunshine", "tornado", "umbrella", "volcano", "whistle", "xylophone", "yogurt", "zeppelin",
        "anchor", "breeze", "cactus", "diamond", "emerald", "feather", "galaxy", "horizon", "iceberg", "journey", "koala", "labyrinth", "meteor", "nebula", "ocean", "parrot", "quiver", "rainbow", "spectrum", "treasure", "universe", "voyager", "wildflower", "xenon", "yellow", "zenith",
        "avalanche", "boulder", "cinnamon", "dolphin", "echo", "firefly", "gondola", "harbor", "iguana", "jigsaw", "kangaroo", "lantern", "meadow", "nomad", "opal", "penguin", "quokka", "ripple", "seagull", "topaz", "uplift", "valley", "wander", "xerox", "yodel", "zebra"
    ];
    let generatedWords = [];
    
    document.getElementById("generate-btn").addEventListener("click", function() {
        if (generatedWords.length === 0) {
            generatedWords = [];
            while (generatedWords.length < 12) {
                let randomWord = words[Math.floor(Math.random() * words.length)];
                if (!generatedWords.includes(randomWord)) {
                    generatedWords.push(randomWord);
                }
            }
            
            const phraseContainer = document.getElementById("phrase-container");
            phraseContainer.innerHTML = generatedWords.map((word, index) => `${index + 1}. ${word}`).join("<br>");
            
            document.getElementById("download-btn").disabled = false;
        }
    });
    
    document.getElementById("download-btn").addEventListener("click", function() {
        if (generatedWords.length > 0) {
            const text = generatedWords.map((word, index) => `${index + 1}. ${word}`).join("\n");
            const blob = new Blob([text], { type: "text/plain" });
            const a = document.createElement("a");
            a.href = URL.createObjectURL(blob);
            a.download = "recovery-phrase.txt";
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    });
</script>


	   
	   
	   
	   
	

	   
	   
	   
	   
	   


     <!--  <div class="row gy-4">
           <div class="col-lg-4">
               <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                   <img src="<?php echo $website;?>/assets/images/user-grid/user-grid-bg1.png" alt="" class="w-100 object-fit-cover">
                   <div class="pb-24 ms-16 mb-24 me-16  mt--100">
                       <div class="text-center border border-top-0 border-start-0 border-end-0">
                           <img src="<?php echo $website.'/assets/images/'.$avatar_profile; ?>" alt="" class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                           <h6 class="mb-0 mt-16"><?php echo $nom_user ? $nom_user : 'No Name Set'; ?></h6>
                           <span class="text-secondary-light mb-16"><?php echo $email_user; ?></span>
                       </div>
                       <div class="mt-24">
                           <h6 class="text-xl mb-16">Personal Info</h6>
                           <ul>
                               <li class="d-flex align-items-center gap-1 mb-12">
                                   <span class="w-30 text-md fw-semibold text-primary-light">Full Name</span>
                                   <span class="w-70 text-secondary-light fw-medium">: <?php echo $nom_user ? $nom_user : 'Not set'; ?></span>
                               </li>
                               <li class="d-flex align-items-center gap-1 mb-12">
                                   <span class="w-30 text-md fw-semibold text-primary-light">Username</span>
                                   <span class="w-70 text-secondary-light fw-medium">: <?php echo $user_name ? $user_name : 'Not set'; ?></span>
                               </li>
                               <li class="d-flex align-items-center gap-1 mb-12">
                                   <span class="w-30 text-md fw-semibold text-primary-light">Email</span>
                                   <span class="w-70 text-secondary-light fw-medium">: <?php echo $email_user; ?></span>
                               </li>
                               <li class="d-flex align-items-center gap-1 mb-12">
                                   <span class="w-30 text-md fw-semibold text-primary-light">Phone</span>
                                   <span class="w-70 text-secondary-light fw-medium">: <?php echo $user_phone ? $user_phone : 'Not set'; ?></span>
                               </li>
                               <li class="d-flex align-items-center gap-1 mb-12">
                                   <span class="w-30 text-md fw-semibold text-primary-light">Country</span>
                                   <span class="w-70 text-secondary-light fw-medium">: <?php echo $user_country ? $user_country : 'Not set'; ?></span>
                               </li>
                           </ul>
                       </div>
                   </div>
               </div>
           </div>-->




      <!--     <div class="col-lg-8">
               <div class="card h-100">
                   <div class="card-body p-24">

                        <!-- verificaciones 
                        <?php if($error === 0): ?>
                        <div class="alert alert-success bg-success-100 text-success-600 border-success-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between mb-20" role="alert">
                            <div class="d-flex align-items-center gap-2">
                                <iconify-icon icon="akar-icons:double-check" class="icon text-xl"></iconify-icon>
                                Data Updated Successfully! 
                            </div>
                            <button class="remove-button text-success-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                        </div>
                        <?php endif; ?>

                        <?php if($error === 1): ?>
                        <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between  mb-20" role="alert">
                            <div class="d-flex align-items-center gap-2">
                                <iconify-icon icon="mdi:alert-circle-outline" class="icon text-xl"></iconify-icon>
                                The username you entered is already taken! 
                            </div>
                            <button class="remove-button text-danger-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                        </div>
                        <?php endif; ?>
                        
                        <?php if($error === 2): ?>
                        <div class="alert alert-success bg-success-100 text-success-600 border-success-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between mb-20" role="alert">
                            <div class="d-flex align-items-center gap-2">
                                <iconify-icon icon="akar-icons:double-check" class="icon text-xl"></iconify-icon>
                                Password Updated Successfully! 
                            </div>
                            <button class="remove-button text-success-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                        </div>
                        <?php endif; ?>-->




                        <!-- verificaciones -->

                        <!-- error pass -->
                       <!-- <div id="pass_error" class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between  mb-20 d-none" role="alert">
                            <div class="d-flex align-items-center gap-2">
                                <iconify-icon icon="mdi:alert-circle-outline" class="icon text-xl"></iconify-icon>
                                <span class="alert-content">Passwords are not equal!! </span>
                            </div>
                            <button class="remove-button text-danger-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                        </div>        
                        error pass -->

                      <!-- <ul class="nav border-gradient-tab nav-pills mb-20 d-inline-flex" id="pills-tab" role="tablist">
                           <li class="nav-item" role="presentation">
                             <button class="nav-link d-flex align-items-center px-24 active" id="pills-edit-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-edit-profile" type="button" role="tab" aria-controls="pills-edit-profile" aria-selected="true">
                               Edit Profile 
                             </button>
                           </li>
                           <li class="nav-item" role="presentation">
                             <button class="nav-link d-flex align-items-center px-24" id="pills-change-passwork-tab" data-bs-toggle="pill" data-bs-target="#pills-change-passwork" type="button" role="tab" aria-controls="pills-change-passwork" aria-selected="false" tabindex="-1">
                               Change Password 
                             </button>
                           </li>
                           <li class="nav-item" role="presentation">
                             <button class="nav-link d-flex align-items-center px-24" id="pills-notification-tab" data-bs-toggle="pill" data-bs-target="#pills-notification" type="button" role="tab" aria-controls="pills-notification" aria-selected="false" tabindex="-1">
                               Notification Settings
                             </button>
                           </li>
                       </ul>

                       <div class="tab-content" id="pills-tabContent">   
                           <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                               <h6 class="text-md text-primary-light mb-16">Profile Image</h6>


                              Upload Image Start 


                               <div class="mb-24 mt-16">
                                   <div class="avatar-upload">
                                           <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                               <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" hidden>
                                               <label for="imageUpload" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                   <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                               </label>
                                           </div>
                                           <div class="avatar-preview">
                                               <div id="imagePreview" style="background-image: url('<?php echo $website.'/assets/images/'.$avatar_profile; ?>');">
                                           </div>
                                       </div>

                                   </div>

                                  barra de progreso 



                                   <div id="progressImage" class="progress h-8-px  bg-primary-50 mt-20 w-50 d-none" role="progressbar" aria-label="Basic example" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated rounded-pill bg-primary-600" style="width: 20%"></div>
                                    </div>



                                    barra de progreso 



                                   
                               </div>

                        Upload Image End 



                               <form action="" method="post">
                                   <div class="row">
                                       <div class="col-sm-6">
                                           <div class="mb-20">
                                               <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Full Name <span class="text-danger-600">*</span></label>
                                               <input type="text" class="form-control radius-8" id="name" name="nom_user" value="<?php echo $nom_user; ?>" placeholder="Enter Full Name" required>
                                           </div>
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="mb-20">
                                               <label for="username" class="form-label fw-semibold text-primary-light text-sm mb-8">Username <span class="text-danger-600">*</span></label>
                                               <input type="text" class="form-control radius-8" id="username" name="user_name" value="<?php echo $user_name; ?>" placeholder="Enter Username" required>
                                           </div>
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="mb-20">
                                               <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                                               <input type="email" class="form-control radius-8" id="email" name="email_user" value="<?php echo $email_user; ?>" readonly>
                                           </div>
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="mb-20">
                                               <label for="phone" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone <span class="text-danger-600">*</span></label>
                                               <input type="tel" class="form-control radius-8" id="phone" name="user_phone" value="<?php echo $user_phone; ?>" placeholder="Enter Phone Number" required>
                                           </div>
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="mb-20">
                                               <label for="country" class="form-label fw-semibold text-primary-light text-sm mb-8">Country <span class="text-danger-600">*</span></label>
                                               <input type="text" class="form-control radius-8" id="country" name="user_country" value="<?php echo $user_country; ?>" placeholder="Enter Country" required>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="d-flex align-items-center justify-content-center gap-3">
                                       <input type="hidden" name="user_pic" id="user_pic" value="<?php echo $user_pic?>"> 
                                       <button type="button" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8"> 
                                           Cancel
                                       </button>
                                       <button type="submit" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8"> 
                                           Save
                                       </button>
                                   </div>
                               </form>
                           </div>

                           <div class="tab-pane fade" id="pills-change-passwork" role="tabpanel" aria-labelledby="pills-change-passwork-tab" tabindex="0">
                                <form action="" method="post" id="form_pass"> 
                                    <div class="mb-20">
                                        <label for="your-password" class="form-label fw-semibold text-primary-light text-sm mb-8">New Password <span class="text-danger-600">*</span></label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control radius-8" name="pass_user" id="your-password" placeholder="Enter New Password*">
                                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                                        </div>
                                    </div>
                                    <div class="mb-20">
                                        <label for="confirm-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmed Password <span class="text-danger-600">*</span></label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control radius-8" name="confirm_pass" id="confirm-password" placeholder="Confirm Password*">
                                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#confirm-password"></span>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8"> 
                                        Change Password
                                    </button>
                                </form>    
                           </div>

                           <div class="tab-pane fade" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab" tabindex="0">
                               <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                   <label for="companzNew" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                   <div class="d-flex align-items-center gap-3 justify-content-between">
                                       <span class="form-check-label line-height-1 fw-medium text-secondary-light">Company News</span>
                                       <input class="form-check-input" type="checkbox" role="switch" id="companzNew">
                                   </div>
                               </div>
                               <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                   <label for="pushNotifcation" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                   <div class="d-flex align-items-center gap-3 justify-content-between">
                                       <span class="form-check-label line-height-1 fw-medium text-secondary-light">Push Notification</span>
                                       <input class="form-check-input" type="checkbox" role="switch" id="pushNotifcation" checked>
                                   </div>
                               </div>
                               <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                   <label for="weeklyLetters" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                   <div class="d-flex align-items-center gap-3 justify-content-between">
                                       <span class="form-check-label line-height-1 fw-medium text-secondary-light">Weekly News Letters</span>
                                       <input class="form-check-input" type="checkbox" role="switch" id="weeklyLetters" checked>
                                   </div>
                               </div>
                               <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                   <label for="meetUp" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                   <div class="d-flex align-items-center gap-3 justify-content-between">
                                       <span class="form-check-label line-height-1 fw-medium text-secondary-light">Meetups Near you</span>
                                       <input class="form-check-input" type="checkbox" role="switch" id="meetUp">
                                   </div>
                               </div>
                               <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                   <label for="orderNotification" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                   <div class="d-flex align-items-center gap-3 justify-content-between">
                                       <span class="form-check-label line-height-1 fw-medium text-secondary-light">Orders Notifications</span>
                                       <input class="form-check-input" type="checkbox" role="switch" id="orderNotification" checked>
                                   </div>
                               </div>
                           </div>-->

                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <?php include('./includes/footer.php'); ?>
 </main>
 
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
   // ======================== Upload Image Start =====================
   function readURL(input) {
        if (input.files && input.files[0]) {
            var file = input.files[0];
            var allowedTypes = ['image/png', 'image/jpg', 'image/jpeg'];
            
            if (!allowedTypes.includes(file.type)) {
                alert("File type not allowed!");
                return;
            }

            var cod_user = '<?php echo $_SESSION['cod_user']; ?>';

            if (!file || !cod_user) {
                console.log("Error: 'file' or 'cod_user' are empty or don't exist.");
                return;
            }

            var formData = new FormData();
            formData.append('user_pic', file);
            formData.append('cod_user', cod_user);
            formData.append('action', 'actualizarImagen');

            //console.log(formData);

            // Realizar la solicitud AJAX para actualizar la imagen
            $.ajax({
                url: '<?php echo $website; ?>/ajax.php', 
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('#progressImage').removeClass('d-none');
                            $('#progressImage .progress-bar').css('width', percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    console.log("Raw response:", response);
                    var responseArray = response.split("|");
                    var respuesta = responseArray[0].trim();
                    var nombre_imagen = responseArray[1].trim();
                    if (respuesta === 'ok') {
                        $('#imagePreview').css('background-image', 'url(<?php echo $website; ?>/assets/images/avatar/' + nombre_imagen + ')');
                        $('#user_pic').val(nombre_imagen);
                        $('#progressImage').addClass('d-none');
                        $('#imageUpload').val('')
                    } else {
                        // Manejar errores si es necesario
                        console.log('Error al actualizar la imagen: ' + response);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // ver errores del ajax
                    console.log('Error en la solicitud AJAX: ' + textStatus);
                }
            });
        }
    }

    $("#imageUpload").change(function() {
        readURL(this);
    });
   // ======================== Upload Image End =====================

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

<script>    
    $('.remove-button').on('click', function() {
        $(this).closest('.alert').addClass('d-none')
    }); 
</script>

<script>
$(document).ready(function() {
    $('#form_pass').submit(function(e) {
        e.preventDefault();
        
        var password = $('#your-password').val();
        var confirmPassword = $('#confirm-password').val();
        
        if (password === '' || confirmPassword === '') {
            if (password === '') {
                $('#your-password').focus();
            } else {
                $('#confirm-password').focus();
            }
        } else if (password !== confirmPassword) {
            $('#pass_error').removeClass('d-none');
        } else {
            $('#pass_error').addClass('d-none');
            this.submit();
        }
    });
});
</script>

</body>
</html>

