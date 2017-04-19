<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign Up | NewsFeed</title>
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

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);">News<b>Feed</b></a>
            <small>Making News Relevant for You!</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="regform" method="POST">
                    <div class="msg">Register a new membership</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="full_name" placeholder="Full Name" required autofocus>
                        </div>
                    </div>
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
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="user_email" placeholder="Email Address" required>
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
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="cnf_password" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="<?= base_url(); ?>user/login">You already have a membership?</a>
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
    <script src="<?= base_url(); ?>assets/js/pages/examples/sign-up.js"></script>
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
        $("#regform").submit(function(e) {
            var url = "<?php echo base_url(); ?>ajax/register"; 
            e.preventDefault();
            $.ajax({
               type: "POST",
               url: url,
               data: $("#regform").serialize(),
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
                        showToast('top','center','Successfully Registered','success');
                        //window.location.href ="<?= base_url(); ?>home/news";
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