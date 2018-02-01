<!--sticky menu-->
<div class="row-fluid top-bar">

<!--small logo-->
<div class="logo-small">
	<a href="<?php echo BASE_URL;?>"><img src="<?php echo BASE_ASSETS; ?>img/content/logo_small.png" alt="logo" /></a>
</div>

<!--main menu-->
<div class="mainNav clearfix">

	<!--main nav-->
	<ul class="nav" id="navigation">
	
		<li class="menu-item ">
			<a href="<?php echo BASE_URL;?>site/pages/about">fooAbout</a>
		</li>
		<li class="menu-item ">
			<a href="<?php echo BASE_URL;?>help">FAQ</a>
		</li>
		<li class="menu-item ">
			<a href="<?php echo BASE_URL;?>blogs">Blog</a>
		</li>
		<li class="menu-item ">
			<a href="<?php echo BASE_URL;?>site/pages/terms">Terms</a>
		</li>
		<li class="menu-item ">
			<a href="<?php echo BASE_URL;?>site/pages/privacy">Privacy</a>
		</li>
		<li class="menu-item ">
			<a href="<?php echo BASE_URL;?>site/pages/advertise">Advertise</a>
		</li>
		<li class="menu-item ">
			<a href="<?php echo BASE_URL;?>site/pages/copyrights">Copyrights</a>
		</li>
		<li class="menu-item ">
			<a href="<?php echo BASE_URL;?>site/pages/developers">Developers</a>
		</li>
		
		<li class="menu-item ">
			<a href="javascript:void(0);">&copy; 2015 Vettage</a>
		</li>
		
		<?php /*?><li class="menu-item dropdown active"><a href="#">ABOUT US<b class="icon-down-open-mini"></b></a>
			<ul class="dropdown-menu">
				<li class="menu-item"><a href="index.html#">All Info</a></li>
				<li class="menu-item"><a href="index.html#filter01">Filter 1</a></li>
				<li class="menu-item"><a href="index.html#filter02">Filter 2</a></li>
				<li class="menu-item last"><a href="index.html#filter03">Filter 3</a></li>
			</ul>
		</li>
		<li class="menu-item dropdown "><a href="#">PORTFOLIO<b class="icon-down-open-mini"></b></a>
			<ul class="dropdown-menu">
				<li class="menu-item"><a href="portfolio.html#">All Work</a></li>
				<li class="menu-item"><a href="portfolio.html#image">Image</a></li>
				<li class="menu-item"><a href="portfolio.html#gallery">Gallery</a></li>
				<li class="menu-item"><a href="portfolio.html#video">Video</a></li>
				<li class="menu-item last"><a href="portfolio.html#page">Page</a></li>
			</ul>
		</li>
		<li class="menu-item dropdown "><a href="#">GALLERY<b class="icon-down-open-mini"></b></a>
			<ul class="dropdown-menu">
				<li class="menu-item"><a href="gallery.html#">All Images</a></li>
				<li class="menu-item"><a href="gallery.html#fashion">Fashion</a></li>
				<li class="menu-item"><a href="gallery.html#landscape">Landscape</a></li>
				<li class="menu-item"><a href="gallery.html#interior">Interior</a></li>
				<li class="menu-item last"><a href="gallery.html#beauty">Beauty</a></li>
			</ul>
		</li>
		<li class="menu-item dropdown "><a href="#">GOODIES<b class="icon-down-open-mini"></b></a>
			<ul class="dropdown-menu">
				<li class="menu-item "><a href="portfolio_bw.html">Black and White Portfolio</a></li>
				<li class="menu-item "><a href="gallery_bw.html">Black and White Gallery</a></li>
				<li class="menu-item "><a href="project_gallery.html">Gallery Project</a></li>
				<li class="menu-item "><a href="project_slider.html">Slider Project</a></li>
				<li class="menu-item "><a href="project.html">Image Project</a></li>
				<li class="menu-item "><a href="post.html">Single Post</a></li>
				<li class="menu-item dropdown last"><a href="#yourlinkhere">Third Level<b class="icon-down-open-mini"></b></a>
				<!--third level menu example-->
				<ul class="dropdown-menu sub-menu">
					<li class="menu-item"><a href="index.html#">Third</a></li>
					<li class="menu-item"><a href="index.html#about">Level</a></li>
					<li class="menu-item last"><a href="index.html#services">Example</a></li>
				</ul>	
				</li>
			</ul>
		</li>
		<li class="menu-item ">
			<a href="blog.html">BLOG</a>
		</li><?php */?>
	</ul>
	
</div>

<?php if($this->session->userdata('fv_logged_in')!=FALSE){?>
<div class="clearfix pull-right" style="margin-right:10px;">
	<a href="<?php echo BASE_URL;?>account"><?php echo $this->session->userdata('username')?></a>
	<a href="javascript:void(0);">|</a>
	<a href="<?php echo BASE_URL;?>logout">Sign out</a>
</div>
<?php } ?>

<!--drop navigation-->
<div id="drop-nav" class="mobile-nav" data-label="Menu...">
</div>

</div>
<!--end sticky menu-->