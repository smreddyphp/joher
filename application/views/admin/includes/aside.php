
    <!-- Side-Nav-->
    <aside class="main-sidebar hidden-print " >
        <section class="sidebar" id="sidebar-scroll">
            <div class="user-panel">
                <div class="f-left image"><img src="<?php echo base_url(); ?>assets/images/avatar-1.png"  alt="User Image" class="img-circle"></div>
                <div class="f-left info">
                    <p>John Doe</p>
                    <p class="designation">Admin <i class="icofont icofont-caret-down m-l-5"></i></p>
                </div>
            </div>
            <!-- sidebar profile Menu-->
            <ul class="nav sidebar-menu extra-profile-list">
                <li>
                    <a class="waves-effect waves-dark" href="javascript:" >
                        <i class="icon-user"></i>
                        <span class="menu-text">View Profile</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="javascript:">
                        <i class="icon-settings"></i>
                        <span class="menu-text">Settings</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="javascript:">
                        <i class="icon-logout"></i>
                        <span class="menu-text">Logout</span>
                        <span class="selected"></span>
                    </a>
                </li>
            </ul>
            <!-- Sidebar Menu-->
            <ul class="sidebar-menu">
                <li class="treeview <?php echo (@$current_page=='dashboard')? 'active': '';?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url()."admin"?>">
                        <i class="icon-speedometer"></i><span> Dashboard</span>
                    </a>
                  
                </li>
                
                <li class="ctive treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-basket-loaded"></i><span>Products</span><i class="icon-arrow-down"></i></a>
                    <ul class="treeview-menu">
                        <li class="active"><a class="waves-effect waves-dark" href="product.php" tppabs="http://ableproadmin.com/light/vertical/product.php"><i class="icon-arrow-right"></i> Product</a></li>
                        <li><a class="waves-effect waves-dark" href="product-detail.php" tppabs="http://ableproadmin.com/light/vertical/product-detail.php"><i class="icon-arrow-right"></i> Product Detail</a></li>
                        <li><a class="waves-effect waves-dark" href="product-list.php" tppabs="http://ableproadmin.com/light/vertical/product-list.php"><i class="icon-arrow-right"></i> Product List</a></li>
                        <li><a class="waves-effect waves-dark" href="product-edit.php" tppabs="http://ableproadmin.com/light/vertical/product-edit.php"><i class="icon-arrow-right"></i> Product Edit</a></li>
                    </ul>
                </li>

           


                

                <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-book-open"></i><span> Forms</span><i class="icon-arrow-down"></i></a>
                    <ul class="treeview-menu">
                     
                        <li><a class="waves-effect waves-dark" href="form-elements-materialize.php" ><i class="icon-arrow-right"></i> Form Elements Material</a></li>
                 
                       
            
                        <li><a class="waves-effect waves-dark" href="forms-validation.php" ><i class="icon-arrow-right"></i> Form Validation</a></li>
                    </ul>
                </li>

                <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-list"></i><span> Tables</span><i class="icon-arrow-down"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="waves-effect waves-dark" href="data-table.php"><i class="icon-arrow-right"></i> Data Tables</a></li>
       
                    </ul>
                </li>

            
            </ul>
        </section>
    </aside>
    <!-- Sidebar chat start -->
    <div id="sidebar" class="p-fixed header-users showChat">
        <div class="had-container">
            <div class="card card_main header-users-main">
                <div class="card-content user-box">

                    <div class="md-group-add-on p-20">
                                 <span class="md-add-on">
                                    <i class="icofont icofont-search-alt-2 chat-search"></i>
                                 </span>
                        <div class="md-input-wrapper">
                            <input type="text" class="md-form-control"  name="username" id="search-friends">
                            <label for="username">Search</label>
                        </div>

                    </div>
                    <div class="media friendlist-main">

                        <h6>Friend List</h6>

                    </div>
                    <div class="main-friend-list">
                        <div class="media friendlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">

                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-1.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-1.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Josephin Doe</div>
                                <span>20min ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="3" data-status="online" data-username="Alice"  data-toggle="tooltip" data-placement="left" title="Alice">
                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-2.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-2.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Alice</div>
                                <span>1 hour ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="7" data-status="offline" data-username="Michael Scofield" data-toggle="tooltip" data-placement="left" title="Michael Scofield">
                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-3.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-3.png" alt="Generic placeholder image">
                                <div class="live-status bg-danger"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Michael Scofield</div>
                                <span>3 hours ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="5" data-status="online" data-username="Irina Shayk" data-toggle="tooltip" data-placement="left" title="Irina Shayk">
                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-4.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-4.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Irina Shayk</div>
                                <span>1 day ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="6" data-status="offline" data-username="Sara Tancredi" data-toggle="tooltip" data-placement="left" title="Sara Tancredi">
                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-5.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-5.png" alt="Generic placeholder image">
                                <div class="live-status bg-danger"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Sara Tancredi</div>
                                <span>2 days ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">
                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-1.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-1.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Josephin Doe</div>
                                <span>20min ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="3" data-status="online" data-username="Alice" data-toggle="tooltip" data-placement="left" title="Alice">
                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-2.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-2.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Alice</div>
                                <span>1 hour ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">

                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-1.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-1.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Josephin Doe</div>
                                <span>20min ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="3" data-status="online" data-username="Alice" data-toggle="tooltip" data-placement="left" title="Alice">
                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-2.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-2.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Alice</div>
                                <span>1 hour ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip"  data-placement="left" title="Josephin Doe">

                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-1.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-1.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Josephin Doe</div>
                                <span>20min ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="3" data-status="online" data-username="Alice"  data-toggle="tooltip" data-placement="left" title="Alice">
                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-2.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-2.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Alice</div>
                                <span>1 hour ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">

                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-1.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-1.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Josephin Doe</div>
                                <span>20min ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">

                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-1.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-1.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Josephin Doe</div>
                                <span>20min ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">

                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-1.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-1.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Josephin Doe</div>
                                <span>20min ago</span>
                            </div>
                        </div>
                        <div class="media friendlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">

                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/images/avatar-1.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-1.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Josephin Doe</div>
                                <span>20min ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="showChat_inner">
        <div class="media chat-inner-header">
            <a class="back_chatBox">
                <i class="icofont icofont-rounded-left"></i> Josephin Doe
            </a>
        </div>
        <div class="media chat-messages">
            <a class="media-left photo-table" href="#!">
                <img class="media-object img-circle m-t-5" src="<?php echo base_url(); ?>assets/images/avatar-1.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-1.png" alt="Generic placeholder image">
                <div class="live-status bg-success"></div>
            </a>
            <div class="media-body chat-menu-content">
                <div class="">
                    <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                    <p class="chat-time">8:20 a.m.</p>
                </div>
            </div>
        </div>
        <div class="media chat-messages">
            <div class="media-body chat-menu-reply">
                <div class="">
                    <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                    <p class="chat-time">8:20 a.m.</p>
                </div>
            </div>
            <div class="media-right photo-table">
                <a href="#!">
                    <img class="media-object img-circle m-t-5" src="<?php echo base_url(); ?>assets/images/avatar-2.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/avatar-2.png" alt="Generic placeholder image">
                    <div class="live-status bg-success"></div>
                </a>
            </div>
        </div>
        <div class="media chat-reply-box">
            <div class="md-input-wrapper">
                <input type="text" class="md-form-control" id="inputEmail" name="inputEmail" >
                <label>Share your thoughts</label>
                 <span class="highlight"></span>
                 <span class="bar"></span>  <button type="button" class="chat-send waves-effect waves-light">
                     <i class="icofont icofont-location-arrow f-20 "></i>
                 </button>

                <button type="button" class="chat-send waves-effect waves-light">
                    <i class="icofont icofont-location-arrow f-20 "></i>
                </button>
            </div>

        </div>
    </div>