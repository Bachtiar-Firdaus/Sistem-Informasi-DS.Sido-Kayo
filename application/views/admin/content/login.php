<div class="wrapper">
    <div class="row" style="margin-top: 90px">
      <div class="login-box bulet">
        <div class="login-logo">
          <a style="color: #5cb85c" href="../../index2.html"><b style="color: #5cb85c"> Panel</b>Login</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body bulet sadow">
          <p class="login-box-msg">Silahkan Login Terlebih Dahulu </p>

          <form action="../../index2.html" method="post">
            <div class="form-group has-feedback">
              <input type="email" class="form-control" placeholder="Email">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="Password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-xs-12">
                <a href="<?php echo site_url() ?>/admin_controller/login" class="btn btn-success btn-block btn-flat">Masuk</a>
                <a href="<?php echo site_url() ?>/admin_controller/daftar" class="btn btn-default btn-block btn-flat">Daftar</a>
              </div>
              <!-- /.col -->
            </div>
          </form>

        </div>
        <!-- /.login-box-body -->
      </div>
    </div>
  </div>