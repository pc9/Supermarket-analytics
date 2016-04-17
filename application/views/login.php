<!DOCTYPE html>
<html>
<?=$header?>
<style>
  .callout{
    margin-top:15px;
    padding: 10px 30px 10px 15px;
  }
</style>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html">Admin Panel</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="/authenticate" method="post">
        <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <input type="hidden" name="<?=$csrf_name;?>" value="<?=$csrf_hash;?>" />
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
      </form>
      <?php if($error_msg != '') {?>
      <div class="callout callout-danger">
        <p><?=$error_msg?></p>
      </div>
      <?php }?> 
    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->
  <?=$footer?>
</body>
</html>
