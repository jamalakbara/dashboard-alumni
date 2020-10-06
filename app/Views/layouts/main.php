<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app" />
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="/files/assets/images/favicon.ico" type="image/x-icon" />
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" />

    <!-- framework -->
    <link rel="stylesheet" type="text/css" href="/files/bower_components/bootstrap/css/bootstrap.min.css">

    <!-- waves.css -->
    <link rel="stylesheet" href="/files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">

    <!-- feather icon -->
    <link rel="stylesheet" type="text/css" href="/files/assets/icon/feather/css/feather.css">

    <!-- main style -->
    <link rel="stylesheet" type="text/css" href="/files/assets/css/style.css">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="/files/assets/css/widget.css">
    <link rel="stylesheet" href="/files/assets/css/custom.css">
</head>

<body>
    <!-- Required Jquery -->
    <script type="text/javascript" src="/files/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="/files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/files/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="/files/bower_components/bootstrap/js/bootstrap.min.js"></script>

    <!-- waves js -->
    <script src="/files/assets/pages/waves/js/waves.min.js"></script>

    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

    <!-- modernizr js -->
    <script type="text/javascript" src="/files/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="/files/bower_components/modernizr/js/css-scrollbars.js"></script>

    <!-- Custom js -->
    <script src="/files/assets/js/pcoded.min.js"></script>
    <script src="/files/assets/js/vertical/vertical-layout.min.js"></script>
    <script type="text/javascript" src="/files/assets/js/script.min.js"></script>
    <script src="/files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <!-- [ Pre-loader ] end -->

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <?= $this->include('layouts/navbar') ?>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <?= $this->include('layouts/sidebar') ?>
                    <div class="pcoded-content">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h4 class="m-b-10"><?= $title ?></h4>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="index.html">
                                                    <i class="feather icon-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="#!"><?= $title ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <!-- [ page content ] start -->
                                        <?= $this->renderSection('content') ?>
                                        <!-- [ page content ] end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ style Customizer ] start -->
                    <div id="styleSelector"></div>
                    <!-- [ style Customizer ] end -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>