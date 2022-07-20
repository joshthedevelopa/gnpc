<?php include_once("Render.php");
$render = new Render(REGISTERED);
if ($feedbackInfo   = $render->getFeedbackInfo()) :
    $feedbackClass = strtolower($feedbackInfo['class']);
    $feedbackHead  = $feedbackInfo['head'];
    $feedbackBody  = $feedbackInfo['body'];
    $feedbackIcon  = $feedbackInfo['icon'];
endif;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student - Undergraduate</title>

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
    <form action="/scripts/students/apply/" id="apply" method="post" enctype="multipart/form-data"
        class="form-horizontal validator">
        <div class="mdk-header-layout__content">

            <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">

                <div class="mdk-drawer-layout__content page ">

                    <div class="container-fluid page__container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Undergraduate Scholarship Application Form</li>
                        </ol>
                        <h1 class="h2">Undergraduate Scholarship Application Form</h1>


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
                                    <a class="nav-link active" href="#first" data-toggle="tab">Basic Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#second" data-toggle="tab">Academic Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#third" data-toggle="tab">Documents</a>
                                </li>
                            </ul>
                            <div class="tab-content card-body">
                                <div class="tab-pane active validator" id="first">
                                    <div class="form-group row">
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
                                                        <input type="file" id="avatar" class="custom-file-input"
                                                            data-skip="true">
                                                        <label for="avatar" class="custom-file-label">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="list-group list-group-fit">
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-firstname">
                                                    <div class="form-row">
                                                        <label id="label-firstname" for="firstname"
                                                            class="col-md-3 col-form-label form-label">First
                                                            name</label>
                                                        <div class="col-md-9">
                                                            <input id="firstname" disabled type="text"
                                                                placeholder="Your first name"
                                                                value="<?php echo $render->getUserAttribute('firstName'); ?>"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-lastname">
                                                    <div class="form-row">
                                                        <label id="label-lastname" for="lastname"
                                                            class="col-md-3 col-form-label form-label">Last name</label>
                                                        <div class="col-md-9">
                                                            <input id="lastname" disabled type="text"
                                                                placeholder="Your last name"
                                                                value="<?php echo $render->getUserAttribute('lastName'); ?>"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-othernames">
                                                    <div class="form-row">
                                                        <label id="label-othernames" for="othernames"
                                                            class="col-md-3 col-form-label form-label">Ohter
                                                            names</label>
                                                        <div class="col-md-9">
                                                            <input id="othernames" name="otherName" type="text"
                                                                placeholder="Your other names" value=""
                                                                class="form-control" data-skip="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-gender">
                                                    <div class="form-row">
                                                        <label id="label-gender" for="gender"
                                                            class="col-md-3 col-form-label form-label">Gender</label>
                                                        <div class="col-md-9">
                                                            <select id="custom-select" required name="gender"
                                                                class="form-control custom-select">
                                                                <option value="Male" selected>Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-dob">
                                                    <div class="form-row">
                                                        <label id="label-dob" for="dob"
                                                            class="col-md-3 col-form-label form-label">Date of
                                                            birth</label>
                                                        <div class="col-md-9">
                                                            <input id="dob" type="date" placeholder="date of birth"
                                                                required name="birthDate" value="" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-status">
                                                    <div class="form-row">
                                                        <label id="label-status" for="status"
                                                            class="col-md-3 col-form-label form-label">Marital
                                                            Status</label>
                                                        <div class="col-md-9">
                                                            <select id="custom-select" required name="maritalStatus"
                                                                class="form-control custom-select">

                                                                <option value="1" selected>Single</option>
                                                                <option value="2">Married</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-region">
                                                    <div class="form-row">
                                                        <label id="label-region" for="region"
                                                            class="col-md-3 col-form-label form-label">Region</label>
                                                        <div class="col-md-9">
                                                            <select id="custom-select" required name="region"
                                                                class="form-control custom-select">
                                                                <option value="1">Ashanti Region</option>
                                                                <option value="2">Ahafo Region</option>
                                                                <option value="3">Bono Region</option>
                                                                <option value="4">Bono East Region</option>
                                                                <option value="5">Central Region</option>
                                                                <option value="6">Eastern Region</option>
                                                                <option value="7">Northern Region</option>
                                                                <option value="8">North East Region</option>
                                                                <option value="9">Oti Region</option>
                                                                <option value="10">Savannah Region</option>
                                                                <option value="11">Upper East Region</option>
                                                                <option value="12">Upper West Region</option>
                                                                <option value="13">Volta Region</option>
                                                                <option value="14">Western Region</option>
                                                                <option value="15">Western North Region</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" value="UNDERGRADUATE" name="levelOfStudy">
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-district">
                                                    <div class="form-row">
                                                        <label id="label-district" for="district"
                                                            class="col-md-3 col-form-label form-label">District</label>
                                                        <div class="col-md-9">
                                                            <select id="custom-select" required name="district"
                                                                class="form-control custom-select">
                                                                <option selected value="Abura">Abura district</option>
                                                                <option value="Elmina">Elmina district</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-phonenumber">
                                                    <div class="form-row">
                                                        <label id="label-phonenumber" for="phonenumber"
                                                            class="col-md-3 col-form-label form-label">phone
                                                            number</label>
                                                        <div class="col-md-9">
                                                            <input id="phonenumber" required type="text" name="contact"
                                                                placeholder="Your phone number"
                                                                value="+<?php echo $render->getUserAttribute('contact'); ?>"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-email">
                                                    <div class="form-row">
                                                        <label id="label-email" for="email"
                                                            class="col-md-3 col-form-label form-label">Your email
                                                            address</label>
                                                        <div class="col-md-9">
                                                            <div role="group" class="input-group input-group-merge">
                                                                <input id="email" required type="email" name="email"
                                                                    placeholder="Your email address"
                                                                    value="<?php echo $render->getUserAttribute('email'); ?>"
                                                                    class="form-control">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i class="material-icons">email</i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <small class="form-text text-muted">Note that if you
                                                                change your email, you will have to confirm it
                                                                again.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-emergencycontact">
                                                    <div class="form-row">
                                                        <label id="label-emergencycontact" for="emergencycontact"
                                                            class="col-md-3 col-form-label form-label">emergency
                                                            contact</label>
                                                        <div class="col-md-9">
                                                            <input id="emergencycontact" required type="text"
                                                                name="emergencyNo" placeholder="Your emergencycontact"
                                                                value="+233234567891" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-emerContName">
                                                    <div class="form-row">
                                                        <label id="label-emerContName" for="emerContName"
                                                            class="col-md-3 col-form-label form-label">Emergency Contact
                                                            Name</label>
                                                        <div class="col-md-9">
                                                            <input id="emerContName" required type="text"
                                                                name="emergencyName"
                                                                placeholder="Emergency Contact Name" value=""
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-relationshipType">
                                                    <div class="form-row">
                                                        <label id="label-relationshipType" for="relationshipType"
                                                            class="col-md-3 col-form-label form-label">Relationship
                                                            Type</label>
                                                        <div class="col-md-9">
                                                            <select id="custom-select" required name="emergencyRelation"
                                                                class="form-control custom-select">
                                                                <option selected>parent</option>
                                                                <option value="sibling">sibling</option>
                                                                <option value="others">others</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-physicallyChallenged">
                                                    <div class="form-row">
                                                        <label id="label-physicallyChallenged"
                                                            for="physically_challenged"
                                                            class="col-md-3 col-form-label form-label">Physically
                                                            challenged</label>
                                                        <div class="col-md-9">
                                                            <div role="group" class="input-group input-group-merge">
                                                                <select id="custom-select"
                                                                    class="form-control custom-select toggle-trigger"
                                                                    data-group="target-example#2">
                                                                    <option value="0" selected>No</option>
                                                                    <option value="1">Yes</option>


                                                                </select>
                                                                <!-- <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <i class="material-icons">email</i>
                                                                        </div>
                                                                    </div> -->
                                                            </div>
                                                            <small class="form-text text-muted">If Yes, Specify</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item toggle-target target-example#2" data-lookup="1">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-specify">
                                                    <div class="form-row">
                                                        <label id="label-specify" for="specify"
                                                            class="col-md-3 col-form-label form-label">specify</label>
                                                        <div class="col-md-9">
                                                            <input id="specify" type="text" placeholder="paralyzed"
                                                                name="disability" value="" class="form-control"
                                                                data-skip="true">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="list-group-item toggle-target  target-example#2"
                                                data-lookup="1">

                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-specify">
                                                    <div class="form-row">
                                                        <label for="medReport"
                                                            class="col-md-3 col-form-label form-label">Medical
                                                            Report</label>
                                                        <div class="col-md-9">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <div class="custom-input" style="width: auto;">
                                                                        <label for="medReport"
                                                                            class="custom-file-label">Choose
                                                                            file</label>
                                                                        <input type="file" id="medReport"
                                                                            name="medicalReport"
                                                                            class="form-control custom-file-input"
                                                                            data-skip="true">
                                                                    </div>
                                                                </div>
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
                                                        <a href="#" class="btn btn-success tab-pane-btn"
                                                            data-tab="#second"> Save and
                                                            continue</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane validator" id="second">
                                    <div class="card">
                                        <div class="list-group list-group-fit">
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-NOI">
                                                    <div class="form-row">
                                                        <label id="label-NOI" for="NOI"
                                                            class="col-md-3 col-form-label form-label">Name of
                                                            Institution</label>
                                                        <div class="col-md-9">
                                                            <select id="custom-select" name="institution" required
                                                                class="form-control custom-select">
                                                                <option value="1" selected>University of Cape Coast
                                                                </option>
                                                                <option value="2">University of Ghana</option>
                                                                <option value="2">Kwame Nkrumah University of Science
                                                                    and
                                                                    Technology</option>
                                                                <option value="3"> University for Development Studies
                                                                </option>
                                                                <option value="4"> University of Mines and Technology
                                                                </option>
                                                                <option value="5"> koforidua Technical University
                                                                </option>
                                                                <option value="6"> Cape Coast Technical University
                                                                </option>
                                                                <option value="7"> Sunyani Technical University</option>
                                                                <option value="8"> Takoradi Technical University
                                                                </option>
                                                                <option value="9"> Tamale Technical University</option>
                                                                <option value="10"> Ho Technical University</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-POS">
                                                    <div class="form-row">
                                                        <label id="label-POS" for="POS"
                                                            class="col-md-3 col-form-label form-label">Program of
                                                            Study</label>
                                                        <div class="col-md-9">
                                                            <select id="custom-select" required name="program"
                                                                class="form-control custom-select">
                                                                <option selected>BSc. Computer Science</option>
                                                                <option value="Bsc. Mathematics">BSc. Mathematics
                                                                </option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-cgpa">
                                                    <div class="form-row">
                                                        <label id="label-cgpa" for="cgpa"
                                                            class="col-md-3 col-form-label form-label">Current
                                                            CGPA/CWA</label>
                                                        <div class="col-md-9">
                                                            <input name="cgpaCwa" required id="cgpa" type="text"
                                                                name="cgpa" placeholder="Enter Your current CGPA/CWA"
                                                                value="" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-StudentID">
                                                    <div class="form-row">
                                                        <label id="label-StudentID" for="lastname"
                                                            class="col-md-3 col-form-label form-label">Student ID
                                                            Number</label>
                                                        <div class="col-md-9">
                                                            <input id="StudentID" required type="text"
                                                                placeholder="StudentID" name="studentId"
                                                                value="ps/csc/18/0000" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-programtype">
                                                    <div class="form-row">
                                                        <label id="label-programtype" for="programtype"
                                                            class="col-md-3 col-form-label form-label">Program
                                                            Type</label>
                                                        <div class="col-md-9">
                                                            <select id="custom-select" required name="programtype"
                                                                class="form-control custom-select">
                                                                <option value="1" selected>BSC</option>
                                                                <option value="2">B-TECH</option>
                                                                <option value="3">HND</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-programStatus">
                                                    <div class="form-row">
                                                        <label id="label-programStatus" for="programStatus"
                                                            class="col-md-3 col-form-label form-label">Program
                                                            Status</label>
                                                        <div class="col-md-9">
                                                            <select id="custom-select" required name="programStatus"
                                                                class="form-control custom-select">
                                                                <option value="1" selected>STEM</option>
                                                                <option value="2">NON - STEM</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group"
                                                    aria-labelledby="label-highestEduLevel">
                                                    <div class="form-row">
                                                        <label id="label-highestEduLevel" for="highestEduLevel"
                                                            class="col-md-3 col-form-label form-label">Higest Level of
                                                            Education</label>
                                                        <div class="col-md-9">
                                                            <select id="custom-select1" name="highestEduLevel"
                                                                class="form-control custom-select toggle-trigger"
                                                                data-defaults="none" data-group="target-example">
                                                                <option selected value="none">Choose your level of
                                                                    Education
                                                                </option>
                                                                <option value="shs">Senior High School</option>
                                                                <option value="tertiary">Tertiary</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="toggle-target target-example" data-default="none" id="all">

                                                <div class="toggle-target target-example" data-lookup="shs"
                                                    id="senior1">
                                                    <div class="list-group-item">
                                                        <div class="form-group m-0" role="group"
                                                            aria-labelledby="label-NOI">
                                                            <div class="form-row">
                                                                <label id="label-NOI" for="NOI"
                                                                    class="col-md-3 col-form-label form-label">Name of
                                                                    Senior High School</label>
                                                                <div class="col-md-9">
                                                                    <select id="custom-select"
                                                                        class="form-control custom-select"
                                                                        data-depends="highestEduLevel"
                                                                        data-trigger="shs">
                                                                        <option selected>Adisadel College</option>
                                                                        <option value="1">Ghana National SHS</option>
                                                                        <option value="2">St. Augustine SHS</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-group-item" id="senior1">
                                                        <div class="form-group m-0" role="group"
                                                            aria-labelledby="label-POS">
                                                            <div class="form-row" id="senior1">
                                                                <label id="label-POS" for="POS"
                                                                    class="col-md-3 col-form-label form-label">Program
                                                                    of
                                                                    Study</label>
                                                                <div class="col-md-9">
                                                                    <select id="custom-select"
                                                                        class="form-control custom-select"
                                                                        data-depends="highestEduLevel"
                                                                        data-trigger="shs">
                                                                        <option selected>General Science</option>
                                                                        <option value="1">General Arts</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="list-group-item" id="senior1">
                                                        <div class="form-group m-0" role="group"
                                                            aria-labelledby="label-wassceGrade">
                                                            <div class="form-row" id="senior1">
                                                                <label id="label-wassceGrade" for="wassceGrade"
                                                                    class="col-md-3 col-form-label form-label">Wassce
                                                                    Grade</label>
                                                                <div class="col-md-9">
                                                                    <input id="wassceGrade" type="text"
                                                                        placeholder="Wassce grade" value=""
                                                                        class="form-control"
                                                                        data-depends="highestEduLevel"
                                                                        data-trigger="shs">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="list-group-item">
                                                        <div class="form-group row" id="senior1">
                                                            <label for="shs_cert"
                                                                class="col-sm-3 col-form-label form-label">Upload SHS
                                                                Certificate</label>
                                                            <div class="col-sm-9">
                                                                <div class="media align-items-center">
                                                                    <!-- <div class="media-left">
                                                                        <div class="icon-block rounded">
                                                                            <i
                                                                                class="material-icons text-muted-light md-36">photo</i>
                                                                        </div>
                                                                    </div> -->
                                                                    <div class="media-body">
                                                                        <div class="custom-file" style="width: auto;">
                                                                            <input type="file" id="shs_cert"
                                                                                class="custom-file-input"
                                                                                data-depends="highestEduLevel"
                                                                                data-trigger="shs">
                                                                            <label for="shs_cert"
                                                                                class="custom-file-label">Choose
                                                                                file</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- tertiary -->
                                                <div class="toggle-target target-example" data-lookup="tertiary"
                                                    id="tertiary2">
                                                    <div class="list-group-item" id="tertiary">
                                                        <div class="form-group m-0" role="group"
                                                            aria-labelledby="label-NOI">
                                                            <div class="form-row">
                                                                <label id="label-NOI" for="NOI"
                                                                    class="col-md-3 col-form-label form-label">Name of
                                                                    Institution</label>
                                                                <div class="col-md-9">
                                                                    <select id="custom-select"
                                                                        class="form-control custom-select"
                                                                        data-depends="highestEduLevel"
                                                                        data-trigger="tertiary">
                                                                        <option value="1" selected>University of Cape
                                                                            Coast</option>
                                                                        <option value="2">University of Ghana</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-group-item">
                                                        <div class="form-group m-0" role="group"
                                                            aria-labelledby="label-POS">
                                                            <div class="form-row">
                                                                <label id="label-POS" for="POS"
                                                                    class="col-md-3 col-form-label form-label">Program
                                                                    of
                                                                    Study</label>
                                                                <div class="col-md-9">
                                                                    <select id="custom-select"
                                                                        class="form-control custom-select"
                                                                        data-depends="highestEduLevel"
                                                                        data-trigger="tertiary">
                                                                        <option selected>HND Computer Science</option>
                                                                        <option value="1">HND Mathematics</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="list-group-item">
                                                        <div class="form-group m-0" role="group"
                                                            aria-labelledby="label-classObtained">
                                                            <div class="form-row">
                                                                <label id="label-classObtained" for="classObtained"
                                                                    class="col-md-3 col-form-label form-label">Class
                                                                    Obtained</label>
                                                                <div class="col-md-9">
                                                                    <input id="classObtained" type="text"
                                                                        placeholder="Class" value=""
                                                                        class="form-control"
                                                                        data-depends="highestEduLevel"
                                                                        data-trigger="tertiary">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="list-group-item">
                                                        <div class="form-group row">
                                                            <label for="tertiary_transcript"
                                                                class="col-sm-3 col-form-label form-label">Upload
                                                                transcript</label>
                                                            <div class="col-sm-9">
                                                                <div class="media align-items-center">
                                                                    <!-- <div class="media-left">
                                                                        <div class="icon-block rounded">
                                                                            <i
                                                                                class="material-icons text-muted-light md-36">photo</i>
                                                                        </div>
                                                                    </div> -->
                                                                    <div class="media-body">
                                                                        <div class="custom-file" style="width: auto;">
                                                                            <input type="file" id="tertiary_transcript"
                                                                                class="custom-file-input"
                                                                                data-depends="highestEduLevel"
                                                                                data-trigger="tertiary">
                                                                            <label for="tertiary_transcript"
                                                                                class="custom-file-label">Choose
                                                                                file</label>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <!-- <small>Notice: Upload current statement of results if you are a continuing student.</small> -->

                                                            </div>
                                                        </div>
                                                    </div>



                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="current_statement"
                                            class="col-sm-3 col-form-label form-label">Current Statement
                                            of
                                            results</label>
                                        <div class="col-sm-9">
                                            <div class="media align-items-center">
                                                <!-- <div class="media-left">
                                                    <div class="icon-block rounded">
                                                        <i class="material-icons text-muted-light md-36">photo</i>
                                                    </div>
                                                </div> -->
                                                <div class="media-body">
                                                    <div class="custom-file" style="width: auto;">
                                                        <input type="file" id="current_statement"
                                                            class="custom-file-input">
                                                        <label for="current_statement" class="custom-file-label">Choose
                                                            file</label>
                                                    </div>

                                                </div>

                                            </div>
                                            <small><span style="color: red;">Notice:</span> Upload current statement of
                                                results <span style="color: red;">only</span> if you are a continuing
                                                student.</small>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-4 offset-sm-3">
                                            <a href="#" class="btn btn-success tab-pane-btn" data-tab="#third"> Save and
                                                continue</a>
                                        </div>
                                    </div>



                                </div>

                                <div class="tab-pane validator" id="third">
                                    <div class="form-group row my-4">
                                        <label for="addmissionLetter"
                                            class="col-sm-3 col-form-label form-label">Addmission
                                            Letter</label>
                                        <div class="col-sm-9">
                                            <div class="media align-items-center">
                                                <!-- <div class="media-left">
                                                    <div class="icon-block rounded">
                                                        <i class="material-icons text-muted-light md-36">file_upload</i>
                                                    </div>
                                                </div> -->
                                                <div class="media-body">
                                                    <div class="custom-file" style="width: auto;">
                                                        <input type="file" name="addmissionLetter" id="addmissionLetter"
                                                            class="custom-file-input">
                                                        <label for="addmissionLetter" class="custom-file-label">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row my-4">
                                        <label for="recommLetter" class="col-sm-3 col-form-label form-label">Testimonial
                                            /
                                            Recommendation Letter</label>
                                        <div class="col-sm-9">
                                            <div class="media align-items-center">
                                                <!-- <div class="media-left">
                                                    <div class="icon-block rounded">
                                                        <i class="material-icons text-muted-light md-36">file_upload</i>
                                                    </div>
                                                </div> -->
                                                <div class="media-body">
                                                    <div class="custom-file" style="width: auto;">
                                                        <input type="file" name="recommendation" id="recommLetter"
                                                            class="custom-file-input">
                                                        <label for="recommLetter" class="custom-file-label">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <small>(Recommendation for continuing student and Testimonial for freshers.
                                                )</small>
                                        </div>
                                    </div>
                                    <div class="form-group row my-4">
                                        <label for="birthcertificate" class="col-sm-3 col-form-label form-label">Birth
                                            Certificate /
                                            National Identificatioin</label>
                                        <div class="col-sm-9">
                                            <div class="media align-items-center">
                                                <!-- <div class="media-left">
                                                    <div class="icon-block rounded">
                                                        <i class="material-icons text-muted-light md-36">photo</i>
                                                    </div>
                                                </div> -->
                                                <div class="media-body">
                                                    <div class="custom-file" style="width: auto;">
                                                        <input type="file" name="birthCert" id="birthcertificate"
                                                            class="custom-file-input">
                                                        <label for="birthcertificate" class="custom-file-label">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row my-4">
                                        <label for="passport" class="col-sm-3 col-form-label form-label">Passport
                                            Photo</label>
                                        <div class="col-sm-9">
                                            <div class="media align-items-center">
                                                <!-- <div class="media-left">
                                                    <div class="icon-block rounded">
                                                        <i class="material-icons text-muted-light md-36">photo</i>
                                                    </div>
                                                </div> -->
                                                <div class="media-body">
                                                    <div class="custom-file" style="width: auto;">
                                                        <input type="file" name="passportPhoto" id="passport"
                                                            class="custom-file-input">
                                                        <label for="passport" class="custom-file-label">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row my-4">
                                        <label for="statement" class="col-sm-3 col-form-label form-label">Personal
                                            Statement
                                        </label>
                                        <div class="col-sm-9">
                                            <div class="media align-items-center">
                                                <!-- <div class="media-left">
                                                    <div class="icon-block rounded">
                                                        <i class="material-icons text-muted-light md-36">photo</i>
                                                    </div>
                                                </div> -->
                                                <div class="media-body">
                                                    <div class="custom-file" style="width: auto;">
                                                        <input type="file" name="personal_statement"
                                                            id="personal_statement" class="custom-file-input">
                                                        <label for="personal_statement" class="custom-file-label">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-4 offset-sm-3">
                                            <div class="media align-items-center">
                                                <div class="media-left">
                                                    <button form="apply" type="submit"
                                                        class="btn btn-success">Submit</button>
                                                </div>
                                            </div>
                                        </div>
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
    </form>

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

    <script src="assets/js/index.js"></script>

</body>


</html>