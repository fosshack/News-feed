<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | NewsFeed</title>
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
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">News<b>Feed</b></a>
            <small>Making News Relevant for You!</small>
        </div>
        <?php echo $this->session->flashdata('msg'); ?>
        <div class="card">
            <div class="body">
                <form id="loginform" method="POST">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>                    
                    <div class="row">                        
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="<?= base_url(); ?>user/register">Register Now!</a>
                        </div>                      
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?= base_url(); ?>assets/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?= base_url(); ?>assets/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?= base_url(); ?>assets/js/admin.js"></script>
    <script src="<?= base_url(); ?>assets/js/pages/examples/sign-in.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript">
    function showToast(from, align, payload_message, color){
                                $.notify({
                                    icon: "notifications",
                                    message: payload_message

                                },{
                                    type: color,
                                    timer: 3000,
                                    placement: {
                                        from: from,
                                        align: align
                                    }})
                            }
        $("#loginform").submit(function(e) {
            var url = "<?php echo base_url(); ?>ajax/login"; 
            e.preventDefault();
            $.ajax({
               type: "POST",
               url: url,
               data: $("#loginform").serialize(),
               success: function(data)
               {

                    e.preventDefault();
                        var nFrom = 'top';
                        var nAlign = 'center';
                        var nIcons = $(this).attr('data-icon');
                        var nType = 'success';
                        var nAnimIn = $(this).attr('data-animation-in');
                        var nAnimOut = $(this).attr('data-animation-out');
                        var json = $.parseJSON(data);

                    console.log(json);
                    if (json.status == 'ok') {                                            
                        showToast('top','center','Login Success.. Redirecting..','success');
                        window.location.href ="<?= base_url(); ?>home/news";
                    }                         
                    else{
                        showToast('top','center',json.message,'danger');
                    }                   
               }
            });                                
        });
    </script>
</body>

</html>