<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bare - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

</head>

<body>

    <!-- Navigation -->
    <?php
    $list_profiles = '';$add = '';
    $current_method = $this->router->fetch_method();
    $$current_method = 'open'; ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">                
                    <li class="<?php echo $list_profiles;?>">
                        <a  href="<?php echo base_url('/profile/list_profiles')?>">List Profiles</a>
                    </li>
                    <li class="<?php echo $add;?>">
                        <a href="<?php echo base_url('/profile/add')?>">Add Profile</a>
                    </li>
                </ul>
            </div>            
        </div>        
    </nav>

    <!-- Page Content -->
    <div class="wrapper" id='container_section'>

        <?php foreach($sections as $section){
            echo $section;

        } ?>
        </div>
    <script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
    <script src="<?php echo base_url('assets/js/custom.js')?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>

</body>

</html>
