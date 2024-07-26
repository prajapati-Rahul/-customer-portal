<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style=""></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?Module_Controller/dashboard">
                <i class="entypo-gauge"></i>
                <span>Dashboard</span>
            </a>
            <ul>
                <li class="active">
                    <a href="<?php echo base_url(); ?>index.php?Module_Controller/dashboard">
                        <span><i class="entypo-dot"></i>List view</span>
                    </a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url(); ?>index.php?Module_Controller/create">
                        <span><i class="entypo-dot"></i>Create</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- SETTINGS -->
        <li class="<?php
        if ($page_name == 'system_settings' || $page_name == 'manage_language' || $page_name == 'sms_settings')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span>Settings </span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?Module_Controller/dashboard">
                        <span><i class="entypo-dot"></i> General Settings </span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?Module_Controller/dashboard">
                        <span><i class="entypo-dot"></i> Layout Settings </span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?Module_Controller/dashboard">
                        <span><i class="entypo-dot"></i> Language Settings </span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?Module_Controller/dashboard">
                <i class="entypo-lock"></i>
                <span>Account</span>
            </a>
        </li>

        <!-- Main wevsite -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?Module_Controller/dashboard">
                <i class="entypo-credit-card"></i>
                <span>Main Wevsite</span>
            </a>
        </li>

        <!-- Help -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?Module_Controller/dashboard">
                <i class="entypo-users"></i>
                <span>Help</span>
            </a>
        </li>

        <!-- About Us -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?Module_Controller/dashboard">
                <i class="entypo-doc-text-inv"></i>
                <span>About Us</span>
            </a>
        </li>

    </ul>

</div>