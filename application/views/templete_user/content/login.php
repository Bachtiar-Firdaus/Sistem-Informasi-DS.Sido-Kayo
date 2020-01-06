<!-- 
    <div class="container form-login">

      <form class="form-signin col-md-6 col-md-offset-3 outter-form-login" role="form" style="background-color: white;" 

      method="post" action="<?php echo base_url().'index.php/login/auth'?>">

        <div style="height: 90px;background-size:100% 100%; background-image: url('asset/img/bgr.jpg')";>
            
        </div><br>


        <div class="form-group">
           <label class="control-label"><small>Login Akun</small></label><br>
           <?php echo $this->session->flashdata('msg');?>
           

      </div>

        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
            <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" name="username" id="username" required autofocus>
        </div>
        <br/>

        <div class="input-group">
           <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
           <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" name="password" id="password" required>
      </div><br>

        <button class="btn btn-primary form-control" type="submit" style="background-color: #f5613b;">Masuk</button>
      </form>
<a href="<?php echo base_url().'index.php/login/daftar/';?>">daftar sekarang</a>
    </div>   -->




<div class="header_desc">
      <div class="wrap">
        <p><?php echo $this->session->flashdata('msg');?></p>
        <p class="juduld">Login</p>
        <form method="post" action="<?php echo base_url().'index.php/login/auth'?>">
        <div class="kolomsaran">

          <div class="row" style="margin-bottom: 0;">
            <div class="input-field col s12">
              
              <input placeholder="Nama User" id="username" type="text" class="validate" name="username">
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="Kata Sandi" id="password" name="password" type="text" class="validate">
            </div>
          </div>

          <button class="waves-effect waves-light btn" type="submit" style="color: white;">Masuk</button>

          <!-- <a type="submit" class="waves-effect waves-light btn"><b style="color: white;">Masuk</b></a> -->
        </div>
        </form>
        <p style="text-align: center; "><a href="<?php echo base_url().'index.php/login/daftar/';?>" ">Klik disini untuk daftar akun</a></p>
        
      </div>
    </div>