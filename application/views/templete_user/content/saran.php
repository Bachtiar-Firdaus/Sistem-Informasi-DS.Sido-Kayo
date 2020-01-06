

<style type="text/css">
    .ddd{
      color: red;
    font-size: 15pt;
    }
  </style>
  <div class="container bungkuscontent">
    <?php echo form_open_multipart('welcome_user/upload_saran', array('role'=>'form'));
            if(isset($message)): 
            echo "<div class='alert alert-success ddd action='post'> <b>".$message."</b></div>";
            endif; ?> 
  <p class="judulataskecil">Saran</p>
</div>

<div class="container" style="margin-top: 10px;">
<textarea type="textarea" name="saran" placeholder="Masukan saran anda ......" rows="4" cols="50"  style="height: 11rem;">

</textarea>

<!-- <a class="waves-effect waves-light btn3" style="background-color: #007427;"><b style="color: white;">Kirim</b></a> -->

<button type="submit" value="Save" class="btn" style="background-color: #007427; margin: auto;display: block;"><b style="color: white; " >KIRIM</button>

  <?php form_close();
      if(isset($errors)):
        echo "<div class='alert alert-danger'>".$errors."</div>";
      endif; ?> 

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
