<?php include_once("Render.php");
$render = new Render(0, false);
if ($feedbackInfo   = $render->getFeedbackInfo()) :
    $feedbackClass = strtolower($feedbackInfo['class']);
    $feedbackHead  = $feedbackInfo['head'];
    $feedbackBody  = $feedbackInfo['body'];
endif;

// print_r($feedbackBody);die;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from learnplus.demo.frontendmatter.com/guest-signup.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 13:24:33 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signup</title>

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

<body class="login">

    <div class="d-flex align-items-center" style="min-height: 100vh">
        <div class="col-sm-8 col-md-6 col-lg-4 mx-auto" style="min-width: 300px;">
            <div class="text-center mt-5 mb-1">
                <div class="avatar avatar-lg">
                    <img src="assets/images/logo/gnpc2.svg" class="avatar-img rounded-circle"
                        alt="GNPC Scholarship Portal" />
                </div>
            </div>
            <div class="d-flex justify-content-center mb-5 navbar-light">
                <a href="dashboard.php" class="navbar-brand m-0">GNPC Scholarship Portal</a>
            </div>
            <div class="card navbar-shadow">
                <div class="card-header text-center">
                    <h4 class="card-title">Sign Up</h4>
                    <p class="card-subtitle">Create a new account</p>
                </div>
                <div class="card-body">

                    <!-- <a href="dashboard.php"
                           class="btn btn-light btn-block">
                            <span class="fab fa-google mr-2"></span>
                            Continue with Google
                        </a>

                        <div class="page-separator">
                            <div class="page-separator__text">or</div>
                        </div> -->
                    <?php if (!empty($feedbackInfo))
                        echo ("<div class='alert alert-danger alert dismissible fade show' role='alert'>
                        <i class='fa fa-exclamation-triangle' aria-hidden='true'></i>
                        $feedbackBody
                        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>");
                    ?>
                    <form action="/gnpc/scripts/students/signup" novalidate method="POST" class="validator">
                        <div class="form-group">
                            <label class="form-label" for="firstname">First Name:</label>
                            <div class="input-group input-group-merge">
                                <input id="firstname" type="text" required="" name="firstName"
                                    class="form-control form-control-prepended validator" data-error="#firstname-error"
                                    placeholder="Your first name">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="far fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-danger m-2" id="firstname-error"></p>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="lastname">Last Name:</label>
                            <div class="input-group input-group-merge">
                                <input id="lastname" type="text" required="" name="lastName"
                                    class="form-control form-control-prepended validator" data-error="#lastname-error"
                                    placeholder="Your last name">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="far fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-danger m-2" id="lastname-error"></p>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email address:</label>
                            <div class="input-group input-group-merge">
                                <input id="email" type="email" required="" name="email"
                                    class="form-control form-control-prepended validator" data-type="email"
                                    data-error="#email-error" placeholder="Your email address">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="far fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-danger m-2" id="email-error"></p>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="contact">Contact:</label>
                            <div class="input-group input-group-merge">
                                <input id="contact" type="text" required="" name="contact"
                                    class="form-control form-control-prepended validator" data-error="#contact-error"
                                    placeholder="Your phone number">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="far fa-call"></span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-danger m-2" id="contact-error"></p>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password:</label>
                            <div class="input-group">
                                <input id="password" type="password" required="" name="pwd"
                                    class="form-control form-control-prepended validator" data-show="false"
                                    data-type="password" data-error="#password-error" placeholder="Choose a password">
                                <div class="input-group-append">
                                    <div class="input-group-text" role="obscure-input" data-target="#password">
                                        <span class="fa fa-eye"></span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-danger m-2" id="password-error"></p>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password2">Password:</label>
                            <div class="input-group">
                                <input id="password2" type="password" required="" name="confPwd"
                                    class="form-control form-control-prepended validator" data-target="#password"
                                    data-show="false" data-type="match" data-error="#password2-error"
                                    placeholder="Confirm password">
                                <div class="input-group-append">
                                    <div class="input-group-text" role="obscure-input" data-target="#password2">
                                        <span class="fa fa-eye"></span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-danger m-2" id="password2-error"></p>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mb-3">Sign Up</button>
                        <div class="form-group text-center mb-0">
                            <div class="custom-control custom-checkbox">
                                <input id="terms" type="checkbox" class="custom-control-input" checked required="">
                                <label for="terms" class="custom-control-label text-black-70">I agree to the <a href="#"
                                        class="text-black-70" style="text-decoration: underline;">Terms of
                                        Use</a></label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center text-black-50">Already signed up? <a href="index.php">Login</a>
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

    <script src="assets/js/index.js"></script>

</body>


<!-- Mirrored from learnplus.demo.frontendmatter.com/guest-signup.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 13:24:33 GMT -->

</html>