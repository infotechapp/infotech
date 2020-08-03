
                <div id="sidebar">
                    <!-- Wrapper for scrolling functionality -->
                    <div id="sidebar-scroll">
                        <!-- Sidebar Content -->
                        <div class="sidebar-content">
                            <!-- Brand -->
                            <a href="dashboard.php" class="sidebar-brand">
                                <i class="gi gi-flash"></i><span class="sidebar-nav-mini-hide"><strong><?php echo $_SESSION['first_name'];?></strong></span>
                            </a>
                            <!-- END Brand -->

                            <!-- User Info -->
                            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                                <div class="sidebar-user-avatar">
                                    <a href="dashboard.php">
                                        <img src="img/shafolo.png" alt="Login logo">
                                    </a>
                                </div>
                                <div class="sidebar-user-name"><?php echo $_SESSION['first_name'];?></div>
                               
                            </div>
                            <!-- END User Info -->

                           <ul class="sidebar-nav">
                                <li>
                                    <a href="dashboard.php"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a>
                                </li>
							</ul>
                            <!-- Sidebar Navigation -->
                            <!-- <ul class="sidebar-nav">
								 <li>
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">User Management</span></a>
                                    <ul>
                                        <li>
                                            <a href="userList.php">Users</a>
                                        </li>
                                       
                                    </ul>
                                </li>
                            </ul> -->
							<!-- <ul class="sidebar-nav">
								 <li>
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-shop_window sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Transaction Record</span></a>
                                    <ul>
                                        <li>
                                            <a href="transaction.php">Transaction history</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul> -->
                            <!-- END Sidebar Navigation -->
                        </div>
                        <!-- END Sidebar Content -->
                    </div>
                    <!-- END Wrapper for scrolling functionality -->
                </div>
                <!-- END Main Sidebar