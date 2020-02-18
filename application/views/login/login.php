<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Login Mecanica Tibagi - DoTinker </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo base_url()?>assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/style.css">
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    
                        <form class="md-float-material form-material"  method="post" accept-charset="utf-8" action="<?php echo base_url()?>login/entrar" id="login">
                            <div class="text-center">
                                <img src="<?php echo base_url()?>assets/images/logo.png" alt="logo.png">
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Acessar Painel</h3>
                                        </div>

                                        <fieldset>
                                            <?php if($error= $this->session->flashdata('message')): ?>
                                            <div class="col-md-12"> 
                                                <div class="alert alert-danger icons-alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <i class="icofont icofont-close-line-circled"></i>
                                                    </button>
                                                    <p><strong>Erro!</strong> <?= $error ?></p>
                                                </div>
                                            </div>

                                        <?php endif;  ?>

                                        </fieldset>


                                        <?php $this->session->flashdata('message'); ?>
                                    </div>
                                        <div class="form-group form-primary">
                                            <input type="text" name="email" id="email" class="form-control" required="" placeholder="Digite seu usuario">
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary">
                                            <input type="password" name="senha" id="senha" class="form-control" required="" placeholder="*********">
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="row m-t-25 text-left">
                                            <div class="col-12">
                                                <div class="checkbox-fade fade-in-primary d-">
                                                    <label>
                                                        <input type="checkbox" value="">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                        <span class="text-inverse">Lembrar-me</span>
                                                    </label>
                                                </div>
                                                <div class="forgot-phone text-right f-right">
                                                    <a href="auth-reset-password.htm" class="text-right f-w-600"> Esqueceu a senha?</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m-t-30">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Conectar</button>
                                            </div>
                                        </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <p class="text-inverse text-left m-b-0">Desenvolvido por</p>
                                            <p class="text-inverse text-left"><a href="index-1.htm"><b class="f-w-600">Matteo da Silva Carminato</b></a></p>
                                        </div>
                                        <div class="col-md-2">
                                            <img src="<?php echo base_url()?>assets/images/auth/Logo-small-bottom.png" alt="small-logo.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    
    <!-- Required Jquery -->
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/common-pages.js"></script>
</body>

</html>
