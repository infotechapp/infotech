<style type="text/css">
    
    .navbar.navbar-default {
    background-color: #49a2e7;
}
</style>
<header class="navbar navbar-default">

                        <!-- Left Header Navigation -->
                        <ul class="nav navbar-nav-custom">
                            <h4><strong>Hi,</strong> <strong><?php echo $_SESSION['first_name'];?></strong></h4>
                            <!-- Main Sidebar Toggle Button -->
                            <!-- <li>
                                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                    <i class="fa fa-bars fa-fw"></i>
                                </a>
                            </li> -->
                            <!-- END Main Sidebar Toggle Button -->

                        </ul>
                        <!-- END Left Header Navigation -->

                        

                        <!-- Right Header Navigation -->
                        <ul class="nav navbar-nav-custom pull-right">
                            <!-- Alternative Sidebar Toggle Button -->
                            

                            <!-- User Dropdown -->
                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="img/placeholders/avatars/avatar2.jpg" alt="avatar"> <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                    
                                    <li>
                                        <!--a href="change_password.php"><i class="fa fa-lock fa-fw pull-right"></i> Change Password</a-->
                                        <a href="logout.php"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                                    </li>
                                   
                                </ul>
                            </li>
                            <!-- END User Dropdown -->
                        </ul>
                        <!-- END Right Header Navigation -->
                    </header>
                    <!-- END Header -->
					
					