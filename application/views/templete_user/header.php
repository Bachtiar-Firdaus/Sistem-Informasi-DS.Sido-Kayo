<div class="header_top" style="background-color:#007427;">
			<div class="wrap">
				<div class="logo">
					<a href="index.html"><img src="" alt="" /></a>
				</div>

				<div class="menu">
					<a class="toggleMenu" href="#"><img src="<?php echo base_url()?>assets/images/nav.png" alt="" /></a>
					<ul class="nav" id="nav">
						<li class="current"><a href="<?php echo site_url() ?>/welcome_user/index">Home</a></li>
						<li><a href="<?php echo site_url() ?>/welcome_user/beritainfo">Info Desa</a></li>
						<li><a href="<?php echo site_url() ?>/welcome_user/beritainfohasildesa">Info Hasil Desa</a></li>
						<li><a href="<?php echo site_url() ?>/welcome_user/saran">Saran</a></li>
<?php if($this->session->userdata('akses') == "USER"){ 
	?>

<li><a href="<?php echo site_url() ?>/Login/logout">Logout</a></li>

<?php }?>
						<div class="clear"></div>
					</ul>
					<script type="text/javascript" src="<?php echo base_url()?>assets/js/responsive-nav.js"></script>
				</div>

				<div class="menu" style="float: right;">
					<a class="toggleMenu" href="#"><img src="<?php echo base_url()?>assets/images/iconp.png" width="29"  alt="" /></a>
					
				</div>

				<div class="clear"></div>
			</div>
		</div>