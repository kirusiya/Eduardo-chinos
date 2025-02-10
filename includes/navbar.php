<?php
$ob_n = new cTrons();
$result_n = $ob_n->obtenerDatosUsuario($_SESSION['cod_user']);
$user_data_side = mysqli_fetch_array($result_n);

// Verificar si se encontró el usuario
if(!isset($user_data_side['cod_user']) || $user_data_side['cod_user'] == "") {
    echo "<script>window.location.href = '".$website."/logout/';</script>";
}

// Extraer datos del usuario con operadores ternarios
$nom_user_side = isset($user_data_side['nom_user']) ? $user_data_side['nom_user'] : '';
$email_user_side = isset($user_data_side['email_user']) ? $user_data_side['email_user'] : '';
$user_name_side = isset($user_data_side['user_name']) ? $user_data_side['user_name'] : '';
$user_phone_side = isset($user_data_side['user_phone']) ? $user_data_side['user_phone'] : '';
$user_country_side = isset($user_data_side['user_country']) ? $user_data_side['user_country'] : '';
$user_pic_side = isset($user_data_side['user_pic']) ? $user_data_side['user_pic'] : '';


$nombre_sidebar = (!empty($nom_user_side) && $nom_user_side !== '') ? $nom_user_side : $user_name_side;
$avatar_sidebar = (!empty($user_pic_side) && $user_pic_side !== '') ? "avatar/".$user_pic_side : "logo-chatgpt.png";

?>


