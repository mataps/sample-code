<link href="/css/admin/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/css/admin/login.css">
<div id="fullscreen_bg" class="fullscreen_bg"/>
<center><img src="/img/logo.png"></center>
<div class="container">
<br><br>
    <form class="form-signin" method="post">
        <?php echo Form::token(); ?>
        <input type="text" name="username" class="form-control" placeholder="Email address" required="" autofocus="">
        <input type="password" name="password" class="form-control" placeholder="Password" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            Sign In
        </button>
    </form>
</div>