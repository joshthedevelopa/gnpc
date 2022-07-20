<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    
<!-- Mirrored from learnplus.demo.frontendmatter.com/student-dashboard.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 13:23:34 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Student - Dashboard</title>

         <meta name="robots"
              content="noindex">

        <!-- Custom Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Oswald:400,500,700%7CRoboto:400,500%7CRoboto:400,500&amp;display=swap"
              rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css"
              href="assets/vendor/perfect-scrollbar.css"
              rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css"
              href="assets/css/material-icons.css"
              rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css"
              href="assets/css/fontawesome.css"
              rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css"
              href="assets/vendor/spinkit.css"
              rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css"
              href="assets/css/app.css"
              rel="stylesheet">

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

         </div>



            <!-- // END Header -->
            <?php include ("navbar.php") ?>

            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content">

                <div data-push
                     data-responsive-width="992px"
                     class="mdk-drawer-layout js-mdk-drawer-layout">
                    <div class="mdk-drawer-layout__content page ">

                        <div class="container-fluid page__container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                            <h1 class="h2">Dashboard</h1>

                            <div class="card border-left-3 border-left-primary card-2by1">
                                <div class="card-body">
                                    <div class="media flex-wrap align-items-center">
                                        <div class="media-left">
                                            <i class="material-icons text-muted-light">credit_card</i>
                                        </div>
                                        <div class="media-body"
                                             style="min-width: 180px">
                                            Your subscription ends on <strong>25 February 2015</strong>
                                        </div>
                                        <div class="media-right mt-2 mt-xs-plus-0">
                                            <a class="btn btn-success"
                                               href="student-account-billing-upgrade.php">Upgrade</a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            
                            <div class="row">
                                <div class="col-lg-7">

                                    <div class="card">
                                        <div class="card-header d-flex align-items-center">
                                            <div class="h2 mb-0 mr-3 text-primary">116</div>
                                            <div class="flex">
                                                <h4 class="card-title">Angular</h4>
                                                <p class="card-subtitle">Best score</p>
                                            </div>
                                            
                                            <div class="dropdown">
                                                <a href="#"
                                                   class="dropdown-toggle text-black-70"
                                                   data-toggle="dropdown">Popular Topics</a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#"
                                                       class="dropdown-item">Popular Topics</a>
                                                    <a href="#"
                                                       class="dropdown-item">Web Design</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart"
                                                 style="height: 319px;">
                                                <canvas id="topicIqChart"
                                                        class="chart-canvas js-update-chart-line"
                                                        data-chart-hide-axes="false"
                                                        data-chart-points="true"
                                                        data-chart-suffix=" points"
                                                        data-chart-line-border-color="primary"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h4 class="card-title">Courses</h4>
                                                    <p class="card-subtitle">Your recent courses</p>
                                                </div>
                                                <div class="media-right">
                                                    <a class="btn btn-sm btn-primary"
                                                       href="student-my-courses.php">My courses</a>
                                                </div>
                                            </div>
                                        </div>

                                        <ul class="list-group list-group-fit mb-0"
                                            style="z-index: initial;">

                                            <li class="list-group-item"
                                                style="z-index: initial;">
                                                <div class="d-flex align-items-center">
                                                    <a href="student-take-course.php"
                                                       class="avatar avatar-4by3 avatar-sm mr-3">
                                                        <img src="assets/images/gulp.png"
                                                             alt="course"
                                                             class="avatar-img rounded">
                                                    </a>
                                                    <div class="flex">
                                                        <a href="student-take-course.php"
                                                           class="text-body"><strong>Learn Vue.js Fundamentals</strong></a>
                                                        <div class="d-flex align-items-center">
                                                            <div class="progress"
                                                                 style="width: 100px;">
                                                                <div class="progress-bar bg-primary"
                                                                     role="progressbar"
                                                                     style="width: 25%"
                                                                     aria-valuenow="25"
                                                                     aria-valuemin="0"
                                                                     aria-valuemax="100"></div>
                                                            </div>
                                                            <small class="text-muted ml-2">25%</small>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown ml-3">
                                                        <a href="#"
                                                           class="dropdown-toggle text-muted"
                                                           data-caret="false"
                                                           data-toggle="dropdown">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                               href="student-take-course.php">Continue</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-group-item"
                                                style="z-index: initial;">
                                                <div class="d-flex align-items-center">
                                                    <a href="student-take-course.php"
                                                       class="avatar avatar-4by3 avatar-sm mr-3">
                                                        <img src="assets/images/vuejs.png"
                                                             alt="course"
                                                             class="avatar-img rounded">
                                                    </a>
                                                    <div class="flex">
                                                        <a href="student-take-course.php"
                                                           class="text-body"><strong>Angular in Steps</strong></a>
                                                        <div class="d-flex align-items-center">
                                                            <div class="progress"
                                                                 style="width: 100px;">
                                                                <div class="progress-bar bg-success"
                                                                     role="progressbar"
                                                                     style="width: 100%"
                                                                     aria-valuenow="100"
                                                                     aria-valuemin="0"
                                                                     aria-valuemax="100"></div>
                                                            </div>
                                                            <small class="text-muted ml-2">100%</small>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown ml-3">
                                                        <a href="#"
                                                           class="dropdown-toggle text-muted"
                                                           data-caret="false"
                                                           data-toggle="dropdown">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                               href="student-take-course.php">Continue</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-group-item"
                                                style="z-index: initial;">
                                                <div class="d-flex align-items-center">
                                                    <a href="student-take-course.php"
                                                       class="avatar avatar-4by3 avatar-sm mr-3">
                                                        <img src="assets/images/nodejs.png"
                                                             alt="course"
                                                             class="avatar-img rounded">
                                                    </a>
                                                    <div class="flex">
                                                        <a href="student-take-course.php"
                                                           class="text-body"><strong>Bootstrap Foundations</strong></a>
                                                        <div class="d-flex align-items-center">
                                                            <div class="progress"
                                                                 style="width: 100px;">
                                                                <div class="progress-bar bg-warning"
                                                                     role="progressbar"
                                                                     style="width: 80%"
                                                                     aria-valuenow="80"
                                                                     aria-valuemin="0"
                                                                     aria-valuemax="100"></div>
                                                            </div>
                                                            <small class="text-muted ml-2">80%</small>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown ml-3">
                                                        <a href="#"
                                                           class="dropdown-toggle text-muted"
                                                           data-caret="false"
                                                           data-toggle="dropdown">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                               href="student-take-course.php">Continue</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h4 class="card-title">Quizzes</h4>
                                                    <p class="card-subtitle">Your Performance</p>
                                                </div>
                                                <div class="media-right">
                                                    <a class="btn btn-sm btn-primary"
                                                       href="#">Quiz results</a>
                                                </div>
                                            </div>
                                        </div>

                                        <ul class="list-group list-group-fit mb-0">

                                            <li class="list-group-item">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <a class="text-body"
                                                           href="student-quiz-results.php"><strong>Title of quiz goes here?</strong></a><br>
                                                        <div class="d-flex align-items-center">
                                                            <small class="text-black-50 text-uppercase mr-2">Course</small>
                                                            <a href="student-take-course.php">Basics of HTML</a>
                                                        </div>
                                                    </div>
                                                    <div class="media-right text-center d-flex align-items-center">
                                                        <span class="text-black-50 mr-3">Good</span>
                                                        <h4 class="mb-0">5.8</h4>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-group-item">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <a class="text-body"
                                                           href="student-quiz-results.php"><strong>Directives &amp; Routing</strong></a><br>
                                                        <div class="d-flex align-items-center">
                                                            <small class="text-black-50 text-uppercase mr-2">Course</small>
                                                            <a href="student-take-course.php">Angular in Steps</a>
                                                        </div>
                                                    </div>
                                                    <div class="media-right text-center d-flex align-items-center">
                                                        <span class="text-black-50 mr-3">Great</span>
                                                        <h4 class="mb-0 text-success">9.8</h4>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-group-item">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <a class="text-body"
                                                           href="student-quiz-results.php"><strong>Responsive &amp; Retina</strong></a><br>
                                                        <div class="d-flex align-items-center">
                                                            <small class="text-black-50 text-uppercase mr-2">Course</small>
                                                            <a href="student-take-course.php">Bootstrap Foundations</a>
                                                        </div>
                                                    </div>
                                                    <div class="media-right text-center d-flex align-items-center">
                                                        <span class="text-black-50 mr-3">Failed</span>
                                                        <h4 class="mb-0 text-danger">2.8</h4>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-5">

                                    <div class="card">
                                        <div class="card-header d-flex align-items-center">
                                            <div class="h2 mb-0 mr-3 text-primary">432</div>
                                            <div class="flex">
                                                <h4 class="card-title">Experience IQ</h4>
                                                <p class="card-subtitle">4 days streak this week</p>
                                            </div>
                                            <i class="material-icons text-muted ml-2">trending_up</i>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart"
                                                 style="height: 154px;">
                                                <canvas id="iqChart"
                                                        class="chart-canvas js-update-chart-line"
                                                        data-chart-points="true"
                                                        data-chart-suffix="pt"
                                                        data-chart-line-border-color="primary"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-2by1">
                                        <div class="card-header">
                                            <h4 class="card-title">Rewards</h4>
                                            <p class="card-subtitle">Your latest achievements</p>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="btn btn-primary btn-circle"><i class="material-icons">thumb_up</i></div>
                                            <div class="btn btn-danger btn-circle"><i class="material-icons">grade</i></div>
                                            <div class="btn btn-success btn-circle"><i class="material-icons">bubble_chart</i></div>
                                            <div class="btn btn-warning btn-circle"><i class="material-icons">keyboard_voice</i></div>
                                            <div class="btn btn-info btn-circle"><i class="material-icons">event_available</i></div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h4 class="card-title">Forum Activity</h4>
                                                    <p class="card-subtitle">Latest forum topics &amp; replies</p>
                                                </div>
                                                <div class="media-right">
                                                    <a class="btn btn-sm btn-primary"
                                                       href="student-forum.php"> <i class="material-icons">keyboard_arrow_right</i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <ul class="list-group list-group-fit">

                                            <li class="list-group-item forum-thread">
                                                <div class="media align-items-center">
                                                    <div class="media-left">
                                                        <div class="forum-icon-wrapper">
                                                            <a href="student-forum-thread.php"
                                                               class="forum-thread-icon">
                                                                <i class="material-icons">description</i>
                                                            </a>
                                                            <a href="student-profile.php"
                                                               class="forum-thread-user">
                                                                <img src="assets/images/people/50/guy-1.jpg"
                                                                     alt=""
                                                                     width="20"
                                                                     class="rounded-circle">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="d-flex align-items-center">
                                                            <a href="student-profile.php"
                                                               class="text-body"><strong>Luci Bryant</strong></a>
                                                            <small class="ml-auto text-muted">5 min ago</small>
                                                        </div>
                                                        <a class="text-black-70"
                                                           href="student-forum-thread.php">Am I learning the right way?</a>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-group-item forum-thread">
                                                <div class="media align-items-center">
                                                    <div class="media-left">
                                                        <div class="forum-icon-wrapper">
                                                            <a href="student-forum-thread.php"
                                                               class="forum-thread-icon">
                                                                <i class="material-icons">description</i>
                                                            </a>
                                                            <a href="student-profile.php"
                                                               class="forum-thread-user">
                                                                <img src="assets/images/people/50/guy-2.jpg"
                                                                     alt=""
                                                                     width="20"
                                                                     class="rounded-circle">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="d-flex align-items-center">
                                                            <a href="student-profile.php"
                                                               class="text-body"><strong>Magnus Goldsmith</strong></a>
                                                            <small class="ml-auto text-muted">7 min ago</small>
                                                        </div>
                                                        <a class="text-black-70"
                                                           href="student-forum-thread.php">Can someone help me with the basic Setup?</a>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-group-item forum-thread">
                                                <div class="media align-items-center">
                                                    <div class="media-left">
                                                        <div class="forum-icon-wrapper">
                                                            <a href="student-forum-thread.php"
                                                               class="forum-thread-icon">
                                                                <i class="material-icons">description</i>
                                                            </a>
                                                            <a href="student-profile.php"
                                                               class="forum-thread-user">
                                                                <img src="assets/images/people/50/woman-1.jpg"
                                                                     alt=""
                                                                     width="20"
                                                                     class="rounded-circle">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="d-flex align-items-center">
                                                            <a href="student-profile.php"
                                                               class="text-body"><strong>Katelyn Rankin</strong></a>
                                                            <small class="ml-auto text-muted">12 min ago</small>
                                                        </div>
                                                        <a class="text-black-70"
                                                           href="student-forum-thread.php">I think this is the right way?</a>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- sidebar -->
                    <?php include ("sidebar.php") ?>

                <!-- App Settings FAB -->
                <div id="app-settings">
                    <app-settings layout-active="default"
                                  :layout-location="{
      'fixed': 'fixed-student-dashboard.php',
      'default': 'student-dashboard.php'
    }"
                                  sidebar-variant="bg-transparent border-0"></app-settings>
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

        <!-- Global Settings -->
        <script src="assets/js/settings.js"></script>

        <!-- Moment.js -->
        <script src="assets/vendor/moment.min.js"></script>
        <script src="assets/vendor/moment-range.js"></script>

        <!-- Chart.js -->
        <script src="assets/vendor/Chart.min.js"></script>
        <script src="assets/js/chartjs.js"></script>

        <!-- Student Dashboard Page JS -->
        <!-- <script src="assets/js/chartjs-rounded-bar.js"></script> -->
        <script src="assets/js/page.student-dashboard.js"></script>

    </body>


<!-- Mirrored from learnplus.demo.frontendmatter.com/student-dashboard.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 13:24:04 GMT -->
</html>