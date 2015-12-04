<!DOCTYPE html>
<html>
	<head>
	    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <meta name="description" content="<?php echo $Description;?>">
	    <link rel="icon" href="<?php echo base_url(); ?>static/img/favicon.ico">

	    <title><?php echo $Title;?> :: SMSYS</title>		

	    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300&subset=cyrillic-ext,latin' rel='stylesheet' type='text/css'>
	    <link href="<?php echo base_url(); ?>static/css/normalize.css" rel="stylesheet">
	    <link href="<?php echo base_url(); ?>static/css/style.css" rel="stylesheet">
	    <?php
	    	if(isset($arCss) && is_array($arCss))
	    		foreach ($arCss as $css) 
	    			echo '<link href="'.base_url().$css.'" rel="stylesheet">';
	    ?>

	    <script src="<?php echo base_url(); ?>static/js/jquery.js"></script>
	    <script src="<?php echo base_url(); ?>static/js/main.js"></script>
	    <?php
	    	if(isset($arJs) && is_array($arJs))
	    		foreach ($arJs as $js) 
	    			echo '<script src="'.base_url().$js.'"></script>';
	    ?>	    
	    <script>var base_url = "<?php echo base_url(); ?>";</script>
	</head>
	<body>
		<div class="wrapper">
			<header>
				<h1><a href="<?php echo base_url(); ?>pages/main">SMSYS v0.1</a></h1>
				<div class="header_nav">
					<span class="signal">&nbsp;</span>
				</div>
				<div class="clear"></div>
			</header>

	    	<nav>
				<ul>
		            <h3>Съобщения</h3>
		            <li><a href="<?php echo base_url(); ?>sms/send">Изпрати SMS</a></li>
		            <li><a href="<?php echo base_url(); ?>sms/outbox">Изходящи съобщения</a></li>
		            <li><a href="<?php echo base_url(); ?>sms/inbox">Входящи съобщения</a></li>
		            <li><a href="<?php echo base_url(); ?>sms/export">Запази съобщенията</a></li>
		            <h3>Контакти</h3>
            		<li><a href="<?php echo base_url(); ?>contacts/phonebook">Списък номера</a></li>
            		<li><a href="<?php echo base_url(); ?>contacts/addphone">Добави номер</a></li>
            		<li><a href="<?php echo base_url(); ?>contacts/groups">Списък групи</a></li>
            		<li><a href="<?php echo base_url(); ?>contacts/addgroup">Добави група</a></li>
            		<li><a href="<?php echo base_url(); ?>contacts/import">Импорт номера</a></li>
            		<li><a href="<?php echo base_url(); ?>contacts/export">Експорт номера</a></li>
	            	<h3>Потребители</h3>
            		<li><a href="<?php echo base_url(); ?>users/all">Списък</a></li>
            		<li><a href="<?php echo base_url(); ?>users/add">Добави потребител</a></li>  	            	
	            	<h3>Система</h3>
            		<li><a href="<?php echo base_url(); ?>sys/info">Информация</a></li>
            		<li><a href="<?php echo base_url(); ?>sys/statistics">Трафик</a></li>
            		<li><a href="<?php echo base_url(); ?>sys/log">Системен лог</a></li>
            		<li><a href="<?php echo base_url(); ?>pages/help">Помощ</a></li>
	          	</ul>    		
	    	</nav>