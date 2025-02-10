<?php
include('include/core.php');


// Obtener datos del usuario
$obc = new cTrons();
$result = $obc->obtenerDatosUsuario($_SESSION['cod_user']);
$user_data = mysqli_fetch_array($result);

// Verificar si se encontró el usuario
if(!isset($user_data['cod_user']) || $user_data['cod_user'] == "") {
    echo "<script>window.location.href = '".$website."/logout/';</script>";
}

$nom_user = isset($user_data['nom_user']) ? $user_data['nom_user'] : '';
$email_user = isset($user_data['email_user']) ? $user_data['email_user'] : '';
$user_name = isset($user_data['user_name']) ? $user_data['user_name'] : '';
$user_phone = isset($user_data['user_phone']) ? $user_data['user_phone'] : '';
$user_country = isset($user_data['user_country']) ? $user_data['user_country'] : '';
$user_pic = isset($user_data['user_pic']) ? $user_data['user_pic'] : '';



?>

<?php
$amount_usdt_neto = 0.00;
$amount_usdt = 0.00;
$ob_us = new cTrons();
$matriz_us = $ob_us->getUserCoinDataSaldo($_SESSION['cod_user']);
$fila_us = mysqli_fetch_array($matriz_us);

if(isset($fila_us['cod_coin']) && $fila_us['cod_coin']!==''){
    $amount_usdt_neto = $fila_us['amount_coin'];
    $amount_usdt = number_format($amount_usdt_neto, 2, '.', ',');

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

<style>
    .crypto-item {
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .crypto-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .positive {
    color: #16c784;
    }

    .negative {
    color: #ea3943;
    }

    .price-flash {
    animation: flash 0.5s ease-in-out;
    }

    @keyframes flash {
    0% {
        background-color: rgba(22, 199, 132, 0.1);
    }
    100% {
        background-color: transparent;
    }
    }


</style>


<body>


<?php include('./includes/aside.php'); ?>
<main class="dashboard-main">
    <?php include('./includes/navbar.php'); ?>

    <div class="dashboard-main-body">

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Dashboard</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
            <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Cryptocurrency</li>
        </ul>
        </div>
        
        <!-- Crypto Home Widgets Start -->
        <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">

            <div class="col">
                <div class="card shadow-none border bg-gradient-end-2">
                    <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <img src="<?php echo $website;?>/assets/images/currency/crypto-img6.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0">
                            <div class="flex-grow-1">
                                <h6 class="text-xl mb-1">Tether</h6>
                            <p class="fw-medium text-secondary-light mb-0">USDT</p>
                            </div>
                        </div>
                        <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                            <div class="">
                                <h6 class="mb-8 precioUSDTAni text-xl">$<?php echo $amount_usdt;?></h6>
                                <span class="animacionUsdt text-success-main text-md">+ 0.00%</span> 
                            </div>
                            <div id="usdtAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card shadow-none border bg-gradient-end-3">
                    <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <img src="<?php echo $website;?>/assets/images/currency/crypto-img1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0">
                            <div class="flex-grow-1">
                                <h6 class="text-xl mb-1">Bitcoin</h6>
                            <p class="fw-medium text-secondary-light mb-0">BTC</p>
                            </div>
                        </div>
                        <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                            <div class="">
                                <h6 class="mb-8 precioBTCAni text-xl">$9,400,670.40</h6>
                                <span class="animacionBTC text-success-main text-md">+ 0.00%</span> 
                            </div>
                            <div id="bitcoinAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ocultar otras cryptos
            <div class="col">
                <div class="card shadow-none border bg-gradient-end-1">
                    <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <img src="<?php echo $website;?>/assets/images/currency/crypto-img2.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0">
                            <div class="flex-grow-1">
                                <h6 class="text-xl mb-1">Ethereum </h6>
                            <p class="fw-medium text-secondary-light mb-0">ETH</p>
                            </div>
                        </div>
                        <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                            <div class="">
                                <h6 class="mb-8">$45,138</h6>
                                <span class="text-danger-main text-md">- 27%</span> 
                            </div>
                            <div id="ethereumAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card shadow-none border bg-gradient-end-5">
                    <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <img src="<?php echo $website;?>/assets/images/currency/crypto-img3.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0">
                            <div class="flex-grow-1">
                                <h6 class="text-xl mb-1">Solana</h6>
                            <p class="fw-medium text-secondary-light mb-0">SOL</p>
                            </div>
                        </div>
                        <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                            <div class="">
                                <h6 class="mb-8">$45,138</h6>
                                <span class="text-success-main text-md">+ 27%</span> 
                            </div>
                            <div id="solanaAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card shadow-none border bg-gradient-end-6">
                    <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <img src="<?php echo $website;?>/assets/images/currency/crypto-img4.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0">
                            <div class="flex-grow-1">
                                <h6 class="text-xl mb-1">Litecoin</h6>
                            <p class="fw-medium text-secondary-light mb-0">LTE</p>
                            </div>
                        </div>
                        <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                            <div class="">
                                <h6 class="mb-8">$45,138</h6>
                                <span class="text-success-main text-md">+ 27%</span> 
                            </div>
                            <div id="litecoinAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card shadow-none border bg-gradient-end-3">
                    <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <img src="<?php echo $website;?>/assets/images/currency/crypto-img5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0">
                            <div class="flex-grow-1">
                                <h6 class="text-xl mb-1">Dogecoin</h6>
                            <p class="fw-medium text-secondary-light mb-0">DOGE</p>
                            </div>
                        </div>
                        <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                            <div class="">
                                <h6 class="mb-8">$45,138</h6>
                                <span class="text-success-main text-md">+ 27%</span> 
                            </div>
                            <div id="dogecoinAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        </div>
                    </div>
                </div>
            </div>
            -->

        </div>
        <!-- Crypto Home Widgets End -->


        <div class="row gy-4 mt-4">

            <div class="col-xxl-12 col-lg-12">
                <div class="card h-100">
                    <div class="card-body p-24">
                        <span class="mb-4 text-sm text-secondary-light">Total Balance</span>
                        <h6 class="mb-4">
                            <?php 
                            $total_balance = $amount_usdt_neto + 9400670.40;
                            $total_balance = number_format($total_balance, 2, '.', ',');
                            ?>
                            $<?php echo $total_balance;?>
                        </h6>

                        <ul class="nav nav-pills pill-tab mb-24 mt-28 border input-form-light p-1 radius-8 bg-neutral-50" id="pills-tab-tran" role="tablist">
                            <li class="nav-item w-50" role="presentation">
                                <button class="nav-link px-12 py-10 text-md w-100 text-center radius-8 active" id="pills-enviar-tab" data-bs-toggle="pill" data-bs-target="#pills-enviar" type="button" role="tab" aria-controls="pills-enviar" aria-selected="true">Receive</button>
                            </li>
                            <li class="nav-item w-50" role="presentation">
                                <button class="nav-link px-12 py-10 text-md w-100 text-center radius-8" id="pills-recibir-tab" data-bs-toggle="pill" data-bs-target="#pills-recibir" type="button" role="tab" aria-controls="pills-recibir" aria-selected="false">Send</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-enviar" role="tabpanel" aria-labelledby="pills-enviar-tab" tabindex="0">
                                
                                <div class="mb-20 text-center">  

                                    <!-- Accordion Container -->
                                    <div class="accordion" id="cryptoAccordion">
                                        <!-- USDT Accordion Item -->
                                        
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUSDT" aria-expanded="false" aria-controls="collapseUSDT">
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?php echo $website;?>/assets/images/currency/crypto-img6.png" alt="USDT" class="me-3" style="width: 32px; height: 32px;">
                                                        <span class="fw-bold">Tether</span>
                                                        <span class="text-muted ms-2">USDT $<?php echo $amount_usdt?></span>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseUSDT" class="mt-20 accordion-collapse collapse" data-bs-parent="#cryptoAccordion">
                                                <div class="accordion-body">
                                                    <?php
                                                    $email_user;   
                                                    ?>

                                                    <image src=""
                                                        class="mb-20 w-240-px  text-center d-none" id="imageQR">


                                                    <div id="CopySuccess" class="alert alert-success bg-success-100 text-success-600 border-success-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between mb-20 max-w-440-px d-none" role="alert" style="margin: 0 auto;">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <iconify-icon icon="akar-icons:double-check" class="icon text-xl"></iconify-icon>
                                                            Data Copied Successfully! 
                                                        </div>
                                                        <button class="remove-button text-success-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                                                    </div>    

                                                    <div class="input-group">
                                                        <input type="mail" id="sendMail" name="sendMail" class="form-control" value="<?php echo $email_user;?>" placeholder="example@mail.com" style="pointer-events:none;" />
                                                        <button id="copyMail" type="button" class="input-group-text bg-base">
                                                            <iconify-icon icon="lucide:copy"></iconify-icon>   
                                                            Copy
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- BTC Accordion Item -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBTC" aria-expanded="false" aria-controls="collapseBTC">
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?php echo $website;?>/assets/images/currency/crypto-img1.png" alt="Ethereum" class="me-3" style="width: 32px; height: 32px;">
                                                        <span class="fw-bold">Bitcoin</span>
                                                        <span class="text-muted ms-2">BTC</span>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseBTC" class="mt-20 accordion-collapse collapse" data-bs-parent="#cryptoAccordion">
                                                <div class="accordion-body">
                                                    <p>Soon</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <!-- -->

                                    
                                </div>
                                
                                
                            </div>
                            <div class="tab-pane fade" id="pills-recibir" role="tabpanel" aria-labelledby="pills-recibir-tab" tabindex="0">

                                <div class="d-flex justify-content-end mb-3">
                                    <button id="btnScanQR" type="button" class="btn btn-dark p-0" style="width: 50px; height: 50px;">
                                        <iconify-icon icon="mdi:qrcode" width="50" height="50"></iconify-icon>
                                    </button>
                                </div>

                                <div class="mb-20">  
                                    <label for="estimatedValueSell" class="fw-semibold mb-8 text-primary-light">Enter the email to send</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-base">
                                            <iconify-icon icon="mynaui:envelope"></iconify-icon>
                                        </span>
                                        <input type="text" class="form-control flex-grow-1" name="mailToSend"  id="mailToSend" placeholder="example@gmail.com">
                                    </div>

                                </div>
                                <div class="mb-20">  
                                    <label for="tradeValueSell" class="fw-semibold mb-8 text-primary-light">Amount to Send</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-base">
                                            <iconify-icon icon="lucide:dollar-sign"></iconify-icon>
                                        </span>
                                        <input type="number" name="amountToSend"  id="amountToSend" class="form-control flex-grow-1" placeholder="100.00">
                                    </div>

                                </div>
                                
                                <div id="sucessSend" class="alert alert-success bg-success-100 text-success-600 border-success-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between mb-24  d-none" role="alert">
                                    <div class="d-flex align-items-center gap-2">
                                        <iconify-icon icon="akar-icons:double-check" class="icon text-xl"></iconify-icon>
                                        Transfer sent successfully!
                                    </div>
                                    <button class="remove-button text-success-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                                </div>

                                <div id="errorSend" class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between mb-24 d-none" role="alert">
                                    <div class="d-flex align-items-center gap-2  ">
                                        <iconify-icon icon="mdi:alert-circle-outline" class="icon text-xl"></iconify-icon>
                                        You do not have sufficient funds for this transaction
                                    </div>
                                    <button class="remove-button text-danger-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                                </div>

                                <div id="errorUserSend" class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between mb-24 d-none" role="alert">
                                    <div class="d-flex align-items-center gap-2  ">
                                        <iconify-icon icon="mdi:alert-circle-outline" class="icon text-xl"></iconify-icon>
                                        Invalid email, user not found!
                                    </div>
                                    <button class="remove-button text-danger-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                                </div>

                                <div id="errorSendError" class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between mb-24 d-none" role="alert">
                                    <div class="d-flex align-items-center gap-2  ">
                                        <iconify-icon icon="mdi:alert-circle-outline" class="icon text-xl"></iconify-icon>
                                        An error occurred during the transfer
                                    </div>
                                    <button class="remove-button text-danger-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                                </div>

                                
                                <input type="hidden" id="symbol_coin" name="symbol_coin" value="USDT">
                                <button id="btnSendUSDT" type="button" class="btn btn-primary text-sm btn-sm px-8 py-12 w-100 radius-8"> Transfer Now</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div><!-- fin row-->            

        <div class="row gy-4 mt-4">
            <div class="col-xxl-8">
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="card h-100 radius-8 border-0">
                            <div class="card-body p-24">
                                <h6 class="mb-4 fw-bold text-lg  mb-20">Coin Analytics</h6>
                                <div id="cryptoWidget" class="w-100">
                                    <!-- Los datos en tiempo real se insertarán aquí -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row gy-4 mt-4">

            <!-- Crypto Home Widgets Start -->
            <div class="col-xxl-8">
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="card h-100 radius-8 border-0">
                            <div class="card-body p-24">
                                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                    <h6 class="mb-2 fw-bold text-lg">Bitcoin Analytics</h6>
                                    
                                    <div class="d-flex flex-wrap align-items-center gap-4 d-none">
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input" type="radio" name="crypto" id="BTC">
                                            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="BTC"> BTC </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input" type="radio" name="crypto" id="ETH">
                                            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="ETH"> ETH </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input" type="radio" name="crypto" id="SOL">
                                            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="SOL"> SOL </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input" type="radio" name="crypto" id="LTE">
                                            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="LTE"> LTE </label>
                                        </div>
                                    </div>
                                    
                                </div>
            
                                <div class="d-flex align-items-center gap-2 mt-12 candleStickChartData">
                                    <h6 class="fw-semibold mb-0 title">$96,056.03</h6>
                                    <p class="text-sm mb-0 d-flex align-items-center gap-1">
                                        Bitcoin (BTC)
                                        <span id="porcentajeCSS" class="bg-success-focus border border-success px-8 py-2 rounded-pill fw-semibold text-success-main text-sm d-inline-flex align-items-center gap-1">
                                            <span id="porcentaje">10%</span>
                                            <iconify-icon icon="iconamoon:arrow-up-2-fill" class="icon"></iconify-icon>  
                                        </span> 
                                    </p>
                                </div>
            
                                <div id="candleStickChart"></div>
                            
                            </div>
                        </div>
                    </div>


                    <div class="col-xxl-6 d-none">
                        <div class="card h-100 radius-8 border-0">
                            <div class="card-body p-24">
                                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                    <h6 class="mb-2 fw-bold text-lg">Coin Analytics</h6>
                                    <div class="border radius-4 px-3 py-2 pe-0 d-flex align-items-center gap-1 text-sm text-secondary-light">
                                        Currency: 
                                        <select class="form-select form-select-sm w-auto bg-base border-0 text-primary-light fw-semibold text-sm">
                                            <option>USD</option>
                                            <option>BDT</option>
                                            <option>RUP</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                        <img src="<?php echo $website;?>/assets/images/currency/crypto-img1.png" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0">Bitcoin</h6>
                                        </div>
                                    </div>
                                    <h6 class="text-md fw-medium mb-0">$55,000.00</h6>
                                    <span class="text-success-main text-md fw-medium">+3.85%</span>
                                    <div id="markerBitcoinChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                </div>

                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                        <img src="<?php echo $website;?>/assets/images/currency/crypto-img2.png" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0">Ethereum</h6>
                                        </div>
                                    </div>
                                    <h6 class="text-md fw-medium mb-0">$55,000.00</h6>
                                    <span class="text-danger-main text-md fw-medium">-2.85%</span>
                                    <div id="markerEthereumChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                </div>

                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                        <img src="<?php echo $website;?>/assets/images/currency/crypto-img3.png" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0">Solana</h6>
                                        </div>
                                    </div>
                                    <h6 class="text-md fw-medium mb-0">$55,000.00</h6>
                                    <span class="text-success-main text-md fw-medium">+3.85%</span>
                                    <div id="markerSolanaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                </div>

                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                        <img src="<?php echo $website;?>/assets/images/currency/crypto-img4.png" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0">Litecoin</h6>
                                        </div>
                                    </div>
                                    <h6 class="text-md fw-medium mb-0">$55,000.00</h6>
                                    <span class="text-success-main text-md fw-medium">+3.85%</span>
                                    <div id="markerLitecoinChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                </div>

                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                        <img src="<?php echo $website;?>/assets/images/currency/crypto-img5.png" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0">Dogecoin</h6>
                                        </div>
                                    </div>
                                    <h6 class="text-md fw-medium mb-0">$15,000.00</h6>
                                    <span class="text-danger-main text-md fw-medium">-2.85%</span>
                                    <div id="markerDogecoinChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                </div>

                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-4 radius-4">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                        <img src="<?php echo $website;?>/assets/images/currency/crypto-img1.png" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0">Crypto</h6>
                                        </div>
                                    </div>
                                    <h6 class="text-md fw-medium mb-0">$15,000.00</h6>
                                    <span class="text-danger-main text-md fw-medium">-2.85%</span>
                                    <div id="markerCryptoChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-6 d-none">
                        <div class="card h-100 radius-8 border-0">
                        <div class="card-body p-24">
                                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                    <h6 class="mb-2 fw-bold text-lg">My Orders</h6>
                                    <div class="">
                                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                                            <option>Today</option>
                                            <option>Monthly</option>
                                            <option>Weekly</option>
                                            <option>Today</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="table-responsive scroll-sm">
                                    <table class="table bordered-table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Rate</th>
                                                <th scope="col">Amount ETH </th>
                                                <th scope="col">Price PLN</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td><span class="text-success-main">0.265415.00</span></td>
                                                <td>29.4251512</td>
                                                <td>2.154</td>
                                                <td class="text-center line-height-1"> 
                                                    <button type="button" class="text-lg text-danger-main remove-btn"><iconify-icon icon="radix-icons:cross-2" class="icon"></iconify-icon> </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-success-main">0.265415.00</span></td>
                                                <td>29.4251512</td>
                                                <td>2.154</td>
                                                <td class="text-center line-height-1"> 
                                                    <button type="button" class="text-lg text-danger-main remove-btn"><iconify-icon icon="radix-icons:cross-2" class="icon"></iconify-icon> </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-danger-main">0.265415.00</span></td>
                                                <td>29.4251512</td>
                                                <td>2.154</td>
                                                <td class="text-center line-height-1"> 
                                                    <button type="button" class="text-lg text-danger-main remove-btn"><iconify-icon icon="radix-icons:cross-2" class="icon"></iconify-icon> </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-success-main">0.265415.00</span></td>
                                                <td>29.4251512</td>
                                                <td>2.154</td>
                                                <td class="text-center line-height-1"> 
                                                    <button type="button" class="text-lg text-danger-main remove-btn"><iconify-icon icon="radix-icons:cross-2" class="icon"></iconify-icon> </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-danger-main">0.265415.00</span></td>
                                                <td>29.4251512</td>
                                                <td>2.154</td>
                                                <td class="text-center line-height-1"> 
                                                    <button type="button" class="text-lg text-danger-main remove-btn"><iconify-icon icon="radix-icons:cross-2" class="icon"></iconify-icon> </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-danger-main">0.265415.00</span></td>
                                                <td>29.4251512</td>
                                                <td>2.154</td>
                                                <td class="text-center line-height-1"> 
                                                    <button type="button" class="text-lg text-danger-main remove-btn"><iconify-icon icon="radix-icons:cross-2" class="icon"></iconify-icon> </button>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-12 d-none">
                        <div class="card h-100">
                            <div class="card-body p-24">
                                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                    <h6 class="mb-2 fw-bold text-lg mb-0">Recent Transaction</h6>
                                    <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                    View All
                                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                                    </a>
                                </div>
                                <div class="table-responsive scroll-sm">
                                    <table class="table bordered-table mb-0 xsm-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Ast</th>
                                                <th scope="col">Date & Time</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Address</th>
                                                <th scope="col" class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="text-success-main bg-success-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                            <iconify-icon icon="tabler:arrow-up-right" class="icon"></iconify-icon>
                                                        </span>
                                                        <span class="fw-medium">Bitcoin</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-primary-light d-block fw-medium">10:34 AM</span>
                                                    <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                                </td>
                                                <td>
                                                    <span class="text-primary-light d-block fw-medium">+ 0.431 BTC</span>
                                                    <span class="text-secondary-light text-sm">$3,480.90</span>
                                                </td>
                                                <td>Abc.........np562</td>
                                                <td class="text-center"> 
                                                    <span class="bg-success-focus text-success-main px-16 py-4 radius-4 fw-medium text-sm">Completed</span> 
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="text-danger-main bg-danger-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                            <iconify-icon icon="tabler:arrow-down-left" class="icon"></iconify-icon>
                                                        </span>
                                                        <span class="fw-medium">Bitcoin</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-primary-light d-block fw-medium">10:34 AM</span>
                                                    <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                                </td>
                                                <td>
                                                    <span class="text-primary-light d-block fw-medium">+ 0.431 BTC</span>
                                                    <span class="text-secondary-light text-sm">$3,480.90</span>
                                                </td>
                                                <td>Abc.........np562</td>
                                                <td class="text-center"> 
                                                    <span class="bg-danger-focus text-danger-main px-16 py-4 radius-4 fw-medium text-sm">Terminated</span> 
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="text-success-main bg-success-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                            <iconify-icon icon="tabler:arrow-up-right" class="icon"></iconify-icon>
                                                        </span>
                                                        <span class="fw-medium">Bitcoin</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-primary-light d-block fw-medium">10:34 AM</span>
                                                    <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                                </td>
                                                <td>
                                                    <span class="text-primary-light d-block fw-medium">+ 0.431 BTC</span>
                                                    <span class="text-secondary-light text-sm">$3,480.90</span>
                                                </td>
                                                <td>Abc.........np562</td>
                                                <td class="text-center"> 
                                                    <span class="bg-success-focus text-success-main px-16 py-4 radius-4 fw-medium text-sm">Completed</span> 
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="text-danger-main bg-danger-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                            <iconify-icon icon="tabler:arrow-down-left" class="icon"></iconify-icon>
                                                        </span>
                                                        <span class="fw-medium">Bitcoin</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-primary-light d-block fw-medium">10:34 AM</span>
                                                    <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                                </td>
                                                <td>
                                                    <span class="text-primary-light d-block fw-medium">+ 0.431 BTC</span>
                                                    <span class="text-secondary-light text-sm">$3,480.90</span>
                                                </td>
                                                <td>Abc.........np562</td>
                                                <td class="text-center"> 
                                                    <span class="bg-danger-focus text-danger-main px-16 py-4 radius-4 fw-medium text-sm">Terminated</span> 
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="text-success-main bg-success-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                            <iconify-icon icon="tabler:arrow-up-right" class="icon"></iconify-icon>
                                                        </span>
                                                        <span class="fw-medium">Bitcoin</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-primary-light d-block fw-medium">10:34 AM</span>
                                                    <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                                </td>
                                                <td>
                                                    <span class="text-primary-light d-block fw-medium">+ 0.431 BTC</span>
                                                    <span class="text-secondary-light text-sm">$3,480.90</span>
                                                </td>
                                                <td>Abc.........np562</td>
                                                <td class="text-center"> 
                                                    <span class="bg-success-focus text-success-main px-16 py-4 radius-4 fw-medium text-sm">Completed</span> 
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Crypto Home Widgets End -->

            <div class="col-xxl-4">
                <div class="row gy-4">
                    <div class="col-xxl-12 col-lg-6 d-none">
                        <div class="card h-100 radius-8 border-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                    <h6 class="mb-2 fw-bold text-lg">My Cards</h6>
                                    <a href="" class="btn btn-outline-primary d-inline-flex align-items-center gap-2 text-sm btn-sm px-8 py-6"> 
                                    <iconify-icon icon="ph:plus-circle" class="icon text-xl"></iconify-icon> Button
                                </a>
                                </div>
                                
                                <div>
                                    <div class="card-slider">
                                        <div class="p-20 h-240-px radius-8 overflow-hidden position-relative z-1">
                                            <img src="<?php echo $website;?>/assets/images/card/card-bg.png" alt="" class="position-absolute start-0 top-0 w-100 h-100 object-fit-cover z-n1">
            
                                            <div class="d-flex flex-column justify-content-between h-100">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                    <h6 class="text-white mb-0">Master Card</h6>
                                                    <img src="<?php echo $website;?>/assets/images/card/card-logo.png" alt="">
                                                </div>
                
                                                <div>
                                                    <span class="text-white text-xs fw-normal text-opacity-75">Credit Card Number</span>
                                                    <h6 class="text-white text-xl fw-semibold mt-1 mb-0">2356 9854 3652 5612</h6>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <span class="text-white text-xs fw-normal text-opacity-75">Name</span>
                                                        <h6 class="text-white text-xl fw-semibold mb-0">Arlene McCoy</h6>
                                                    </div>
                                                    <div>
                                                        <span class="text-white text-xs fw-normal text-opacity-75">Exp. Date</span>
                                                        <h6 class="text-white text-xl fw-semibold mb-0">05/26</h6>
                                                    </div>
            
                                                </div>
                                            </div>
            
                                        </div>
                                        <div class="p-20 h-240-px radius-8 overflow-hidden position-relative z-1">
                                            <img src="<?php echo $website;?>/assets/images/card/card-bg.png" alt="" class="position-absolute start-0 top-0 w-100 h-100 object-fit-cover z-n1">
            
                                            <div class="d-flex flex-column justify-content-between h-100">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                    <h6 class="text-white mb-0">Master Card</h6>
                                                    <img src="<?php echo $website;?>/assets/images/card/card-logo.png" alt="">
                                                </div>
                
                                                <div>
                                                    <span class="text-white text-xs fw-normal text-opacity-75">Credit Card Number</span>
                                                    <h6 class="text-white text-xl fw-semibold mt-1 mb-0">2356 9854 3652 5612</h6>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <span class="text-white text-xs fw-normal text-opacity-75">Name</span>
                                                        <h6 class="text-white text-xl fw-semibold mb-0">Arlene McCoy</h6>
                                                    </div>
                                                    <div>
                                                        <span class="text-white text-xs fw-normal text-opacity-75">Exp. Date</span>
                                                        <h6 class="text-white text-xl fw-semibold mb-0">05/26</h6>
                                                    </div>
            
                                                </div>
                                            </div>
            
                                        </div>
                                        <div class="p-20 h-240-px radius-8 overflow-hidden position-relative z-1">
                                            <img src="<?php echo $website;?>/assets/images/card/card-bg.png" alt="" class="position-absolute start-0 top-0 w-100 h-100 object-fit-cover z-n1">
            
                                            <div class="d-flex flex-column justify-content-between h-100">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                    <h6 class="text-white mb-0">Master Card</h6>
                                                    <img src="<?php echo $website;?>/assets/images/card/card-logo.png" alt="">
                                                </div>
                
                                                <div>
                                                    <span class="text-white text-xs fw-normal text-opacity-75">Credit Card Number</span>
                                                    <h6 class="text-white text-xl fw-semibold mt-1 mb-0">2356 9854 3652 5612</h6>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <span class="text-white text-xs fw-normal text-opacity-75">Name</span>
                                                        <h6 class="text-white text-xl fw-semibold mb-0">Arlene McCoy</h6>
                                                    </div>
                                                    <div>
                                                        <span class="text-white text-xs fw-normal text-opacity-75">Exp. Date</span>
                                                        <h6 class="text-white text-xl fw-semibold mb-0">05/26</h6>
                                                    </div>
            
                                                </div>
                                            </div>
            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-lg-6">
                        <div class="card h-100">
                            <div class="card-body p-24">
                                <span class="mb-4 text-sm text-secondary-light">Total Balance</span>
                                <h6 class="mb-4">$42,951,371.38</h6>

                                <ul class="nav nav-pills pill-tab mb-24 mt-28 border input-form-light p-1 radius-8 bg-neutral-50" id="pills-tab" role="tablist">
                                    <li class="nav-item w-50" role="presentation">
                                    <button class="nav-link px-12 py-10 text-md w-100 text-center radius-8 active" id="pills-Buy-tab" data-bs-toggle="pill" data-bs-target="#pills-Buy" type="button" role="tab" aria-controls="pills-Buy" aria-selected="true">Buy</button>
                                    </li>
                                    <li class="nav-item w-50" role="presentation">
                                    <button class="nav-link px-12 py-10 text-md w-100 text-center radius-8" id="pills-Sell-tab" data-bs-toggle="pill" data-bs-target="#pills-Sell" type="button" role="tab" aria-controls="pills-Sell" aria-selected="false">Sell</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-Buy" role="tabpanel" aria-labelledby="pills-Buy-tab" tabindex="0">
                                        <div class="mb-20">  
                                            <label for="estimatedValue" class="fw-semibold mb-8 text-primary-light">Estimated Purchase Value</label>
                                            <div class="input-group input-group-lg border input-form-light radius-8">
                                                <input type="text" class="form-control bg-base border-0 radius-8" id="estimatedValue" placeholder="Estimated Value">
                                                <div class="input-group-text bg-neutral-50 border-0 fw-normal text-md ps-1 pe-1">
                                                    <select class="form-select form-select-sm w-auto bg-transparent fw-bolder border-0 text-secondary-light">
                                                        <option class="bg-base">BTC</option>
                                                        <option class="bg-base">LTC</option>
                                                        <option class="bg-base">ETC</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-20">  
                                            <label for="tradeValue" class="fw-semibold mb-8 text-primary-light">Trade Value</label>
                                            <div class="input-group input-group-lg border input-form-light radius-8">
                                                <input type="text" class="form-control bg-base border-0 radius-8" id="tradeValue" placeholder="Trade Value">
                                                <div class="input-group-text bg-neutral-50 border-0 fw-normal text-md ps-1 pe-1">
                                                    <select class="form-select form-select-sm w-auto bg-transparent fw-bolder border-0 text-secondary-light">
                                                        <option class="bg-base">USD</option>
                                                        <option class="bg-base">BTC</option>
                                                        <option class="bg-base">LTC</option>
                                                        <option class="bg-base">ETC</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-20">  
                                            <label class="fw-semibold mb-8 text-primary-light">Trade Value</label>
                                            <textarea class="form-control bg-base h-80-px radius-8" placeholder="Enter Address"></textarea>
                                        </div>
                                        <div class="mb-24">  
                                            <span class="mb-4 text-sm text-secondary-light">Total Balance</span>
                                            <h6 class="mb-4 fw-semibold text-xl text-warning-main">$42,951,371.38</h6>
                                        </div>
                                        <a href="" class="btn btn-primary text-sm btn-sm px-8 py-12 w-100 radius-8"> Transfer Now</a>
                                    </div>
                                    <div class="tab-pane fade" id="pills-Sell" role="tabpanel" aria-labelledby="pills-Sell-tab" tabindex="0">
                                        <div class="mb-20">  
                                            <label for="estimatedValueSell" class="fw-semibold mb-8 text-primary-light">Estimated Purchase Value</label>
                                            <div class="input-group input-group-lg border input-form-light radius-8">
                                                <input type="text" class="form-control border-0 radius-8" id="estimatedValueSell" placeholder="Estimated Value">
                                                <div class="input-group-text bg-neutral-50 border-0 fw-normal text-md ps-1 pe-1">
                                                    <select class="form-select form-select-sm w-auto bg-transparent fw-bolder border-0 text-secondary-light">
                                                        <option>BTC</option>
                                                        <option>LTC</option>
                                                        <option>USD</option>
                                                        <option>ETC</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-20">  
                                            <label for="tradeValueSell" class="fw-semibold mb-8 text-primary-light">Trade Value</label>
                                            <div class="input-group input-group-lg border input-form-light radius-8">
                                                <input type="text" class="form-control border-0 radius-8" id="tradeValueSell" placeholder="Trade Value">
                                                <div class="input-group-text bg-neutral-50 border-0 fw-normal text-md ps-1 pe-1">
                                                    <select class="form-select form-select-sm w-auto bg-transparent fw-bolder border-0 text-secondary-light">
                                                        <option>BTC</option>
                                                        <option>LTC</option>
                                                        <option>USD</option>
                                                        <option>ETC</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-20">  
                                            <label class="fw-semibold mb-8">Trade Value</label>
                                            <textarea class="form-control h-80-px radius-8" placeholder="Enter Address"></textarea>
                                        </div>
                                        <div class="mb-24">  
                                            <span class="mb-4 text-sm text-secondary-light">Total Balance</span>
                                            <h6 class="mb-4 fw-semibold text-xl text-warning-main">$42,951,371.38</h6>
                                        </div>
                                        <a href="" class="btn btn-primary text-sm btn-sm px-8 py-12 w-100 radius-8"> Transfer Now</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-lg-6 d-none">
                        <div class="card h-100 radius-8 border-0">
                            <div class="card-body p-24">
                                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                    <h6 class="mb-2 fw-bold text-lg">User Activates</h6>
                                    <div class="">
                                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                                        <option>This Week</option>
                                        <option>This Month</option>
                                        <option>This Year</option>
                                    </select>
                                    </div>
                                </div>
            
                                <div class="position-relative">
                                    <span class="w-80-px h-80-px bg-base shadow text-primary-light fw-semibold text-xl d-flex justify-content-center align-items-center rounded-circle position-absolute end-0 top-0 z-1">+30%</span>
                                    <div id="statisticsDonutChart" class="mt-36 flex-grow-1 apexcharts-tooltip-z-none title-style circle-none"></div>
                                    <span class="w-80-px h-80-px bg-base shadow text-primary-light fw-semibold text-xl d-flex justify-content-center align-items-center rounded-circle position-absolute start-0 bottom-0 z-1">+25%</span>
                                </div>
                                
                                <ul class="d-flex flex-wrap align-items-center justify-content-between mt-3 gap-3">
                                    <li class="d-flex align-items-center gap-2">
                                        <span class="w-12-px h-12-px radius-2 bg-primary-600"></span>
                                        <span class="text-secondary-light text-sm fw-normal">Visits By Day:  
                                            <span class="text-primary-light fw-bold">20,000</span>
                                        </span>
                                    </li>
                                    <li class="d-flex align-items-center gap-2">
                                        <span class="w-12-px h-12-px radius-2 bg-yellow"></span>
                                        <span class="text-secondary-light text-sm fw-normal">Referral Join:  
                                            <span class="text-primary-light fw-bold">25,000</span>
                                        </span>
                                    </li>
                                </ul>
                        
                            </div>
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
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="<?php echo $website;?>/assets/js/homeFourChart.js"></script> 

<!-- First, include the qrcode.js library in your HTML file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>


<!-- Add this HTML for the scanner modal -->
<div id="scannerModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan QR Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <video id="qr-video" playsinline style="width: 100%; height: auto;"></video>
                <canvas id="qr-canvas" class="d-none"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jsqr@1.3.1/dist/jsQR.min.js"></script>
<script>
$(document).ready(function() {
    let scanning = false;
    let videoElement = document.getElementById('qr-video');
    let canvasElement = document.getElementById('qr-canvas');
    let canvas = canvasElement.getContext('2d');
    let scannerModal = new bootstrap.Modal(document.getElementById('scannerModal'));

    $('#btnScanQR').on('click', function() {
        if (scanning) {
            stopScanning();
        } else {
            startScanning();
        }
    });

    function startScanning() {
        scanning = true;
        scannerModal.show();
        navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
            .then(function(stream) {
                videoElement.srcObject = stream;
                videoElement.setAttribute("playsinline", true);
                videoElement.play();
                requestAnimationFrame(tick);
            })
            .catch(function(err) {
                console.error("Error accessing the camera", err);
                alert("Error accessing the camera. Please make sure you've granted permission.");
                scanning = false;
                scannerModal.hide();
            });
    }

    function stopScanning() {
        scanning = false;
        if (videoElement.srcObject) {
            videoElement.srcObject.getTracks().forEach(track => track.stop());
        }
        scannerModal.hide();
    }

    $('#scannerModal').on('hidden.bs.modal', function () {
        stopScanning();
    });

    function tick() {
        if (videoElement.readyState === videoElement.HAVE_ENOUGH_DATA) {
            canvasElement.height = videoElement.videoHeight;
            canvasElement.width = videoElement.videoWidth;
            canvas.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);
            var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
            var code = jsQR(imageData.data, imageData.width, imageData.height, {
                inversionAttempts: "dontInvert",
            });
            if (code) {
                if (isValidEmail(code.data)) {
                    $('#mailToSend').val(code.data);
                    stopScanning();
                }
            }
        }
        if (scanning) {
            requestAnimationFrame(tick);
        }
    }

    function isValidEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
});
</script>





<!-- Then, add this script after including jQuery and the qrcode.js library -->
<script>
$(document).ready(function() {
    // Function to generate QR code and update image
    function generateQRCode() {
        // Get the email from the PHP variable
        var email = "<?php echo $email_user; ?>";
        
        // Create a QR code
        var qr = new QRCode(document.createElement("div"), {
            text: email,
            width: 128,
            height: 128
        });
        
        // Get the data URL of the QR code
        var dataURL = qr._el.firstChild.toDataURL("image/png");
        
        // Set the src of the image to the QR code data URL
        $("#imageQR").attr("src", dataURL);
        
        // Remove the d-none class to show the image
        $("#imageQR").removeClass("d-none");
    }
    
    // Call the function when the page loads
    generateQRCode();
});
</script>

<script>
$(document).ready(function() {
    $("#copyMail").on("click", function() {
        // Get the input field
        var copyText = document.getElementById("sendMail");

        // Select the text in the input field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text to the clipboard
        document.execCommand("copy");

        // Optionally, you can provide some visual feedback
        $('#CopySuccess').removeClass("d-none");

        // Reset the button text and style after 2 seconds
        setTimeout(function() {
            $('#CopySuccess').addClass("d-none");
        }, 1500);
    });
});
</script>



<script>




/****************************************************** */


$(document).ready(() => {
  const cryptoData = {
    BTCUSDT: { name: "Bitcoin", symbol: "BTC", price: 0, prevPrice: 0, change: 0, chartData: [] },
    ETHUSDT: { name: "Ethereum", symbol: "ETH", price: 0, prevPrice: 0, change: 0, chartData: [] },
    SOLUSDT: { name: "Solana", symbol: "SOL", price: 0, prevPrice: 0, change: 0, chartData: [] },
    BNBUSDT: { name: "Binance", symbol: "BNB", price: 0, prevPrice: 0, change: 0, chartData: [] },
    USDCUSDT: { name: "Tether", symbol: "USDT", price: 0, prevPrice: 0, change: 0, chartData: [] },
  }

  const chartInstances = {
    BTCUSDT: null,
    ETHUSDT: null,
    USDCUSDT: null,
  }

  function initializeChart(chartId, chartColor, isUSDT = false) {
    const options = {
      series: [
        {
          name: "Price Change",
          data: [],
        },
      ],
      chart: {
        type: "area",
        width: 130,
        height: 50,
        sparkline: {
          enabled: true,
        },
        animations: {
          enabled: true,
          easing: "linear",
          dynamicAnimation: {
            speed: 500,
          },
        },
        toolbar: {
          show: false,
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        curve: "smooth",
        width: 2,
        colors: [chartColor],
        lineCap: "round",
      },
      grid: {
        show: false,
        padding: {
          top: -3,
          right: 0,
          bottom: 0,
          left: 0,
        },
      },
      fill: {
        type: "gradient",
        colors: [chartColor],
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: [`${chartColor}00`],
          inverseColors: false,
          opacityFrom: 0.7,
          opacityTo: 0.3,
          stops: [0, 100],
        },
      },
      markers: {
        colors: [chartColor],
        strokeWidth: 2,
        size: 0,
        hover: {
          size: 8,
        },
      },
      tooltip: {
        fixed: {
          enabled: true,
          position: "topRight",
          offsetX: 0,
          offsetY: -25,
        },
        x: {
          show: false,
        },
        y: {
          formatter: (value) => {
            if (isUSDT) {
              // Mostrar 8 decimales para USDT
              return (value / 1000000).toFixed(8) + "%"
            }
            return value + "%"
          },
        },
        marker: {
          show: false,
        },
      },
      xaxis: {
        labels: {
          show: false,
        },
        tooltip: {
          enabled: false,
        },
      },
      yaxis: {
        labels: {
          show: false,
        },
        decimalsInFloat: isUSDT ? 6 : 2,
      },
    }

    return new ApexCharts(document.querySelector(`#${chartId}`), options)
  }

  function updateChart(symbol, price, change) {
    console.log(`updateChart llamado para ${symbol}`, { price, change })
    const chartId = symbol === "BTCUSDT" ? "bitcoinAreaChart" : "usdtAreaChart"
    const chartColor = symbol === "BTCUSDT" ? "#F98C08" : "#2775CA"
    const isUSDT = symbol === "USDCUSDT"

    // Verificar si el elemento existe
    const chartElement = document.querySelector(`#${chartId}`)
    if (!chartElement) {
      console.log(`Elemento #${chartId} no encontrado`)
      return
    }

    if (!chartInstances[symbol]) {
      chartInstances[symbol] = initializeChart(chartId, chartColor, isUSDT)

      // Inicializar con datos aleatorios pequeños solo para USDT
      if (isUSDT) {
        // Generar 15 valores aleatorios pequeños entre 0.00001 y 0.00002
        cryptoData[symbol].chartData = Array(15)
          .fill(0)
          .map(() => Math.random() * 0.00001 + 0.00001)
      }

      chartInstances[symbol].render()
    }

    // Mantener solo los últimos 15 puntos de datos
    if (cryptoData[symbol].chartData.length >= 15) {
      cryptoData[symbol].chartData.shift()
    }

    // Procesar el cambio solo para USDT
    if (isUSDT) {
      // Usar el valor completo sin redondear
      let adjustedChange = change

      // Si el cambio es 0, usar un valor aleatorio pequeño
      if (adjustedChange === 0) {
        adjustedChange = Math.random() * 0.00001 + 0.00001
      }

      // Multiplicar por un factor mayor para hacer más visibles las variaciones pequeñas
      adjustedChange = adjustedChange * 1000000

      cryptoData[symbol].chartData.push(adjustedChange)
    } else {
      cryptoData[symbol].chartData.push(change)
    }

    // Actualizar el gráfico solo si la instancia existe
    if (chartInstances[symbol]) {
      chartInstances[symbol].updateSeries([
        {
          data: cryptoData[symbol].chartData,
        },
      ])
    }
  }

  const icons = {
    BTC: "https://cryptologos.cc/logos/bitcoin-btc-logo.png",
    ETH: "https://cryptologos.cc/logos/ethereum-eth-logo.png",
    SOL: "https://cryptologos.cc/logos/solana-sol-logo.png",
    BNB: "https://cryptologos.cc/logos/bnb-bnb-logo.png",
    USDT: "https://cryptologos.cc/logos/tether-usdt-logo.png",
  }

  // Conectar a WebSocket de Binance
  const ws = new WebSocket("wss://stream.binance.com:9443/ws")

  const subscribeMsg = {
    method: "SUBSCRIBE",
    params: ["btcusdt@ticker", "ethusdt@ticker", "solusdt@ticker", "bnbusdt@ticker", "usdcusdt@ticker"],
    id: 1,
  }

  ws.onopen = () => {
    console.log("WebSocket Connected")
    ws.send(JSON.stringify(subscribeMsg))
  }

  ws.onmessage = (event) => {
    const data = JSON.parse(event.data)
    if (data.s && cryptoData[data.s]) {
      updateCryptoData(data)
    }
  }

  function updateCryptoData(data) {
    const symbol = data.s
    const currentPrice = Number.parseFloat(data.c)
    const priceChange = Number.parseFloat(data.P)

    console.log(`Datos recibidos para ${symbol}:`, { currentPrice, priceChange })

    cryptoData[symbol].prevPrice = cryptoData[symbol].price
    cryptoData[symbol].price = currentPrice
    cryptoData[symbol].change = priceChange

    // Actualizar los elementos de animación y gráficos
    if (symbol === "BTCUSDT") {
      updateAnimatedPercentage(".animacionBTC", priceChange, currentPrice, ".precioBTCAni")
      updateChart(symbol, currentPrice, priceChange)
    } else if (symbol === "USDCUSDT") {
      console.log("Actualizando USDT")
      updateAnimatedPercentage(".animacionUsdt", priceChange, currentPrice, ".precioUSDTAni")
      updateChart(symbol, currentPrice, priceChange)
    }

    updateWidget()
  }

  function updateAnimatedPercentage(selector, percentage, currentPrice, priceSelector) {
    console.log(`updateAnimatedPercentage llamado para ${selector}`, { percentage, currentPrice })
    const $element = $(selector)
    const $priceElement = $(priceSelector)
    const symbol = selector === ".animacionBTC" ? "BTCUSDT" : "USDCUSDT"
    const prevPrice = cryptoData[symbol].prevPrice

    const changeSymbol = currentPrice > prevPrice ? "▲" : currentPrice < prevPrice ? "▼" : "▲"
    const formattedPercentage = `${changeSymbol} ${Math.abs(percentage).toFixed(2)}%`

    const classPercentage =
      currentPrice > prevPrice
        ? "text-success-main"
        : currentPrice < prevPrice
          ? "text-danger-main"
          : "text-success-main"

    const currentPriceCustom = formatPrice(currentPrice)

    // Actualizar el precio
    //$priceElement.text(`$${currentPriceCustom}`)

    // Animar el cambio
    $element.animate({ opacity: 1 }, 100, function () {
      $(this).removeClass("text-success-main text-danger-main")
      $(this).addClass(classPercentage).html(formattedPercentage).animate({ opacity: 1 }, 100)
    })
  }

  function formatPrice(price) {
    return price >= 1
      ? Number.parseFloat(price).toLocaleString("en-US", {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
        })
      : Number.parseFloat(price).toFixed(6)
  }

  function updateWidget() {
    let widgetHtml = '<div class="row g-3">'

    Object.entries(cryptoData).forEach(([pair, data]) => {

      if (data.symbol === "USDT") return;  

      const changeClass =
        data.price > data.prevPrice ? "positive" : data.price < data.prevPrice ? "negative" : "positive"
      const changeSymbol = data.price > data.prevPrice ? "▲" : data.price < data.prevPrice ? "▼" : "▲"
      const priceFlashClass = data.price > data.prevPrice ? "price-flash" : ""

      widgetHtml += `
          <div class="col-md-6">
            <div class="crypto-item d-flex align-items-center ${priceFlashClass} p-3 bg-light rounded">
              <div class="d-flex align-items-center">
                <img src="${icons[data.symbol]}" alt="${data.name}" class="crypto-icon me-2" style="width: 32px; height: 32px;">
                <div>
                  <div class="d-flex align-items-center">
                    <span class="fw-semibold">${data.name}</span>
                    <span class="text-muted ms-2">${data.symbol}</span>
                  </div>
                  <div class="mt-1">
                    <span class="fw-bold">$${formatPrice(data.price)}</span>
                    <span class="ms-2 ${changeClass}" style="font-size: 0.875rem;">
                      ${changeSymbol} ${Math.abs(data.change).toFixed(2)}%
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `
    })

    widgetHtml += "</div>"
    $("#cryptoWidget").html(widgetHtml)
  }

  ws.onerror = (error) => {
    console.error("WebSocket Error:", error)
  }

  ws.onclose = () => {
    console.log("WebSocket Closed. Reconnecting...")
    setTimeout(() => {
      window.location.reload()
    }, 5000)
  }

  let isFirstLoad = true
  const updateInterval = 1000 // 1 segundo

  function scheduledUpdate() {
    if (isFirstLoad) {
      isFirstLoad = false
      setTimeout(scheduledUpdate, updateInterval)
    } else {
      console.log("Ejecutando scheduledUpdate")
      updateWidget()
      updateChart("BTCUSDT", cryptoData["BTCUSDT"].price, cryptoData["BTCUSDT"].change)
      updateChart("USDCUSDT", cryptoData["USDCUSDT"].price, cryptoData["USDCUSDT"].change)
      setTimeout(scheduledUpdate, updateInterval)
    }
  }

  // Inicia el proceso de actualización programada
  scheduledUpdate()
})



</script>

<script>    
    $('.remove-button').on('click', function() {
        $(this).closest('.alert').addClass('d-none')
    }); 
</script>

<script>
$(document).ready(function() {
    $('#btnSendUSDT').on('click', function() {
        var mailToSend = $('#mailToSend').val();
        var amountToSend = $('#amountToSend').val();
        var symbol_coin = $('#symbol_coin').val();

        $.ajax({
            url: '<?php echo $website; ?>/ajax.php',
            type: 'POST',
            data: {
                action: 'transferUSDT',
                mailToSend: mailToSend,
                amountToSend: amountToSend,
                symbol_coin: symbol_coin
            },
            success: function(response) {
                $('#pills-recibir .alert').addClass('d-none');

                if (response.trim() === 'ok') {
                    $('#sucessSend').removeClass('d-none');

                    $('#mailToSend').val('');
                    $('#amountToSend').val('');
                    setTimeout(function() {
                        $('#sucessSend').addClass("d-none");
                    }, 2000);
                    
                } else if (response.trim() === 'insufficient_funds') {
                    $('#errorSend').removeClass('d-none');
                } else if (response.trim() === 'user_not_found') {
                    $('#errorUserSend').removeClass('d-none');
                } else {
                    $('#errorSendError').removeClass('d-none');
                }
            },
            error: function() {
                alert('An error occurred while processing your request');
            }
        });
    });

});
</script>
</body>
</html>

