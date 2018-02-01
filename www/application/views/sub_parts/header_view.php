<?php include("common.php") ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
	<meta name="keywords" content="<?php echo $keywords?>" />
	<meta name="description" content="<?php echo $description?>" />
	<link href="<?php echo BASE_ASSETS; ?>images/favicon.jpg" rel="shortcut icon">
    <link href="<?php echo BASE_ASSETS; ?>css/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo BASE_ASSETS; ?>css/font-awesome.min.css" rel="stylesheet">
    
    <?php /*?><link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open Sans"><?php */?>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script
  src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
      <link href="<?php echo BASE_ASSETS; ?>css/custom.css" rel="stylesheet">
  
  
</head>
<body>
<div id="wrap">
	<div id="page">
        <header role="banner" class="navbar navbar-fixed-top navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button data-target=".bs-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo BASE_URL;?>"><img style="height:60px" src="<?php echo BASE_ASSETS; ?>images/tmlogo.jpg"></a>
                </div>
                <nav role="navigation" class="collapse navbar-collapse bs-navbar-collapse">
                    <ul class="nav navbar-nav">
                    <?php $controller = $this->uri->segment(1);$controller_action = $this->uri->segment(3);
                    
                    
                    $links = $this->navigation->getMenuArray($this->user);
                    
                    foreach ($links as $name=>$link) {
                    	$class = '';
                    	if ($link['active']) $class = "active";
                    	
                    	$sublinks = $this->navigation->getMenuArray('sub',strtolower($name));
                    	if (empty($sublinks)) echo '<li class="'.$class.'"><a href="'.BASE_URL.$link['uri'].'">'.$name.'</a></li>';
                    		else echo '<li class="'.$class.' dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$name.'</a><ul class="dropdown-menu">';
                    		
                    		foreach ($sublinks as $sname=>$slink) {
                    			$class = '';
                    			if ($slink['active']) $class = ' class="active"';
                    			echo '<li'.$class.'><a href="'.BASE_URL.$slink['uri'].'">'.$sname.'</a></li>';
                    			
                    		}
                    		
                    	if (!empty($sublinks)) echo '</ul></li>';
                    		
                    		
                    		
                    }
                    
                    
						
						if($this->user->isLogged()){?>
                        <li>&nbsp;&nbsp;&nbsp;
							<div id="header_profile" class="btn-group btn-group-xs">
								<button class="btn btn-primary navbar-btn" type="button" onClick="javascript: document.location = '<?php echo BASE_URL?>account';">
									<?php echo $this->user->getUserData('username')?>
								</button>
								<?php 
								// move out of template
								$count = $this->user->getRatingsCount();
								
								if (isset($_GET['return']))
									$return = $_GET['return'];
								else $return = $_SERVER['REQUEST_URI'];
								
								if($count==0){?>
								<button class="btn btn-default navbar-btn" type="button" onClick="javascript: document.location = '<?php echo BASE_URL?>subscribers/subscription?return=<?php echo $return?>';">Purchase Ratings</button>		
								<?php } else {?>
								<button class="btn btn-default navbar-btn" type="button" onClick="javascript: document.location = '<?php echo BASE_URL?>subscribers/subscription?return=<?php echo $return ?>';"><?php echo $count;?> Ratings</button>		
								<?php } ?>
							
								<button class="btn btn-danger navbar-btn" type="button" onClick="javascript: document.location = '<?php echo BASE_URL;?>logout';">
									<i class="fa fa-power-off"></i>
								</button>
							</div>
                        </li>
						<?php } ?>
                        </ul>
                    <div class="pull-right"><img src="<?php echo BASE_ASSETS; ?>images/headertitle.gif"></div>
                </nav>
            </div>
        </header>



	
