<?php

$row = $this->db->query("SELECT nama_website FROM identitas")->row_array();
//echo "$row[nama_website]";
//print_r($row);
$contacts = $this->db->query("SELECT * FROM contact where id_contact=1")->row_array();
//print_r($contacts);
?>
<div class="row align-items-top justify-content-center d-flex">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 py-12 mb-4">
		<!-- <img class="shadow bg-white rounded" src="<?php echo base_url("asset/foto_contact/" . $contacts['gambar']); ?>" alt=""> -->
		<a href="<?php echo base_url(); ?>" class="text-white h2"><img src="<?php echo home_url() . 'asset/settings/' . setting('site_logo'); ?>"></a>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 mb-4" data-aos="zoom-in-up" data-aos-once="true">
		<div class="contact-bottom">
			<h2 class="mb-4">Contact Us</h2>
			<!-- <h5 class="mb-3"><?php echo $contacts['nama']; ?></h5> -->
			<ul class="list-unstyled">
				<?php if (!empty($contacts['alamat'])) : ?>
					<li class="media">
						<i class="fa fa-globe mr-3"></i>
						<!-- <img data-src="holder.js/60x60?theme=dark" class="mr-3" src="..." alt="Generic placeholder image"> -->
						<div class="media-body">
							<!-- <h5 class="mt-0 mb-1">Hubungi Kami Sekarang !</h5> -->
							<?php echo $contacts['alamat']; ?>
						</div>
					</li>
				<?php endif; ?>
				<?php if (!empty($contacts['mobile'])) : ?>
					<li class="media">
						<i class="fas fa-mobile-alt mr-3"></i>
						<!-- <img data-src="holder.js/60x60?theme=dark" class="mr-3" src="..." alt="Generic placeholder image"> -->
						<div class="media-body">
							<!-- <h5 class="mt-0 mb-1">Hubungi Kami Sekarang !</h5> -->
							<?php listitem($contacts['mobile']); ?>
						</div>
					</li>
				<?php endif; ?>
				<?php if (!empty($contacts['phone'])) : ?>
					<li class="media">
						<i class="fa fa-phone mr-3"></i>
						<!-- <img data-src="holder.js/60x60?theme=dark" class="mr-3" src="..." alt="Generic placeholder image"> -->
						<div class="media-body">
							<!-- <h5 class="mt-0 mb-1">Hubungi Kami Sekarang !</h5> -->
							<?php listitem($contacts['phone']); ?>
						</div>
					</li>
				<?php endif; ?>
				<?php if (!empty($contacts['wa'])) : ?>
					<li class="media">
						<i class="fab fa-whatsapp mr-3"></i>
						<!-- <img data-src="holder.js/60x60?theme=dark" class="mr-3" src="..." alt="Generic placeholder image"> -->
						<div class="media-body">
							<!-- <h5 class="mt-0 mb-1">Chat dengan kami !</h5> -->
							<?php listitem($contacts['wa'], 'wa'); ?>
						</div>
					</li>
				<?php endif; ?>
				<?php if (!empty($contacts['fax'])) : ?>
					<li class="media">
						<i class="fa fa-fax mr-3"></i>
						<!-- <img data-src="holder.js/60x60?theme=dark" class="mr-3" src="..." alt="Generic placeholder image"> -->
						<div class="media-body">
							<!-- <h5 class="mt-0 mb-1">Hubungi Kami Sekarang !</h5> -->
							<?php listitem($contacts['fax']); ?>
						</div>
					</li>
				<?php endif; ?>
				<?php if (!empty($contacts['email'])) : ?>
					<li class="media">
						<i class="fas fa-at mr-3"></i>
						<!-- <img data-src="holder.js/60x60?theme=dark" class="mr-3" src="..." alt="Generic placeholder image"> -->
						<div class="media-body">
							<!-- <h5 class="mt-0 mb-1">Hubungi Kami Sekarang !</h5> -->
							<?php listitem($contacts['email'], 'email'); ?>
						</div>
					</li>
				<?php endif; ?>
				<?php if (!empty($contacts['ig'])) : ?>
					<li class="media">
						<i class="fas fa-at mr-3"></i>
						<!-- <img data-src="holder.js/60x60?theme=dark" class="mr-3" src="..." alt="Generic placeholder image"> -->
						<div class="media-body">
							<!-- <h5 class="mt-0 mb-1">Hubungi Kami Sekarang !</h5> -->
							<?php listitem($contacts['ig'], 'link'); ?>
						</div>
					</li>
				<?php endif; ?>
			</ul>
			<?php
			?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 mb-4" data-aos="zoom-in-up" data-aos-once="true">
		<h2 class="mb-4">Hubungi Kami</h2>
		<!-- <p class="mb-0">Hubungi Kami.</p> -->
		<a target='_blank' href="tel:<?= Globals::idContact()->mobile ?>" class="btn btn-danger mb-4 font-weight-bold text-uppercase"><i class="icon icon-phone align-self-center mr-3 d-blockz d-sm-none" style="margin:0 10px 0 0"></i> <?= Globals::idContact()->mobile ?></a>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
			Kirim Permintaan
		</button>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 mb-4" data-aos="zoom-in-up" data-aos-once="true">
		<div id="follow-us">
			<h2 class="mb-4">Follow us</h2>
			<h2>

				<a target="_blank" href="https://api.whatsapp.com/send?phone=<?= $contacts['wa'] ?>&text=Hai%20!%20inkre.id"><i class="fab fa-whatsapp"></i></a>
				<a target="_blank" href="<?= $contacts['fb'] ?>"><i class="fab fa-facebook"></i></a>
				<!-- <a target="_blank" href="<?= $contacts['twitter'] ?>"><i class="fab fa-twitter-square"></i></a> -->
				<a target="_blank" href="<?= $contacts['gplus'] ?>"><i class="fab fa-youtube"></i></a>
				<a target="_blank" href="<?= $contacts['ig'] ?>"><i class="fab fa-instagram"></i></a>
				<!-- <a target="_blank" href="<?= $contacts['lin'] ?>"><i class="fab fa-linkedin"></i></a> -->



				<i class="fab fa-google-plus-square hidden"></i>


				<i class="fas fa-rss-square hidden"></i>
			</h2>
		</div>
	</div>
</div>