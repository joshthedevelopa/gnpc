<?php include_once("Render.php");
$render = new Render();
if ($feedbackInfo   = $render->getFeedbackInfo()) :
    $feedbackClass = strtolower($feedbackInfo['class']);
    $feedbackHead  = $feedbackInfo['head'];
    $feedbackBody  = $feedbackInfo['body'];
    $feedbackIcon  = $feedbackInfo['icon'];
endif;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from learnplus.demo.frontendmatter.com/student-account-edit-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 13:24:33 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Basic Information</title>

    <meta name="robots" content="noindex">

    <!-- Custom Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Oswald:400,500,700%7CRoboto:400,500%7CRoboto:400,500&amp;display=swap"
        rel="stylesheet">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="assets/vendor/perfect-scrollbar.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="assets/css/material-icons.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="assets/css/fontawesome.css" rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="assets/vendor/spinkit.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="assets/css/app.css" rel="stylesheet">

</head>

<body class=" layout-fluid">

    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>

        <!-- <div class="sk-bounce">
    <div class="sk-bounce-dot"></div>
    <div class="sk-bounce-dot"></div>
  </div> -->

        <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
    </div>

    <!-- Header Layout -->
    <?php include("navbar.php") ?>

    <!-- // END Header -->

    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content">

        <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
            <div class="mdk-drawer-layout__content page ">

                <div class="container-fluid page__container p-0">
                    <form action="/scripts/students/password/" method="POST" id="updatePwd" class="validator">
                        <div class="row m-0">
                            <div class="col-lg container-fluid page__container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active">Password</li>
                                </ol>

                                <h4>Change Password</h4>
                                <?php if (!empty($feedbackInfo))
                                 echo ("<div class='alert alert-$feedbackClass alert dismissible fade show' role='alert'>
                                 <i class='fa fa-$feedbackIcon' aria-hidden='true'></i>
                                $feedbackBody
                                <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>");
                                ?>
                                <!-- <div class="alert alert-light border-1 border-left-3 border-left-primary d-flex">
                                    <i class="material-icons text-success mr-3">check_circle</i>
                                    <div class="text-body">An email with password reset instructions has been sent to
                                        your
                                        email address, if it exists on our system.</div>
                                </div> -->

                                <div class="card">
                                    <div class="list-group list-group-fit">
                                        <div class="list-group-item">
                                            <div class="form-group m-0" role="group" aria-labelledby="label-oldPwd">
                                                <div class="form-row">
                                                    <label id="label-oldPwd" for="oldPwd"
                                                        class="col-sm-3 col-form-label form-label">Old password:</label>
                                                    <div class="col-sm-9">
                                                        <div role="group"
                                                            class="input-group input-group-merge form-control-prepended">
                                                            <input id="oldPwd" type="password" name="oldPwd"
                                                                required="required" placeholder="Old password"
                                                                aria-required="true"
                                                                class="form-control form-control-prepended"
                                                                data-skip="true">
                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="form-group m-0" role="group" aria-labelledby="label-newPwd">
                                                <div class="form-row">
                                                    <label id="label-newPwd" for="newPwd"
                                                        class="col-sm-3 col-form-label form-label">New
                                                        password:</label>
                                                    <div class="col-sm-9">
                                                        <div role="group"
                                                            class="input-group">
                                                            <input id="newPwd" type="password" name="newPwd"
                                                                required="required" placeholder="New password"
                                                                aria-required="true"
                                                                class="form-control form-control-prepended" data-type="password" data-show="false">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text" role="obscure-input" data-target="#newPwd">
                                                                    <span class="fa fa-eye"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="form-group m-0" role="group" aria-labelledby="label-confNewPwd">
                                                <div class="form-row">
                                                    <label id="label-confNewPwd" for="confNewPwd"
                                                        class="col-sm-3 col-form-label form-label">Confirm new
                                                        password:</label>
                                                    <div class="col-sm-9">
                                                        <div role="group" class="input-group">
                                                            <input id="confNewPwd" type="password" name="confNewPwd"
                                                            required="required" placeholder="Confirm new password"
                                                            aria-required="true"
                                                            class="form-control form-control-prepended"
                                                            data-type="match" data-target="#newPwd" data-show="false">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text" role="obscure-input" data-target="#confNewPwd">
                                                                    <span class="fa fa-eye"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="page-nav" class="col-lg-auto page-nav">
                                <div data-perfect-scrollbar>
                                    <div class="page-section pt-lg-32pt">
                                        <div class="page-nav__content">
                                            <button type="submit" form="updatePwd" class="btn btn-success">Update
                                                Password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <?php include("sidebar.php") ?>

            <!-- App Settings FAB -->


        </div>
    </div>

    <!-- jQuery -->
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- MDK -->
    <script src="assets/vendor/dom-factory.js"></script>
    <script src="assets/vendor/material-design-kit.js"></script>

    <!-- App JS -->
    <script src="assets/js/app.js"></script>

    <!-- Highlight.js -->
    <script src="assets/js/hljs.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="assets/js/index.js"></script>

</body>


<!-- Mirrored from learnplus.demo.frontendmatter.com/student-account-edit-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 13:24:33 GMT -->

</html>