<?php include_once("Render.php");
$render = new Render();
if ($feedbackInfo   = $render->getFeedbackInfo()) :
    $feedbackClass = strtolower($feedbackInfo['class']);
    $feedbackHead  = $feedbackInfo['head'];
    $feedbackBody  = $feedbackInfo['body'];
    $feedbackIcon  = $feedbackInfo['icon'];
endif;
$status = $render->getStatus();
$fullName = $render->getUserAttribute('firstName') . " " . $render->getUserAttribute('lastName');
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

    <!-- Custom CSS -->
    <link type="text/css" href="assets/css/style.css" rel="stylesheet">

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
        <symbol id="circle-fill" fill="currentColor" stroke="currentColor" height="100" width="100" viewBox="0 0 16 16">
            <circle cx="50" cy="50" r="40" stroke-width="3" />
        </symbol>
    </svg>

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
                    <div class="row m-0">
                        <div class="col-lg container-fluid page__container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                            <?php
                            //if payment id is empty
                            if (empty($render->getUserAttribute('banks')) and $render->getUserAttribute('scholarshipStatus') == ACTIVE)
                                echo ("<div class='d-flex'>
                            <div class='alert alert-danger d-flex align-items-center flex-grow-1' role='alert'>
                                <span class='fas fa-exclamation-triangle fa-lg flex-shrink-0 me-2'></span>
                                <div class='mx-2 ms-2 flex-grow-1'>
                                   Please update your payment details from the 'Payment' tab on <a class=' btn btn-success flex-shrink-0 align-self-start mx-2' href='student-account-edit.php'>Edit Account</a>
                                   </div>
                                </div>
                            </div>");
                            ?>
                            <?php if (!empty($feedbackInfo))
                                echo ("<div class='alert alert-success alert dismissible fade show' role='alert'>
                            <i class='fa fa-check-circle' aria-hidden='true'></i>
                            $feedbackBody
                            <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>");
                            ?>

                            <!-- 
                            * ----------------------------------------------------------------------------------------------------
                            *
                            * Choose one of the following snippet (div) based on your response.
                            * 
                            *
                            *
                            *
                            *
                            *
                        --><?php
                            if ($render->getUserAttribute('scholarshipStatus') == EXPIRED)
                                echo ("<div class='d-flex'>
                                <div class='alert alert-primary d-flex align-items-center flex-grow-1' role='alert'>
                                    <span class='fas fa-info-circle fa-lg flex-shrink-0 me-2'></span>
                                    <div class='mx-2 ms-2 flex-grow-1'>
                                        Your scholarship has expired. Please renew your scholarship.
                                    </div>
                                </div>
                                <a class='btn btn-success flex-shrink-0 align-self-start mx-2' href='renewal.php'>Renew Scholarship</a>
                            </div>");
                            else if ($render->getUserAttribute('scholarshipStatus') == ACTIVE)
                                echo ("<div class='d-flex'>
                                <div class='alert alert-success d-flex align-items-center flex-grow-1' role='alert'>
                                    <span class='fas fa-check-circle fa-lg flex-shrink-0 me-2'></span>
                                    <div class='mx-2 ms-2 flex-grow-1'>
                                        Your are currnently a member of the scholarship program.
                                    </div>
                                </div>
                            </div>");
                            else if ($render->getUserAttribute('scholarshipStatus') == PENDING_RENEWAL)
                                echo ("<div class='d-flex'>
                                <div class='alert alert-success d-flex align-items-center flex-grow-1' role='alert'>
                                    <span class='fas fa-check-circle fa-lg flex-shrink-0 me-2'></span>
                                    <div class='mx-2 ms-2 flex-grow-1'>
                                        Your renewal request is under review...
                                    </div>
                                </div>
                            </div>");
                            else if ($render->getUserAttribute('scholarshipStatus') == UNDER_REVIEW)
                                echo ("<div class='d-flex'>
                                <div class='alert alert-warning d-flex align-items-center flex-grow-1' role='alert'>
                                    <span class='fas fa-circle-notch fa-lg flex-shrink-0 me-2'></span>
                                    <div class='mx-2 ms-2 flex-grow-1'>
                                        Your scholarship application is under review...
                                    </div>
                                </div>
                            </div>");
                            else if ($render->getUserAttribute('scholarshipStatus') == REGISTERED)
                                echo ("<div class=''>
                                    <div class='alert alert-danger d-flex align-items-center flex-grow-1' role='alert'>
                                        <span class='fas fa-exclamation-circle fa-lg flex-shrink-0 me-2'></span>
                                        <div class='mx-2 ms-2 flex-grow-1'>
                                            Not a scholar? Please apply
                                        </div>
                                    </div>
                                    <div class='d-flex'>
                                        <select class='form-control' id='custom-link-select'>
                                            <option value=''>-- Select Scholarship Type --</option>
                                            <option value='undergraduate'>Undergraduate</option>
                                            <option value='masters'>Masters</option>
                                            <option value='phd'>PhD</option>
                                        </select>
                                        <a class='btn btn-success flex-shrink-0 align-self-start mx-2' id='custom-link'>Apply Scholarship</a>
                                    </div>
                                    <p class='text-danger m-2' id='custom-link-error'></p>
                                </div>");
                            
                            else if ($render->getUserAttribute('scholarshipStatus') == SUSPENDED)
                                echo ("<div class='d-flex'>
                                <div class='alert alert-danger d-flex align-items-center flex-grow-1' role='alert'>
                                    <span class='fas fa-exclamation-circle fa-lg flex-shrink-0 me-2'></span>
                                    <div class='mx-2 ms-2 flex-grow-1'>
                                        You account or scholarship has been suspended. Please contact the adminstrator.
                                    </div>
                                </div>
                            </div>");

                            ?>

                            <!--
                            *
                            *
                            *
                            *
                            *
                            *----------------------------------------------------------------------------------------------------
                        -->

                            <h2 class="h2">Dashboard</h2>
                            <div class="card border-left-3 border-left-primary card-2by1">

                                <!-- 
                            * ----------------------------------------------------------------------------------------------------
                            *
                            * Choose one of the following snippet (div) based on your response.
                            * 
                            *
                            *
                            *
                            *
                            *
                        -->



                                <!--
                            *
                            *
                            *
                            *
                            *
                            *----------------------------------------------------------------------------------------------------
                        -->
                                <div class="card-body">
                                    <em style="font-size:.9rem">Welcome </em>
                                    <div class="mt-2 mt-xs-plus-0 text-center" style="font-size:1.5rem">
                                        <strong><?php echo $fullName; ?></strong>
                                    </div>
                                    <div style="font-size:1.2rem">

                                    </div>
                                </div>
                                <?php if (!empty($cohort = $render->getUserAttribute('cohort')))
                                    echo ("<div class='row mx-1'>
                                <div class='col-md-6'>
                                    <div class='card border-left-3 border-left-primary w-100 dashboard-card'>
                                        <div class='card-header'>
                                            <span class='dashboard-card-title'>Cohort</span>
                                        </div>
                                        <p class='text-center pt-3 dashboard-card-text'>$cohort</p>
                                    </div>
                                </div>"); ?>

                                <?php if (!empty($institution = $render->getUserAttribute('institution')))
                                    echo ("<div class='col-md-6'>
                                    <div class='card border-left-3 border-left-primary w-100 dashboard-card'>
                                        <div class='card-header'>
                                            <span class='dashboard-card-title'>Institution</span>
                                        </div>
                                        <p class='text-center pt-3 dashboard-card-text'>$institution</p>
                                    </div>
                                </div>
                            </div>"); ?>
                                <div class="card-header text-center">
                                    <span>YOUR SCHOLARSHIP STATUS: </span><span
                                        class="text-success"><?php echo $status; ?></span>
                                </div>
                            </div>


                            <div class="card">
                                <div class="list-group list-group-fit">
                                    <div class="col-sm-9">
                                        <div role="group" class="input-group input-group-merge form-control-prepended">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="page-nav" class="col-lg-auto page-nav">
                            <div data-perfect-scrollbar>
                                <div class="page-section pt-lg-32pt">
                                    <ul class="nav page-nav__menu">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link active">Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="student-account-edit.php" class="nav-link">Edit account</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="documents.php" class="nav-link">My Documents</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                                    <a href="student-account-edit-profile.html"
                                                       class="nav-link">Profile &amp; Privacy</a>
                                                </li> -->
                                    </ul>


                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="assets/js/app-settings.js"></script>

    <script>
    const link = document.getElementById("custom-link");
    const link_selector = document.getElementById("custom-link-select");
    const error_tag = document.getElementById("custom-link-error");

    link.addEventListener("change", (event) => {
        error_tag.innerHTML = "";
    })

    link.addEventListener("click", (event) => {
        if (link_selector.value != "") window.location = `${link_selector.value}.php`;
        else error_tag.innerHTML = "Please select your scholarship type.";
    })
    </script>

</body>


<!-- Mirrored from learnplus.demo.frontendmatter.com/student-account-edit-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 13:24:33 GMT -->

</html>