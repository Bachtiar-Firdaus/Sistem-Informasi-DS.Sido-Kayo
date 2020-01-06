<!-- <?php 
	$b=$data1->row_array();
?>
		<div class="col-md-8 col-md-offset-2">
			<h2><?php echo $b['judul'];?></h2><br>
			<?php echo $b['tanggal'];?><hr/>
			<img src="<?php echo base_url().'upload/'.$b['photo'];?>" hight="300" width="300"><br>
			<?php echo $b['isi'];?>
		</div>
		
	</div>
	
<?php echo form_open_multipart('Welcome_user/upload_b', array('role'=>'form'));
if(isset($message)): 
echo "<div class='alert alert-success action='post'>".$message."</div>";
endif; ?>


		<div class="komentar">
		<input type="hidden" name="kd_komentar" value='<?php echo $b['no'];?>'>
		<input class="inputkomentar" type="text" name="isi" placeholder="komentar .....">


		</div>


<input type="submit" value="Kirim" class="waves-effect waves-light btn"/>


<?php form_close();
if(isset($errors)):
echo "<div class='alert alert-danger'>".$errors."</div>";
endif; ?> 
<br><!-- 
<?php echo $c['no']," ",$c['nama']," ",$c['isikomentar'];?>  -->


<!-- <?php foreach($data2 as $v)
            {
                echo "tanggal = ";
                echo $v->tanggal;
                echo "|| nama = ";
                echo $v->nama;
                echo "|| isi komentar = ";
                echo $v->isikomentar;
                echo "|| gambar ";
                ?><img src="<?php echo base_url().'upload/'.$v->photo;?>" hight="300" width="300"><?php
                echo "<br>";
            }
            ?>  -->



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
	<p class="judulataskecil">Berita Info Detail</p>
</div>

<div class="container">
	<h6><b><?php echo $b['judul'];?></b></h6>
	<p class="tanggaldesain"><i class="fa fa-calendar" style="margin-right: 5px;"></i><?php echo $b['tanggal'];?></p>
	<img src="<?php echo base_url().'upload/'.$b['photo'];?>" alt="" class="img-detail" />

		
	<p class="contentdetail"><?php echo $b['isi'];?></p>

	
<?php 

if($this->session->userdata('akses') == "USER"){?>
	<?php echo form_open_multipart('Welcome_user/upload_b', array('role'=>'form'));
if(isset($message)): 
echo "<div class='alert alert-success action='post'>".$message."</div>";
endif; ?>
		
		<div class="komentar" style="margin-top: 10px !important;
		margin-bottom: 10px !important;">

		<input type="hidden" name="a" value='<?php echo $a;?>'>
		<input type="hidden" name="kd_komentar" value='<?php echo $b['no'];?>'>
		<input class="inputkomentar" type="text" name="isi" placeholder="komentar .....">

		<button class="btnkomentar">kirim</button><!-- buton bawaan -->
		<!-- <input type="submit" value="Kirim" class="waves-effect waves-light btn"/> --><!-- buton daus -->

		</div>

		<?php form_close();
if(isset($errors)):
echo "<div class='alert alert-danger'>".$errors."</div>";
endif; ?> 

		
</div>







<section class="listkomentar">
	<div class="container">

		<?php /*print_r($data2)*/foreach($data2 as $v)
            { ?>

            	
                
            



				<div class="contentlk">
					<div class=".img-contentkom">
						<img class="pp1" src="<?php echo base_url().'upload/'.$v->photo;?>" alt=""  />
					</div>
					<div class="contentsubkomen">
						<h4 class="judulcontent"><b><?php echo $v->nama; ?></b></h4>
						<p class="tanggaldesain"><?php echo $v->isikomentar; ?></p>
						<p class="tanggaldesain"><i class="fa fa-calendar" style="margin-right: 5px;"></i><?php echo $v->tanggal; ?></p>
					</div>

				</div>

			<?php }	
            ?>
		
		</div>	
		</section>

<?php } ?>
