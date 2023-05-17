<?php 

	$path=$_SERVER['SCRIPT_FILENAME'];

	if(strcmp(basename($path),'index.php')==0) require_once(dirname($path).'/plugin/contact-form/config.php');
	else require_once(dirname($path).'/../plugin/contact-form/config.php');
?>

<div class="page-contact clear-fix">
	
	<!-- Header + subtitle -->
	<h1>Contact</h1>
	<p class="subtitle-paragraph">
		If you just want to say hello or ask a question,
		<span class="bold">please send me a short message.</span>
	</p>
	<!--/ Header + subtitle -->
	
	<!-- Personal details + Google map -->
	<h3>On the map</h3>
	<div class="clear-fix contact-details">
		
		<div class="contact-details-about">
			
			Keith Douglas<br/>
			Quai Henri IV<br/>
			75004 Paris, France
			
			<ul class="no-list">
				<li class="icon-2 icon-2-1">T: 877 123 0223</li>
				<li class="icon-2 icon-2-2">F: 877 123 0224</li>				
				<li class="icon-2 icon-2-3">E: keith@douglas.com</li>			
			</ul>
			
		</div>
		
		<div class="contact-details-map">
			<div class="contact-details-map-arrow"></div>
			<div id="map"></div>
		</div>
		
	</div>
	<!-- /Personal details + Google map -->
	
	<!-- Contact form -->
	<h3>General Inquiry</h3>
	<form name="contact-form" id="contact-form" action="" method="post" class="clear-fix">

		<div class="clear-fix">

			<div class="clear-fix form-line">
				<div class="float-left block"><input type="text" name="contact-form-name" id="contact-form-name" value="<?php echo CONTACT_FORM_LABEL_DATA_NAME; ?>" onfocus="clearInput(this,'focus','<?php echo CONTACT_FORM_LABEL_DATA_NAME; ?>')" onblur="clearInput(this,'blur','<?php echo CONTACT_FORM_LABEL_DATA_NAME; ?>')"/></div>	
				<div class="float-right block"><input type="text" name="contact-form-mail" id="contact-form-mail" value="<?php echo CONTACT_FORM_LABEL_DATA_MAIL; ?>" onfocus="clearInput(this,'focus','<?php echo CONTACT_FORM_LABEL_DATA_MAIL; ?>')" onblur="clearInput(this,'blur','<?php echo CONTACT_FORM_LABEL_DATA_MAIL; ?>')"/></div>	
			</div>
			<div class="clear-fix form-line">
				<div class="float-left block">
					<textarea rows="1" cols="1" name="contact-form-message" id="contact-form-message" onfocus="clearInput(this,'focus','<?php echo CONTACT_FORM_LABEL_DATA_MESSAGE; ?>')" onblur="clearInput(this,'blur','<?php echo CONTACT_FORM_LABEL_DATA_MESSAGE; ?>')"><?php echo CONTACT_FORM_LABEL_DATA_MESSAGE; ?></textarea>	
				</div>
			</div>
			<div class="clear-fix form-line float-right block">
				<input type="submit" value="Send" class="button" name="contact-form-send" id="contact-form-send"/>
			</div>

		</div>

	</form>
	<!-- /Contact form -->
	
</div>