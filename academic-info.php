
<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    
<!-- Mirrored from learnplus.demo.frontendmatter.com/student-account-edit-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 13:24:33 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Academic Information</title>

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

            <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
        </div>

        <!-- Header Layout -->
        <?php include ("navbar.php") ?>

            <!-- // END Header -->

            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content">

                <div data-push
                     data-responsive-width="992px"
                     class="mdk-drawer-layout js-mdk-drawer-layout">
                    <div class="mdk-drawer-layout__content page ">

                        <div class="container-fluid page__container p-0">
                            <div class="row m-0">
                                <div class="col-lg container-fluid page__container">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                        <li class="breadcrumb-item active">Edit Account</li>
                                    </ol>
                                    <h1 class="h2">Academic Information</h1>
                                    <div class="card">
                                        <div class="list-group list-group-fit">
                                            <div class="list-group-item">
                                                <div class="form-group m-0"
                                                     role="group"
                                                     aria-labelledby="label-NOI">
                                                    <div class="form-row">
                                                        <label id="label-NOI"
                                                               for="NOI"
                                                               class="col-md-3 col-form-label form-label">Name of Institution</label>
                                                        <div class="col-md-9">
                                                        <select id="custom-select"
                                                    class="form-control custom-select">
                                                <option selected>University of Cape Coast</option>
                                                <option value="1">University of Ghana</option>
                                                <option value="2">Kwame Nkrumah University of Science and Technology</option>
                                                
                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0"
                                                     role="group"
                                                     aria-labelledby="label-POS">
                                                    <div class="form-row">
                                                        <label id="label-POS"
                                                               for="POS"
                                                               class="col-md-3 col-form-label form-label">Program of Study</label>
                                                        <div class="col-md-9">
                                                        <select id="custom-select"
                                                    class="form-control custom-select">
                                                <option selected>BSc. Computer Science</option>
                                                <option value="1">BSc. Mathematics</option>
                                                
                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0"
                                                     role="group"
                                                     aria-labelledby="label-StudentID">
                                                    <div class="form-row">
                                                        <label id="label-StudentID"
                                                               for="lastname"
                                                               class="col-md-3 col-form-label form-label">Student ID Number</label>
                                                        <div class="col-md-9">
                                                            <input id="StudentID"
                                                                   type="number"
                                                                   placeholder="StudentID"
                                                                   value="ps/csc/18/0000"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="list-group-item">
                                                <div class="form-group m-0"
                                                     role="group"
                                                     aria-labelledby="label-programType">
                                                    <div class="form-row">
                                                        <label id="label-programType"
                                                               for="programType"
                                                               class="col-md-3 col-form-label form-label">Program Type</label>
                                                        <div class="col-md-9">
                                                        <select id="custom-select"
                                                    class="form-control custom-select">
                                                <option selected>Degree</option>
                                                <option value="1">HND</option>
                                                <option value="2">Masters</option>
                                                <option value="3">PhD</option>
                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0"
                                                     role="group"
                                                     aria-labelledby="label-programStatus">
                                                    <div class="form-row">
                                                        <label id="label-programStatus"
                                                               for="programStatus"
                                                               class="col-md-3 col-form-label form-label">Program Status</label>
                                                        <div class="col-md-9">
                                                        <select id="custom-select"
                                                    class="form-control custom-select">
                                                <option selected>STEM</option>
                                                <option value="1">NON - STEM</option>
                                                
                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0"
                                                     role="group"
                                                     aria-labelledby="label-cohort">
                                                    <div class="form-row">
                                                        <label id="label-cohort"
                                                               for="cohort"
                                                               class="col-md-3 col-form-label form-label">Cohort</label>
                                                        <div class="col-md-9">
                                                            <input id="cohort"
                                                                   type="text"
                                                                   placeholder="cohort"
                                                                   value=""
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="list-group-item">
                                                <div class="form-group m-0"
                                                     role="group"
                                                     aria-labelledby="label-YOC">
                                                    <div class="form-row">
                                                        <label id="label-YOC"
                                                               for="YOC"
                                                               class="col-md-3 col-form-label form-label">Year of Completion</label>
                                                        <div class="col-md-9">
                                                            <input id="YOC"
                                                                   type="number"
                                                                   placeholder="2022"
                                                                   value="2022"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                           
                                        </div>
                                    </div>

                                    
                                </div>
                                <div id="page-nav"
                                     class="col-lg-auto page-nav">
                                    <div data-perfect-scrollbar>
                                        <div class="page-section pt-lg-32pt">
                                            <ul class="nav page-nav__menu">
                                                <li class="nav-item">
                                                    <a href="student-account-edit-basic.html"
                                                       class="nav-link active">Academic Information</a>
                                                </li>
                                                <!-- <li class="nav-item">
                                                    <a href="student-account-edit-profile.html"
                                                       class="nav-link">Profile &amp; Privacy</a>
                                                </li> -->
                                            </ul>
                                            <div class="page-nav__content">
                                                <button class="btn btn-success">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <?php include ("sidebar.php") ?>

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

    </body>


<!-- Mirrored from learnplus.demo.frontendmatter.com/student-account-edit-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 13:24:33 GMT -->
</html>