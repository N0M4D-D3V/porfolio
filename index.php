<?php 
		error_reporting(E_ALL ^ E_NOTICE);
		require_once('config.php');
		require_once('class/Nostalgia.class.php');
		$Nostalgia=new Nostalgia($config,$configDefault);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

	<head>

		<title><?php echo htmlspecialchars($Nostalgia->getTitle()); ?></title>
		<meta name="keywords" content="<?php echo htmlspecialchars($Nostalgia->getKeywords()); ?>" />
		<meta name="description" content="<?php echo htmlspecialchars($Nostalgia->getDescription()); ?>" />		
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<link rel="icon" type="image/x-icon" href="/image/favicon.svg">
		
		<link rel="stylesheet" type="text/css" href="style/jquery.qtip.css"/>
		<link rel="stylesheet" type="text/css" href="style/jquery.jScrollPane.css"/>
		<link rel="stylesheet" type="text/css" href="style/jquery-ui.min.css"/>
		<link rel="stylesheet" type="text/css" href="style/supersized/supersized.css"/>
		<link rel="stylesheet" type="text/css" href="style/fancybox/jquery.fancybox.css"/> 
		<link rel="stylesheet" type="text/css" href="style/fancybox/helpers/jquery.fancybox-buttons.css"/> 
		<link rel="stylesheet" type="text/css" href="style/base.css"/> 
		<link rel="stylesheet" type="text/css" href="style/page.css"/> 
		
		<link rel="stylesheet" type="text/css" media="screen and (max-width:550px)" href="style/responsive-0-550.css"/> 
		<link rel="stylesheet" type="text/css" media="screen and (min-width:480px) and (max-width:550px)" href="style/responsive-480-550.css"/> 
		<link rel="stylesheet" type="text/css" media="screen and (max-width:479px)" href="style/responsive-0-479.css"/> 
		<link rel="stylesheet" type="text/css" media="screen and (max-height:510px)" href="style/responsive-height-0-510.css"/> 
		
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Voces"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Dosis:400,300,200,500,600,700,800" />
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Aldrich"/>

		<script type="text/javascript">
			var config=<?php echo json_encode($config); ?>;
			var configDefault=<?php echo json_encode($configDefault); ?>;
			var mainURL='<?php echo dirname($_SERVER['SCRIPT_NAME']).'/'; ?>';
		</script>
		
		<script type="text/javascript" src="script/jquery.min.js"></script>
		<script type="text/javascript" src="script/jquery-migrate.min.js"></script>

	</head>

	<body>
		
		<div id="nostalgia">
			
			<!-- Navigation -->
			<div id="nostalgia-navigation">

				<div id="nostalgia-navigation-menu">

					<!-- Menu -->
					<ul>
						<li><a href="<?php $Nostalgia->_getURL('about.html'); ?>">About</a></li>
						<li><a href="<?php $Nostalgia->_getURL('services.html'); ?>">Services</a></li>
						<li><a href="<?php $Nostalgia->_getURL('portfolio.html'); ?>">Portfolio</a></li>
						<li><a href="<?php $Nostalgia->_getURL('contact.html'); ?>">Contact</a></li>
					</ul>
					<!-- /Menu -->
					
					<a href="#" id="nostalgia-navigation-prev-button"></a>
					<a href="#" id="nostalgia-navigation-next-button"></a>
					<a href="#" class="audio-player music-off"></a>
					<a href="<?php $Nostalgia->_getURL('main'); ?>" id="nostalgia-navigation-close-button"></a>
					
				</div>

				<!-- Name box -->
				<div id="nostalgia-navigation-name-box">
					<span>Victor</span>
					<span style='color: black;font-size: 26px;font-weight: bold;'> Software Developer</span>
				</div>
				<!-- /Name box -->
				
				<div id="nostalgia-navigation-click-here-box"></div>

			</div>
			<!-- /Navigation -->
			
			<!-- Tab -->
			<div id="nostalgia-tab">
				
				<!-- Tab icon -->
				<div id="nostalgia-tab-icon"></div>
				<!-- /Tab icon -->
				
				<!-- Content -->
				<div id="nostalgia-tab-content">
					
					<form name="nostalgia-tab-content-menu" id="nostalgia-tab-content-menu" method="post" action="">
						
						<div>
							
							<select id="nostalgia-tab-content-menu-select" name="nostalgia-tab-content-menu-select">
								<option value="<?php $Nostalgia->_getURL('about.html'); ?>">About</option>
								<option value="<?php $Nostalgia->_getURL('services.html'); ?>">Services</option>
								<option value="<?php $Nostalgia->_getURL('portfolio.html'); ?>">Portfolio</option>
								<option value="<?php $Nostalgia->_getURL('contact.html'); ?>">Contact</option>
								<option value="<?php $Nostalgia->_getURL('main'); ?>">- Close -</option>
							</select>
							
						</div>
						
					</form>

					<!-- Scroll section -->
					<div id="nostalgia-tab-content-scroll">

						<div id="nostalgia-tab-content-page">
							<?php $Nostalgia->loadFile(); ?>
						</div>

					</div>
					<!-- /Scroll section -->

					<!-- Footer -->
					<div id="nostalgia-tab-footer" class="clear-fix">
						
						<ul class="no-list social-list">
							<li><a href="media/files/cv-victor-gonzalez-en.pdf" target="_blank"> <img width='100%' src="image/icon/icon-social/icon_social_download.svg" alt="curriculum icon"> </a></li>
							<li><a href="https://www.malt.es/profile/victordevelops" target="_blank"> <img width='100%' src="image/icon/icon-social/icon_social_malt.svg" alt="malt icon"> </a></li>
							<li><a href="https://github.com/YandrosChaos" target="_blank"> <img width='100%' src="image/icon/icon-social/icon_social_github.svg" alt="github icon"> </a></li>
							<li><a href="https://www.linkedin.com/in/victor-develops/" target="_blank"> <img width='100%' src="image/icon/icon-social/icon_social_linkedin.svg" alt="linkedin icon"> </a></li>
							<li><a href="/#!contact.html"> <img width='100%' src="image/icon/icon-social/icon_social_email.svg" alt="mailto icon"> </a></li>
						</ul>
						
						<div class="nostalgia-tab-footer-caption">
						
							<span class="float-left"><a href="media/files/cv-victor-gonzalez-en.pdf" target="_blank">Curriculum Vitae</a></span>
							<span class="float-right"><a href="media/files/cv-victor-gonzalez-en.pdf" target="_blank">Copyright Victor Gonzalez</a></span>
						
						</div>

					</div>
					<!-- /Footer -->

				</div>
				<!-- /Content -->
						
			</div>
			<!-- /Tab -->
			
			<!-- Media control -->
			<div id="media-control">

				<div id="slidecaption-wrapper">
					<div id="slidecaption"></div>
				</div>

				<a href="#" id="nextslide"></a>
				<a href="#" id="prevslide"></a>
				<a href="#" class="audio-player music-off"></a>

			</div>
			<!-- /Media control -->

		</div>
		
		<!-- Preloader -->
		<div id="start-preloader">
			<div>
				<p>Loading images ...</p>
			</div>
		</div>
		<!-- /Preloader -->
		
		<!-- Background overlay -->
		<div id="background-overlay">
			<div class="background-overlay-1"></div>
		</div>
		<!-- /Background overlay -->
		
		<!-- Nostalgia hidden fileds -->
		<div>
			<input type="hidden" id="nostalgiaRequest" name="nostalgiaRequest" value="<?php echo $Nostalgia->getRequest(); ?>" />
			<input type="hidden" id="nostalgiaRequestType" name="nostalgiaRequestType" value="<?php echo $Nostalgia->getRequestType(); ?>" />
		</div>
		<!-- Nostalgia hidden fileds -->
		
		<!-- JPlayer -->
		<div id="jPlayer"></div>
		<!-- /JPlayer -->

		<script type="text/javascript" src="script/jquery-ui.min.js"></script>
		<script type="text/javascript" src="script/jquery.easing.js"></script>
		<script type="text/javascript" src="script/jquery.blockUI.js"></script>
		<script type="text/javascript" src="script/jquery.qtip.min.js"></script>
		<script type="text/javascript" src="script/jquery.ba-bqq.min.js"></script>
		<script type="text/javascript" src="script/jquery.jplayer.min.js"></script>
		<script type="text/javascript" src="script/jquery.mousewheel.min.js"></script>
		<script type="text/javascript" src="script/jquery.supersized.min.js"></script>
		<script type="text/javascript" src="script/jquery.jScrollPane.min.js"></script>
		<script type="text/javascript" src="script/jquery.supersized.shutter.min.js"></script>
		<script type="text/javascript" src="script/jquery.carouFredSel.packed.js"></script>
		
		<script type="text/javascript" src="script/jquery.fancybox.js"></script>
		<script type="text/javascript" src="script/jquery.fancybox-media.js"></script>
		<script type="text/javascript" src="script/jquery.fancybox-buttons.js"></script>
		
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>    

		<script type="text/javascript" src="script/script.js"></script>
		<script type="text/javascript" src="script/nostalgia.js"></script>
		<script type="text/javascript" src="script/main.js"></script>
	</body>

</html>