<div class="navbar-header">
    <div class="row align-items-center justify-content-between">
      <div class="col-auto">
        <div class="d-flex flex-wrap align-items-center gap-4">
          <button type="button" class="sidebar-toggle">
            <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
            <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
          </button>
          <button type="button" class="sidebar-mobile-toggle">
            <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
          </button>
          <form class="navbar-search">
            <input type="text" name="search" placeholder="Search">
            <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
          </form>
        </div>
      </div>
      <div class="col-auto">
        <div class="d-flex flex-wrap align-items-center gap-3">
          <button type="button" data-theme-toggle class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>
          <div class="dropdown d-none d-sm-inline-block">
            <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown">
              <img src="<?php echo $website;?>/assets/images/logo-lang.png" alt="image" class="w-24 h-24 object-fit-cover rounded-circle">
            </button>
            <div class="dropdown-menu to-top dropdown-menu-sm">
              <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                <div>
                  <h6 class="text-lg text-primary-light fw-semibold mb-0">Choose Your Language</h6>
                </div>
              </div>

              <div class="max-h-400-px overflow-y-auto scroll-sm pe-8">
                <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                  <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="english"> 
                    <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                      <img src="<?php echo $website;?>/assets/images/flags/flag1.png" alt="" class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                      <span class="text-md fw-semibold mb-0">English</span>
                    </span>
                  </label>
                  <input class="form-check-input" type="radio" name="crypto" id="english">
                </div>
    
                <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                  <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="japan"> 
                    <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                      <img src="<?php echo $website;?>/assets/images/flags/flag2.png" alt="" class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                      <span class="text-md fw-semibold mb-0">Japan</span>
                    </span>  
                  </label>
                  <input class="form-check-input" type="radio" name="crypto" id="japan">
                </div>
                
                <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                  <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="france"> 
                    <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                      <img src="<?php echo $website;?>/assets/images/flags/flag3.png" alt="" class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                      <span class="text-md fw-semibold mb-0">France</span>
                    </span>  
                  </label>
                  <input class="form-check-input" type="radio" name="crypto" id="france">
                </div>
                
                <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                  <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="germany"> 
                    <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                      <img src="<?php echo $website;?>/assets/images/flags/flag4.png" alt="" class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                      <span class="text-md fw-semibold mb-0">Germany</span>
                    </span>  
                  </label>
                  <input class="form-check-input" type="radio" name="crypto" id="germany">
                </div>
                
                <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                  <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="korea"> 
                    <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                      <img src="<?php echo $website;?>/assets/images/flags/flag5.png" alt="" class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                      <span class="text-md fw-semibold mb-0">South Korea</span>
                    </span>  
                  </label>
                  <input class="form-check-input" type="radio" name="crypto" id="korea">
                </div>
                
                <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                  <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="bangladesh"> 
                    <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                      <img src="<?php echo $website;?>/assets/images/flags/flag6.png" alt="" class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                      <span class="text-md fw-semibold mb-0">Bangladesh</span>
                    </span>  
                  </label>
                  <input class="form-check-input" type="radio" name="crypto" id="bangladesh">
                </div>
                
                <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                  <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="india"> 
                    <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                      <img src="<?php echo $website;?>/assets/images/flags/flag7.png" alt="" class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                      <span class="text-md fw-semibold mb-0">India</span>
                    </span>  
                  </label>
                  <input class="form-check-input" type="radio" name="crypto" id="india">
                </div>
                <div class="form-check style-check d-flex align-items-center justify-content-between">
                  <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="canada"> 
                    <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                      <img src="<?php echo $website;?>/assets/images/flags/flag8.png" alt="" class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                      <span class="text-md fw-semibold mb-0">Canada</span>
                    </span>  
                  </label>
                  <input class="form-check-input" type="radio" name="crypto" id="canada">
                </div>
              </div>
            </div>
          </div><!-- Language dropdown end -->

       <!-- JUST FOR A MOMENT-->
			
			<div class="dropdown">
    <button id="message-icon" class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown">
        <iconify-icon icon="mage:email" class="text-primary-light text-xl"></iconify-icon>
    </button>
    <div class="dropdown-menu to-top dropdown-menu-lg p-0">
        <div class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
            <div>
                <h6 class="text-lg text-primary-light fw-semibold mb-0">Message</h6>
            </div>
            <span class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center">05</span>
        </div>

        <div class="max-h-400-px overflow-y-auto scroll-sm pe-4" id="message-container">
        </div>

        <div class="text-center py-12 px-16">
            <a href="javascript:void(0)" class="text-primary-600 fw-semibold text-md">See All Messages</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('user_data.php')
        .then(response => response.json())
        .then(user => {
            let welcomeMessage = `Welcome back, ${user.nom_user}!`;
            let audio = new Audio("https://tronvaultest.online/sound/vault.mp3");
            audio.play();

            Swal.fire({
                html: `
                    <div class='d-flex align-items-center gap-3'>
                        <span class='w-40-px h-40-px rounded-circle flex-shrink-0'>
                            <img src='${user.user_pic}' alt='User Avatar' class='w-100 h-100 rounded-circle'>
                        </span>
                        <div>
                            <h6 class='text-md fw-semibold mb-2'>Support Team Tronvault</h6>
                            <p class='text-sm mb-0'>${welcomeMessage}</p>
                        </div>
                    </div>`,
                showConfirmButton: false,
                timer: 3000
            });

            let messageIcon = document.getElementById("message-icon");
            if (messageIcon) {
                messageIcon.classList.add("text-danger");
            }

            let messageContainer = document.getElementById("message-container");
            if (messageContainer) {
                let message = `
                    <a href='javascript:void(0)' class='px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between'>
                        <div class='text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3'> 
                            <span class='w-40-px h-40-px rounded-circle flex-shrink-0 position-relative'>
                                <img src='${user.user_pic}' alt=''>
                                <span class='w-8-px h-8-px bg-success-main rounded-circle position-absolute end-0 bottom-0'></span>
                            </span> 
                            <div>
                                <h6 class='text-md fw-semibold mb-4'>Support Team Tronvault</h6>
                                <p class='mb-0 text-sm text-secondary-light'>${welcomeMessage}</p>
                            </div>
                        </div>
                    </a>`;
                messageContainer.innerHTML += message;
            }
        });
    });

    document.getElementById("message-icon").addEventListener("click", function() {
        this.classList.remove("text-danger");
    });
