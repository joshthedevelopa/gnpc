<?php include_once("Render.php");
$render = new Render(0, false);
$render->loggedIn();
if ($feedbackInfo   = $render->getFeedbackInfo()) :
    $feedbackClass = strtolower($feedbackInfo['class']);
    $feedbackHead  = $feedbackInfo['head'];
    $feedbackBody  = $feedbackInfo['body'];
    $feedbackIcon  = $feedbackInfo['icon'];
endif;

// print_r($feedbackBody);die;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- Mirrored from learnplus.demo.frontendmatter.com/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 13:24:20 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <meta name="robots" content="noindex">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500,700%7CRoboto:400,500%7CRoboto:400,500&amp;display=swap" rel="stylesheet">

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

<body class="login">

    <div class="d-flex align-items-center" style="min-height: 100vh">
        <div class="col-sm-8 col-md-6 col-lg-4 mx-auto" style="min-width: 300px;">
            <div class="text-center mt-5 mb-1">
                <div class="avatar avatar-lg">
                    <img src="assets/images/logo/gnpc2.svg" class="avatar-img rounded-circle" alt="GNPC Scholarship Portal" />
                </div>
            </div>
            <div class="d-flex justify-content-center mb-5 navbar-light">
                <a href="dashboard.php" class="navbar-brand m-0">GNPC Scholarship Portal</a>
            </div>
            <div class="card navbar-shadow">
                <div class="card-header text-center">
                    <h4 class="card-title">Login</h4>
                    <p class="card-subtitle">Access your account</p>
                </div>
                <div class="card-body">

                <?php if (!empty($feedbackInfo))
                    echo("<div class='alert alert-danger alert dismissible fade show' role='alert'>
                        <i class='fa fa-exclamation-triangle' aria-hidden='true'></i>
                        $feedbackBody
                        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>");
                    ?>
                    <form action="/scripts/students/login/" novalidate method="POST">
                        <div class="form-group">
                            <label class="form-label" for="email">email address or gnpc ref</label>
                            <div class="input-group input-group-merge">
                                <input id="email" type="text" required="" name="id" class="form-control form-control-prepended" placeholder="email address or gnpc ref">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Your password</label>
                            <div class="input-group input-group-merge">
                                <input id="password" type="password" required="" name="pwd" class="form-control form-control-prepended" placeholder="Your password">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fas fa-key"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <div class="text-center">
                            <a href="forgot-password.php" class="text-black-70" style="text-decoration: underline;">Forgot Password?</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center text-black-50">
                    Not yet a student? <a href="signup.php">Sign Up</a>
                </div>
            </div>
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
    <script src="assets/js/app-settings.js"></script>

</body>


<!-- Mirrored from learnplus.demo.frontendmatter.com/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 13:24:20 GMT -->

</html>