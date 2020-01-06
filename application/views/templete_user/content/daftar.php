


  <div class="bb" style="background-color: #007427; height: 600px;">
  <style type="text/css">
    .ntf{
      color: red;
    font-size: 15pt;
    }
  </style>
  <div class="row">
    <div class="input-field col s12">
      <?php echo form_open_multipart('login/upload', array('role'=>'form'));
            if(isset($message)): 
            echo "<div class='alert alert-success ntf action='post'><b>".$message."</b></div>";
            endif; ?> 
      <input placeholder="Nama Lengkap" name="nama" id="first_name2" type="text" class="validate">
      <input placeholder="Alamat" name="alamat" id="first_name2" type="text" class="validate">
      <input placeholder="No Handphone" name="nohp" id="first_name2" type="number" class="validate">
      <input placeholder="Email/username" name="user" id="first_name2" type="text" class="validate">
      <input placeholder="Password" id="first_name2" name="password" type="password" class="validate">

      <div id="previewLoad" style='margin-left: 0px; display: none'>
                <img src='<?php echo base_url();?>images/loading.gif'/>
              </div>
              <div class="image_preview">
              
              </div>

      <label for="title">File</label>
              <input type="file" name="userfile" id="image" onchange="readURL(this)"/>
<input type="submit" value="Daftar" class="btn btn-primary" style="margin-top: 10px;" />
              <a href="#" onclick="reset();" class="btn btn-warning" style="margin-top: 10px;">batal</a>

<p><a href="<?php echo base_url().'index.php/login/';?>" style="color: white; margin-top: 10px;">Login Sekarang</a></p>

<?php form_close();
      if(isset($errors)):
        echo "<div class='alert alert-danger'>".$errors."</div>";
      endif; ?> 

      <!-- <a class="waves-effect waves-light btn2" style="background-color: white;"><b style="color: #007427;">Daftar</b></a> -->
    </div>
  </div>
</div>

<script type="text/javascript">
  function readURL(input) {
  $('#previewLoad').show();
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('.image_preview').html('<img src="'+e.target.result+'" alt="'+reader.name+'" class="img-thumbnail" width="304" height="236"/>');
    }

    reader.readAsDataURL(input.files[0]);
    $('#previewLoad').hide();
  }
  }
  
  function reset(){
  $('#image').val("");
  $('.image_preview').html("");
  }
  </script>