</script>
			
			<!--<div class="dropdown">
            <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown">
              <iconify-icon icon="mage:email" class="text-primary-light text-xl"></iconify-icon>
            </button>
            <div class="dropdown-menu to-top dropdown-menu-lg p-0">
              <div class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                <div>
                  <h6 class="text-lg text-primary-light fw-semibold mb-0">Message</h6>
                </div>
                <span class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center">05</span>
              </div>
              
            <div class="max-h-400-px overflow-y-auto scroll-sm pe-4">
              
              <a href="javascript:void(0)" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                  <span class="w-40-px h-40-px rounded-circle flex-shrink-0 position-relative">
                    <img src="<?php echo $website;?>/assets/images/notification/profile-3.png" alt="">
                    <span class="w-8-px h-8-px bg-success-main rounded-circle position-absolute end-0 bottom-0"></span>
                  </span> 
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Kathryn Murphy</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-100-px">hey! there i’m...</p>
                  </div>
                </div>
                <div class="d-flex flex-column align-items-end"> 
                  <span class="text-sm text-secondary-light flex-shrink-0">12:30 PM</span>
                  <span class="mt-4 text-xs text-base w-16-px h-16-px d-flex justify-content-center align-items-center bg-warning-main rounded-circle">8</span>
                </div>
              </a>

              <a href="javascript:void(0)" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                  <span class="w-40-px h-40-px rounded-circle flex-shrink-0 position-relative">
                    <img src="<?php echo $website;?>/assets/images/notification/profile-4.png" alt="">
                    <span class="w-8-px h-8-px  bg-neutral-300 rounded-circle position-absolute end-0 bottom-0"></span>
                  </span> 
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Kathryn Murphy</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-100-px">hey! there i’m...</p>
                  </div>
                </div>
                <div class="d-flex flex-column align-items-end"> 
                  <span class="text-sm text-secondary-light flex-shrink-0">12:30 PM</span>
                  <span class="mt-4 text-xs text-base w-16-px h-16-px d-flex justify-content-center align-items-center bg-warning-main rounded-circle">2</span>
                </div>
              </a>

              <a href="javascript:void(0)" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between bg-neutral-50">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                  <span class="w-40-px h-40-px rounded-circle flex-shrink-0 position-relative">
                    <img src="<?php echo $website;?>/assets/images/notification/profile-5.png" alt="">
                    <span class="w-8-px h-8-px bg-success-main rounded-circle position-absolute end-0 bottom-0"></span>
                  </span> 
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Kathryn Murphy</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-100-px">hey! there i’m...</p>
                  </div>
                </div>
                <div class="d-flex flex-column align-items-end"> 
                  <span class="text-sm text-secondary-light flex-shrink-0">12:30 PM</span>
                  <span class="mt-4 text-xs text-base w-16-px h-16-px d-flex justify-content-center align-items-center bg-neutral-400 rounded-circle">0</span>
                </div>
              </a>

              <a href="javascript:void(0)" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between bg-neutral-50">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                  <span class="w-40-px h-40-px rounded-circle flex-shrink-0 position-relative">
                    <img src="<?php echo $website;?>/assets/images/notification/profile-6.png" alt="">
                    <span class="w-8-px h-8-px bg-neutral-300 rounded-circle position-absolute end-0 bottom-0"></span>
                  </span> 
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Kathryn Murphy</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-100-px">hey! there i’m...</p>
                  </div>
                </div>
                <div class="d-flex flex-column align-items-end"> 
                  <span class="text-sm text-secondary-light flex-shrink-0">12:30 PM</span>
                  <span class="mt-4 text-xs text-base w-16-px h-16-px d-flex justify-content-center align-items-center bg-neutral-400 rounded-circle">0</span>
                </div>
              </a>

              <a href="javascript:void(0)" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                  <span class="w-40-px h-40-px rounded-circle flex-shrink-0 position-relative">
                    <img src="<?php echo $website;?>/assets/images/notification/profile-7.png" alt="">
                    <span class="w-8-px h-8-px bg-success-main rounded-circle position-absolute end-0 bottom-0"></span>
                  </span> 
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Kathryn Murphy</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-100-px">hey! there i’m...</p>
                  </div>
                </div>
                <div class="d-flex flex-column align-items-end"> 
                  <span class="text-sm text-secondary-light flex-shrink-0">12:30 PM</span>
                  <span class="mt-4 text-xs text-base w-16-px h-16-px d-flex justify-content-center align-items-center bg-warning-main rounded-circle">8</span>
                </div>
              </a>

            </div>
              <div class="text-center py-12 px-16"> 
                  <a href="javascript:void(0)" class="text-primary-600 fw-semibold text-md">See All Message</a>
              </div>
            </div>
          </div>-->
			
			<!-- JUST FOR A MOMENT-->
			
			<!-- Message dropdown end -->

          <div class="dropdown">
            <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown">
              <iconify-icon icon="iconoir:bell" class="text-primary-light text-xl"></iconify-icon>
            </button>
            <div class="dropdown-menu to-top dropdown-menu-lg p-0">
              <div class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                <div>
                  <h6 class="text-lg text-primary-light fw-semibold mb-0">Notifications</h6>
                </div>
                <span class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center">05</span>
              </div>
              
            <div class="max-h-400-px overflow-y-auto scroll-sm pe-4">
              <a href="javascript:void(0)" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                  <span class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                    <iconify-icon icon="bitcoin-icons:verify-outline" class="icon text-xxl"></iconify-icon>
                  </span> 
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Congratulations</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-200-px">Your profile has been Verified. Your profile has been Verified</p>
                  </div>
                </div>
                <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
              </a>
              
              <a href="javascript:void(0)" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between bg-neutral-50">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                  <span class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                    <img src="<?php echo $website;?>/assets/images/notification/profile-1.png" alt="">
                  </span> 
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Ronald Richards</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-200-px">You can stitch between artboards</p>
                  </div>
                </div>
                <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
              </a>
              
              <a href="javascript:void(0)" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                  <span class="w-44-px h-44-px bg-info-subtle text-info-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                    AM
                  </span> 
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Arlene McCoy</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-200-px">Invite you to prototyping</p>
                  </div>
                </div>
                <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
              </a>

              <a href="javascript:void(0)" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between bg-neutral-50">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                  <span class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                    <img src="<?php echo $website;?>/assets/images/notification/profile-2.png" alt="">
                  </span> 
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Annette Black</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-200-px">Invite you to prototyping</p>
                  </div>
                </div>
                <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
              </a>

              <a href="javascript:void(0)" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"> 
                  <span class="w-44-px h-44-px bg-info-subtle text-info-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                    DR
                  </span> 
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Darlene Robertson</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-200-px">Invite you to prototyping</p>
                  </div>
                </div>
                <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
              </a>
            </div>

              <div class="text-center py-12 px-16"> 
                  <a href="javascript:void(0)" class="text-primary-600 fw-semibold text-md">See All Notification</a>
              </div>

            </div>
          </div><!-- Notification dropdown end -->

          

          <div class="dropdown">
            <button class="d-flex justify-content-center align-items-center rounded-circle" type="button" data-bs-toggle="dropdown">
              <img src="<?php echo $website;?>/assets/images/<?php echo $avatar_sidebar;?>" alt="image" class="w-40-px h-40-px object-fit-cover rounded-circle">
            </button>
            <div class="dropdown-menu to-top dropdown-menu-sm">
              <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                <div>
                  <h6 class="text-lg text-primary-light fw-semibold mb-2"><?php echo $nombre_sidebar;?></h6>
                  <span class="text-secondary-light fw-medium text-sm">User</span>
                </div>
                <button type="button" class="hover-text-danger">
                  <iconify-icon icon="radix-icons:cross-1" class="icon text-xl"></iconify-icon> 
                </button>
              </div>
              <ul class="to-top-list">
                <li>
                  <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" 
                  href="<?php echo $website;?>/profile/"> 
                  <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon>  My Profile</a>
                </li>
                <li>
                  <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="email.html"> 
                  <iconify-icon icon="tabler:message-check" class="icon text-xl"></iconify-icon>  Inbox</a>
                </li>
                <li>
                  <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="company.html"> 
                  <iconify-icon icon="icon-park-outline:setting-two" class="icon text-xl"></iconify-icon>  Setting</a>
                </li>
                <li>
                  <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3" href="<?php echo $website;?>/logout/"> 
                  <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon>  Log Out</a>
                </li>
              </ul>
            </div>
          </div><!-- Profile dropdown end -->
        </div>
      </div>
    </div>
</div> 