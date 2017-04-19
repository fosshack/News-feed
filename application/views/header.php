<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>NewsFeed</title>
    <!-- Favicon-->
    <link rel="icon" href="<?= base_url(); ?>assets/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?= base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?= base_url(); ?>assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?= base_url(); ?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?= base_url(); ?>assets/css/themes/all-themes.css" rel="stylesheet" />
    <!-- Jquery Core Js -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

    <style type="text/css">
        
        .upvote {
          display: inline-block;
          overflow: hidden;
          width: 40px;
          height: 25px;
          cursor: pointer;
          background: url('http://i.stack.imgur.com/iqN2k.png');
          background-position: 0 -25px;
        } 


        .upvote.on {
          background-position: 0 2px;
        }       
        .downvote {
          display: inline-block;
          overflow: hidden;
          width: 40px;
          height: 25px;
          padding-top: 28px;
          cursor: pointer;
          background: url('https://i.imgur.com/hLnmUJ8.png');
          background-position: 0 -25px;
        } 


        .downvote.on {
          background-position: 0 2px;
        }      
        
        .upcount
        {
            position: absolute;
            top: 247px;
            left: 107px;
        }
            
    </style>
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.upvote').click(function () {
              $(this).toggleClass('on');
              var object_id = $(this).attr('data-id');
              console.log(object_id);
              $.post( "<?= base_url(); ?>ajax/vote/up", { object_id: object_id } ,function(data){
                    var obj = JSON.parse(data);
                    if(obj.status=='ok')   
                    {                                                                
                        showToast('top','center','Success','success');
                    }                         
                    else{
                        showToast('top','center','Something went Wrong!','danger');
                    }               
                });
              $('.downvote').removeClass('on');
            });   
            $('.downvote').click(function () {
              $(this).toggleClass('on');
              var object_id = $(this).attr('data-id');
              console.log(object_id);
              $.post( "<?= base_url(); ?>ajax/vote/down", { object_id: object_id } ,function(data){
                    var obj = JSON.parse(data);
                    if(obj.status=='ok')   
                    {                                                                
                        showToast('top','center','Success','success');
                    }                         
                    else{
                        showToast('top','center','Something went Wrong!','danger');
                    }               
                });
              $('.upvote').removeClass('on');
            }); 


        });  
    </script>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <form method="GET" action="<?= base_url(); ?>home/search">
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING..." name="q">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    </form>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?= base_url(); ?>home/news">NewsFeed</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->

                   
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">person</i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            
                            <li><a href="<?= base_url(); ?>home/upvoted"><i class="material-icons">favorite</i>Upvoted!</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?= base_url(); ?>user/logout"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
       
    </section>