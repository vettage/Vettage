<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Vettage Administrator Area</title>
	<link rel="icon" href="<?php echo BASE_ASSETS; ?>favicon.jpg" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_ASSETS?>admin/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_ASSETS?>admin/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_ASSETS?>admin/css/bootstrap-responsive.css">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript" src="<?php echo BASE_ASSETS?>admin/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo BASE_ASSETS?>admin/js/jquery_custom.js"></script>
	<script type="text/javascript" src="<?php echo BASE_ASSETS?>admin/js/jquery_qtip.js"></script>
	<script type="text/javascript" src="<?php echo BASE_ASSETS?>admin/js/javascript_global.js"></script>
	<script type="text/javascript" src="<?php echo BASE_ASSETS?>admin/js/javascript.js"></script>
	<script type="text/javascript" src="<?php echo BASE_ASSETS?>admin/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo BASE_ASSETS?>admin/js/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_ASSETS?>admin/css/jquery_admin.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_ASSETS?>admin/css/css.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_ASSETS?>admin/css/jquery_qtip.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_ASSETS?>admin/css/datepicker.css">
</head>

<body>
	<?php $permissions = $this->session->userdata('permissions'); ?>
	<div id="wrap">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-header"></div>
			<div class="navbar-inner">
				<div class="container">
					<a class="brand" href="<?php echo BASE_URL?>admin"><img src="<?php echo BASE_ASSETS?>img/content/logo_small.png"/></a>
					<ul class="nav">
						<? if($this->session->userdata('admin_logged_in')==NULL) { ?>
							<li><a title="Home" href="<?php echo BASE_URL?>admin/home">Home</a></li>
						<?php } else {   ?>
							<li class="dropdown">
								<a title="Home" href="<?php echo BASE_URL?>admin/home">Home</a>
								<ul class="dropdown-menu">
									<li class="top_border"></li>
									<li><a href="<?php echo BASE_URL?>admin/home/logout">Logout</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="javascript:void(0);">Members</a>
								<ul class="dropdown-menu">
									<li class="top_border"></li>
									<li><a href="<?php echo BASE_URL?>admin/members">Members</a></li>
									<li><a href="<?php echo BASE_URL?>admin/members?action=Search">Search Members</a></li>
									<li><a href="<?php echo BASE_URL?>admin/members/add">Add Member</a></li>
                                    <li><a href="<?php echo BASE_URL?>admin/members/payment">Payment Info</a></li>
								</ul>
							</li>
                            <li >
								<a href="<?php echo BASE_URL?>admin/contents">Contents</a>
                                </li>
                                 <li >
								<a href="<?php echo BASE_URL?>admin/country">Countries</a>
                                </li>
                                 <li >
								<a href="<?php echo BASE_URL?>admin/story_review">Story Review</a>
                                </li>
							<li class="dropdown">
								<a href="javascript:void(0);" data-toggle="dropdown">Manage</a>
								<ul class="dropdown-menu">
									<li class="top_border"></li>
									<li><a href="<?php echo BASE_URL?>admin/blog_template">Blog</a></li>
                                    <li><a href="<?php echo BASE_URL?>admin/category">Blog Category</a></li>
									<li><a href="<?php echo BASE_URL?>admin/faq">FAQ</a></li>
									<li><a href="<?php echo BASE_URL?>admin/email_template">Templates Manager</a></li>
									<li><a href="<?php echo BASE_URL?>admin/page_template">Page Manager</a></li>
									<li><a href="<?php echo BASE_URL?>admin/site_settings">Settings</a></li>
								</ul>
							</li>
						<?php }?>
					</ul>
					
					<? if($this->session->userdata('admin_logged_in')!=NULL) { ?>
					<div class="pull-right right_key">
						<div class="header-shortcuts">
							<a class="btn_h" title="Settings" href="<?php echo BASE_URL?>admin/site_settings"><i class="icon-wrench"></i></a>
							<a class="btn_h" href="<?php echo BASE_URL?>admin/home/logout"><i class="icon-lock"></i> Logout</a>
						</div>
					</div>
					<?php }?>
				
			</div>
		</div>
	</div>