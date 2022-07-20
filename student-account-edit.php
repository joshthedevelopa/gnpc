<?php include_once("Render.php");
$render = new Render();

if ($feedbackInfo   = $render->getFeedbackInfo()) :
    $feedbackClass = strtolower($feedbackInfo['class']);
    $feedbackHead  = $feedbackInfo['head'];
    $feedbackBody  = $feedbackInfo['body'];
    $feedbackIcon  = $feedbackInfo['icon'];
endif;
$scholarshipStatus = $render->getUserAttribute('scholarshipStatus');
if ($scholarshipStatus == SUSPENDED)
    header("location: dashboard.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student - Edit account</title>

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

    <!-- Custom CSS -->
    <link type="text/css" href="assets/css/style.css" rel="stylesheet">

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

    <!-- Header Layout -->
    <?php include("navbar.php") ?>
    <!-- // END Header -->

    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content">

        <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
            <div class="mdk-drawer-layout__content page ">

                <div class="container-fluid page__container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Edit Account</li>
                    </ol>
                    <h1 class="h2">Edit Account</h1>
                    <?php if (!empty($feedbackInfo))
                                echo ("<div class='alert alert-$feedbackClass alert dismissible fade show' role='alert'>
                                 <i class='fa fa-$feedbackIcon' aria-hidden='true'></i>
                                $feedbackBody
                                <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>");
                            ?>
                    <div class="card">
                        <ul class="nav nav-tabs nav-tabs-card">
                            <li class="nav-item">
                                <a class="nav-link active" href="#first" data-toggle="tab">Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#second" data-toggle="tab">Academic</a>
                            </li>
                            <?php if (($render->getUserAttribute('scholarshipStatus') != REGISTERED) and ($render->getUserAttribute('scholarshipStatus') != UNDER_REVIEW))
                                echo ("<li class='nav-item'>
                                <a class='nav-link' href='#third' data-toggle='tab'>Payment</a>
                            </li>");
                            ?>
                        </ul>
                        <div class="tab-content card-body">
                            <div class="tab-pane active" id="first">
                                <form action="/scripts/students/basic/info/" id="basic"  method="POST" class="form-horizontal">
                                    <!-- <div class="form-group row">
                                        <label for="avatar" class="col-sm-3 col-form-label form-label">Avatar</label>
                                        <div class="col-sm-9">
                                            <div class="media align-items-center">
                                                <div class="media-left">
                                                    <div class="icon-block rounded">
                                                        <i class="material-icons text-muted-light md-36">photo</i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <div class="custom-file" style="width: auto;">
                                                        <input type="file" id="avatar" class="custom-file-input">
                                                        <label for="avatar" class="custom-file-label">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="card">
                                        <div class="list-group list-group-fit">
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-firstname">
                                                    <div class="form-row">
                                                        <label id="label-firstname" for="firstname" class="col-md-3 col-form-label form-label">First
                                                            name</label>
                                                        <div class="col-md-9">
                                                            <input id="firstname" disabled type="text" placeholder="Your first name" value="<?php echo $render->getUserAttribute('firstName'); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-lastname">
                                                    <div class="form-row">
                                                        <label id="label-lastname" for="lastname" class="col-md-3 col-form-label form-label">Last name</label>
                                                        <div class="col-md-9">
                                                            <input id="lastname" disabled type="text" placeholder="Your last name" value="<?php echo $render->getUserAttribute('lastName'); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-othername">
                                                    <div class="form-row">
                                                        <label id="label-other" for="othername" class="col-md-3 col-form-label form-label">Other name</label>
                                                        <div class="col-md-9">
                                                            <input id="othername" type="text" placeholder="" disabled value="<?php echo $render->getUserAttribute('otherName'); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-gender">
                                                    <div class="form-row">
                                                        <label id="label-gender" for="lastname" class="col-md-3 col-form-label form-label">Gender</label>
                                                        <div class="col-md-9">
                                                            <input id="gender" disabled type="text" placeholder="Gender" value="<?php echo $render->getUserAttribute('gender'); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-dob">
                                                    <div class="form-row">
                                                        <label id="label-dob" for="dob" class="col-md-3 col-form-label form-label">Date of
                                                            birth</label>
                                                        <div class="col-md-9">
                                                            <input id="dob" disabled type="date" placeholder="date of birth" value="<?php echo $render->getUserAttribute('birthDate'); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-region">
                                                    <div class="form-row">
                                                        <label id="label-region" for="region" class="col-md-3 col-form-label form-label">region</label>
                                                        <div class="col-md-9">
                                                            <input id="region" type="text" placeholder="Your region" disabled value="<?php echo $render->getUserAttribute('region'); ?>" class="form-control validator" data-error="#region-error">
                                                            <p class="text-danger m-2" id="region-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-phonenumber">
                                                    <div class="form-row">
                                                        <label id="label-phonenumber" for="phonenumber" class="col-md-3 col-form-label form-label">phone
                                                            number</label>
                                                        <div class="col-md-9">
                                                            <input id="phonenumber" name="contact" type="text" placeholder="Your phone number" value="<?php echo $render->getUserAttribute('contact'); ?>" class="form-control validator" data-error="#phonenumber-error">
                                                            <p class="text-danger m-2" id="phonenumber-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-email">
                                                    <div class="form-row">
                                                        <label id="label-email" for="email" class="col-md-3 col-form-label form-label">Email
                                                            </label>
                                                        <div class="col-md-9">
                                                            <input id="email" name="email" type="email" placeholder="Your email address" value="<?php echo $render->getUserAttribute('email'); ?>" class="form-control validator" data-type="email" data-error="#email-error">
                                                            <p class="text-danger m-2" id="email-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-emerContName">
                                                    <div class="form-row">
                                                        <label id="label-emerContName" for="emerContName" class="col-md-3 col-form-label form-label">Emergency Contact
                                                            Name</label>
                                                        <div class="col-md-9">
                                                            <input id="emerContName" name="emergencyName" type="text" placeholder="Emergency Contact Name" value="<?php echo $render->getUserAttribute('emergencyName'); ?>" class="form-control validator" data-error="emerContName-error">
                                                            <p class="text-danger m-2" id="emerContName-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-emergencycontact">
                                                    <div class="form-row">
                                                        <label id="label-emergencycontact" for="emergencycontact" class="col-md-3 col-form-label form-label">emergency
                                                            contact</label>
                                                        <div class="col-md-9">
                                                            <input id="emergencycontact" name="emergencyNo" type="text" placeholder="Your emergencycontact" value="<?php echo $render->getUserAttribute('emergencyNo'); ?>" class="form-control validator" data-error="#emergencycontact-error">
                                                            <p class="text-danger m-2" id="emergencycontact-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-relationshipType">
                                                    <div class="form-row">
                                                        <label id="label-relationshipType" for="relationshipType" class="col-md-3 col-form-label form-label">Relationship
                                                            Type</label>
                                                        <div class="col-md-9">
                                                            <input id="relationshipType" name="emergencyRelation" type="text" placeholder="" value="<?php echo $render->getUserAttribute('emergencyRelation'); ?>" class="form-control validator" data-error="#relationshipType-error">
                                                            <p class="text-danger m-2" id="relationshipType-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                            <div class="form-group m-0" role="group" aria-labelledby="label-physicallyChallenged">
                                                <div class="form-row">
                                                    <label id="label-physicallyChallenged" for="physically_challenged" class="col-md-3 col-form-label form-label">Physically
                                                        challenged</label>
                                                        <div class="col-md-9">
                                                            <input id="physically_challenged" type="text" disabled placeholder="" value="<?php echo $render->getUserAttribute('disability'); ?>" class="form-control validator" data-error="#physically_challenged-error">
                                                            <p class="text-danger m-2" id="physically_challenged-error"></p>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                       
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-8 offset-sm-3">
                                            <div class="media align-items-center">
                                                <div class="media-left">
                                                    <button form="basic" type="submit" class="btn btn-success">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="second">
                                <form action="" id="academic" method="POST" class="form-horizontal">
                                    <div class="card">
                                        <div class="list-group list-group-fit">
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-NOI">
                                                    <div class="form-row">
                                                        <label id="label-NOI" for="NOI" class="col-md-3 col-form-label form-label">Name of
                                                            Institution</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="" id="NOI" disabled value="<?php echo $render->getUserAttribute('institution'); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-POS">
                                                    <div class="form-row">
                                                        <label id="label-POS" for="POS" class="col-md-3 col-form-label form-label">Program of
                                                            Study</label>
                                                            <div class="col-md-9">
                                                            <input type="text" name="" id="POS" disabled value="<?php echo $render->getUserAttribute('program'); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-StudentID">
                                                    <div class="form-row">
                                                        <label id="label-StudentID" for="studentId" class="col-md-3 col-form-label form-label">Student ID
                                                            Number</label>
                                                            <div class="col-md-9">
                                                            <input type="text" name="" id="studentId" disabled value="<?php echo $render->getUserAttribute('studentId'); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-programType">
                                                    <div class="form-row">
                                                        <label id="label-programType" for="programType" class="col-md-3 col-form-label form-label">Program
                                                            Type</label>
                                                            <div class="col-md-9">
                                                            <input type="text" name="" id="programType" disabled value="<?php echo $render->getUserAttribute('programType'); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-programStatus">
                                                    <div class="form-row">
                                                        <label id="label-programStatus" for="programStatus" class="col-md-3 col-form-label form-label">Program
                                                            Status</label>
                                                            <div class="col-md-9">
                                                            <input type="text" name="" id="programStatus" disabled value="<?php echo $render->getUserAttribute('programStatus'); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-cohort">
                                                    <div class="form-row">
                                                        <label id="label-cohort" for="cohort" class="col-md-3 col-form-label form-label">Cohort</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="" id="cohort" disabled value="<?php echo $render->getUserAttribute('cohort'); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    


                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-4 offset-sm-3">
                                            <a href="#" class="btn btn-success tab-pane-btn" data-tab="#third"> Next page</a>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="tab-pane"  id="third">
                                <form action="/scripts/students/bank/info/" id="payment" method="POST" class="form-horizontal">
                                    <div class="card">
                                        <h5 class="h5 m-2">CBG Bank Details</h5>
                                        <div class="list-group list-group-fit">
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-cbgAcctName">
                                                    <div class="form-row">
                                                        <label id="label-cbgAcctName" for="cbgAcctName" class="col-md-3 col-form-label form-label">Bank Account
                                                            Name</label>
                                                        <div class="col-md-9">
                                                            <input id="cbgAcctName" name="cbgAccountName" type="text" placeholder="Your Bank Account Name" value="<?php echo $render->getUserAttribute('cbgAccountName'); ?>" class="form-control validator" data-error="#cbgAcctName-error">
                                                            <p class="text-danger m-2" id="cbgAcctName-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-cbgAcctNumber">
                                                    <div class="form-row">
                                                        <label id="label-cbgAcctNumber" for="cbgAcctNumber" class="col-md-3 col-form-label form-label">Bank Account
                                                            Number</label>
                                                        <div class="col-md-9">
                                                            <input id="cbgAcctNumber" type="text" name="cbgAccountNo" placeholder="Your Bank Account Number" value="<?php echo $render->getUserAttribute('cbgAccountNo'); ?>" class="form-control validator" data-error="#cbgAcctNumber-error" data-type="bank-number">
                                                            <p class="text-danger m-2" id="cbgAcctNumber-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-cbgBranch">
                                                    <div class="form-row">
                                                        <label id="label-cbgBranch" for="cbgBranch" class="col-md-3 col-form-label form-label">bank
                                                            branch</label>
                                                        <div class="col-md-9">
                                                            <input id="cbgBranch" type="text" name="cbgBranch" placeholder="bank Branch" value="<?php echo $render->getUserAttribute('cbgBranch'); ?>" class="form-control validator" data-error="#cbgBranch-error">
                                                            <p class="text-danger m-2" id="cbgBranch-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="h5 m-2">Republic Bank Details</h5>
                                        <div class="list-group list-group-fit">
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-rpbAcctName">
                                                    <div class="form-row">
                                                        <label id="label-rpbAcctName" for="rpbAcctName" class="col-md-3 col-form-label form-label">Bank Account
                                                            Name</label>
                                                        <div class="col-md-9">
                                                            <input id="rpbAcctName" type="text" name="rpbAccountName" placeholder="Your Bank Account Name" value="<?php echo $render->getUserAttribute('rpbAccountName'); ?>" class="form-control validator" data-error="#rpbAcctName-error">
                                                            <p class="text-danger m-2" id="rpbAcctName-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-rpbAcctNumber">
                                                    <div class="form-row">
                                                        <label id="label-rpbAcctNumber" for="rpbAcctNumber" class="col-md-3 col-form-label form-label">Bank Account
                                                            Number</label>
                                                        <div class="col-md-9">
                                                            <input id="rpbAcctNumber" name="rpbAccountNo" type="text" placeholder="Your Bank Account Number" data-type="bank-number" data-error="#rpbAcctNumber-error" value="<?php echo $render->getUserAttribute('rpbAccountNo'); ?>" class="form-control validator">
                                                            <p class="text-danger m-2" id="rpbAcctNumber-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-rpbBranch">
                                                    <div class="form-row">
                                                        <label id="label-rpbBranch" for="rpbBranch" class="col-md-3 col-form-label form-label">bank
                                                            branch</label>
                                                        <div class="col-md-9">
                                                            <input id="rpbBranch" name="rpbBranch" type="text" placeholder="bank Branch" value="<?php echo $render->getUserAttribute('rpbBranch'); ?>" class="form-control validator" data-error="#rpbBranch-error">
                                                            <p class="text-danger m-2" id="rpbBranch-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-4 offset-sm-3">
                                            <button form="payment" type="submit" class="btn btn-success">Save changes</button>
                                        </div>
                                    </div>
                                </form>

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

    <!-- Custom JS -->
    <script src="assets\js\index.js"></script>

    <!-- Highlight.js -->
    <script src="assets/js/hljs.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="assets/js/app-settings.js"></script>

</body>


</html>