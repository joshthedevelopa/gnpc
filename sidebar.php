<?php include_once ("Render.php"); 
$render = new Render();
$scholarshipStatus = $render->getUserAttribute('scholarshipStatus');

?>
<div class="mdk-drawer js-mdk-drawer"
                         id="default-drawer">
                        <div class="mdk-drawer__content ">
                            <div class="sidebar sidebar-left sidebar-dark bg-dark o-hidden"
                                 data-perfect-scrollbar>
                                <div class="sidebar-p-y">
                                    <div class="sidebar-heading">APPLICATIONS</div>
                                    <ul class="sidebar-menu sm-active-button-bg">
                                        <li class="sidebar-menu-item active">
                                            <a class="sidebar-menu-button"
                                               href="dashboard.php">
                                                <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_box</i> Dashboard
                                            </a>
                                        </li>
                                        <?php
                                        if($scholarshipStatus == EXPIRED)
                                        echo("<li class='sidebar-menu-item active'>
                                            <a class='sidebar-menu-button'
                                               href='renewal.php'>
                                                <i class='sidebar-menu-icon sidebar-menu-icon--left material-icons'>import_contacts</i> Renew Scholarship
                                            </a>
                                        </li>");
                                        ?>
                                        <ul class="sidebar-menu">
                                        <?php
                                        if($scholarshipStatus == REGISTERED)
                                        echo("<li class='sidebar-menu-item active'>
                                            <a class='sidebar-menu-button sidebar-js-collapse'
                                               data-toggle='collapse'
                                               href='#apply_menu'>
                                               <i class='sidebar-menu-icon sidebar-menu-icon--left material-icons'>school</i> Apply Scholarship
                                                
                                                <span class='ml-auto sidebar-menu-toggle-icon'></span>
                                            </a>");
                                            ?>
                                            <ul class="sidebar-submenu sm-indent collapse"
                                                id="apply_menu">

                                                <li class="sidebar-menu-item">
                                                    <a class="sidebar-menu-button"
                                                       href="undergraduate.php">
                                                        <span class="sidebar-menu-text">Undergraduate</span>
                                                    </a>
                                                </li>
                                                <!-- <li class="sidebar-menu-item">
                                                    <a class="sidebar-menu-button"
                                                       href="dashboard.php">
                                                        <span class="sidebar-menu-text">Basic Information</span>
                                                    </a>
                                                </li> -->
                                                <li class="sidebar-menu-item">
                                                    <a class="sidebar-menu-button"
                                                       href="masters.php">
                                                        <span class="sidebar-menu-text">Masters</span>
                                                    </a>
                                                </li>
                                                <li class="sidebar-menu-item">
                                                    <a class="sidebar-menu-button"
                                                       href="phd.php">
                                                        <span class="sidebar-menu-text">PhD</span>
                                                    </a>
                                                </li>
                                                
                                                
                                                
                                    </ul>
                                        
                                        
                                    </ul>
                                    <!-- Account menu -->
                                    <?php
                                    if($scholarshipStatus != SUSPENDED)
                                    echo("<div class='sidebar-heading'>Account</div>
                                    <ul class='sidebar-menu'>
                                        <li class='sidebar-menu-item'>
                                            <a class='sidebar-menu-button sidebar-js-collapse'
                                               data-toggle='collapse'
                                               href='#account_menu'>
                                                <i class='sidebar-menu-icon sidebar-menu-icon--left material-icons'>person_outline</i>
                                                Account
                                                <span class='ml-auto sidebar-menu-toggle-icon'></span>
                                            </a>");
                                            ?>
                                            <ul class="sidebar-submenu sm-indent collapse"
                                                id="account_menu">

                                                <li class="sidebar-menu-item">
                                                    <a class="sidebar-menu-button"
                                                       href="student-account-edit.php">
                                                        <span class="sidebar-menu-text">Edit Account</span>
                                                    </a>
                                                </li>
                                                <li class="sidebar-menu-item">
                                                    <a class="sidebar-menu-button"
                                                       href="change_password.php">
                                                        <span class="sidebar-menu-text">Change Password</span>
                                                    </a>
                                                </li>
                                                <!-- <li class="sidebar-menu-item">
                                                    <a class="sidebar-menu-button"
                                                       href="dashboard.php">
                                                        <span class="sidebar-menu-text">Basic Information</span>
                                                    </a>
                                                </li> -->
                                                <!-- <li class="sidebar-menu-item">
                                                    <a class="sidebar-menu-button"
                                                       href="academic-info.php">
                                                        <span class="sidebar-menu-text">Academic Information</span>
                                                    </a>
                                                </li>
                                                <li class="sidebar-menu-item">
                                                    <a class="sidebar-menu-button"
                                                       href="payment-info.php">
                                                        <span class="sidebar-menu-text">Payment Information</span>
                                                    </a>
                                                </li> -->
                                                <li class="sidebar-menu-item">
                                                    <a class="sidebar-menu-button"
                                                       href="documents.php">
                                                        <span class="sidebar-menu-text">My Documents</span>
                                                    </a>
                                                </li>
                                                <!-- <li class="sidebar-menu-item">
                                                    <a class="sidebar-menu-button"
                                                       href="student-account-edit-profile.php">
                                                        <span class="sidebar-menu-text">Profile &amp; Privacy</span>
                                                    </a>
                                                </li> -->
                                                
                                    </ul>
                                    <div class="sidebar-heading">Student</div>
                                    <ul class="sidebar-menu sm-active-button-bg">
                                        
                                        
                                        <li class="sidebar-menu-item">
                                            <a class="sidebar-menu-button"
                                               href="/gnpc/scripts/students/logout">
                                                <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">lock_open</i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>