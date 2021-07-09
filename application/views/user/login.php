<html>
    <head>

    </head>
    <body>
        <link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="<?php echo base_url() ?>/assets/css/login.css" rel="stylesheet" id="bootstrap-css">
        <script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/js/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Tabs Titles -->
                <?php echo validation_errors(); ?>
                <!-- Icon -->
                <div class="fadeIn first">
                    <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
                </div>

                <!-- Login Form -->
                <form method= "POST" action="" >
                    <input type="text" id="login" class="fadeIn second" name="email" placeholder="login">
                    <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
                    <input type="submit" class="fadeIn fourth" value="Log In">
                </form>

                <!-- Remind Passowrd -->
                <div id="formFooter">
                    <a class="underlineHover" href="#">Forgot Password?</a>
                </div>

            </div>
        </div>
    </body>
</html>