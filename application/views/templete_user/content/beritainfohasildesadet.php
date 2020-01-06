<!-- <?php 
	$b=$data1->row_array();
?>
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<h2><?php echo $b['judul'];?></h2><br>
			<?php echo $b['tanggal'];?><hr/>
			<img src="<?php echo base_url().'upload/'.$b['photo'];?>" hight="300" width="300"><br>
			<?php echo $b['isi'];?>
		</div>
		
	</div>
	
<?php echo form_open_multipart('Welcome_user/pesan', array('role'=>'form'));
if(isset($message)): 
echo "<div class='alert alert-success action='post'>".$message."</div>";
endif; ?>


		<div class="komentar">
		<input type="hidden" name="kd_komentar" value='<?php echo $b['no'];?>'>
		<input type="hidden" type="text" name="produk" value='<?php echo $b['judul'];?>'>

		</div>


<input type="submit" value="Pesan" class="waves-effect waves-light btn" style="background-color: #007427; color: white; border: none; border-radius: 10px; width: 112px;"/>



<?php form_close();
if(isset($errors)):
echo "<div class='alert alert-danger'>".$errors."</div>";
endif; ?>  -->


<?php 
	$a;
?>

<style>
	.inputkomentar {
		width: 70% !important;
		float: left !important;
	}

	.btnkomentar {
		height: 43px;
		width: 30%;
	}

</style>

<div class="container bungkuscontent">
	<p class="judulataskecil">Detail info hasil desa</p>
</div>

<div class="container">
	<h6><b><?php echo $b['judul'];?></b></h6>
			<img src="<?php echo base_url().'upload/'.$b['photo'];?>" hight="300" width="300"><br>
	<p class="contentdetail"><?php echo $b['isi'];?></p>
	<p class="tanggaldesain"><i class="fa fa-calendar" style="margin-right: 5px;"></i><?php echo $b['tanggal'];?></p>



		
<?php 

if($this->session->userdata('akses') == "USER"){
echo form_open_multipart('Welcome_user/pesan', array('role'=>'form'));
if(isset($message)): 
echo "<div class='alert alert-success action='post'>".$message."</div>";
endif; ?>
		
		<div class="komentar" style="margin-top: 10px !important;
		margin-bottom: 10px !important;"><!-- 
		<button class="btnkomentar btn" style="background-color: #007427; color: white; border: none; border-radius: 10px;">Pesan</button> -->

		<input type="hidden" name="a" value='<?php echo $a;?>'>
		<input type="hidden" name="kd_komentar" value='<?php echo $b['no'];?>'>
		<input type="hidden" type="text" name="produk" value='<?php echo $b['judul'];?>'>

		<!-- <a href="<?php echo site_url() ?>/welcome_user/pesan" class="waves-effect waves-light btn" style="background-color: #007427; color: white; border: none; border-radius: 10px; width: 112px;">Pesan</a> --><!-- dayat -->

		<button type="submit" value="Pesan" class="waves-effect waves-light btn" style="background-color: #007427; color: white; border: none; border-radius: 10px; width: 112px;">PESAN </button><!-- daus -->




		</div>

<?php form_close();
if(isset($errors)):
echo "<div class='alert alert-danger'>".$errors."</div>";
endif; }?> 
		
</div>

