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
	    <link href="<?php echo base_url(); ?>static/css/list.css" rel="stylesheet">

	    <script src="<?php echo base_url(); ?>static/js/jquery.js"></script>
	    <script src="<?php echo base_url(); ?>static/js/main.js"></script>
	    <script>var base_url = "<?php echo base_url(); ?>";</script>
	</head>
	<body>
		<div class="wrapper">
			<header>
				<h1><a href="<?php echo base_url(); ?>pages/main">SMSYS</a></h1>
				<div class="header_nav">
					<span class="signal">&nbsp;</span>
					<a href="<?php echo base_url(); ?>sms/send">Изпрати SMS</a>
					<a href="<?php echo base_url(); ?>sys/settings">Настройки</a>
					<a href="<?php echo base_url(); ?>pages/help">Помощ</a>
				</div>
				<div class="clear"></div>
			</header>

	    	<nav>
				<ul>
		            <h3>Съобщения</h3>
		            <li><a href="<?php echo base_url(); ?>sms/outbox">Изходящи</a></li>
		            <li><a href="<?php echo base_url(); ?>sms/inbox">Входящи</a></li>
		            <h3>Контакти</h3>
            		<li><a href="<?php echo base_url(); ?>contacts/phonebook">Номера</a></li>
            		<li><a href="<?php echo base_url(); ?>contacts/groups">Групи</a></li>
            		<li><a href="<?php echo base_url(); ?>contacts/import">Импорт</a></li>
	            	<h3>Статистика</h3>
            		<li><a href="<?php echo base_url(); ?>stats/day">Днес</a></li>
            		<li><a href="<?php echo base_url(); ?>stats/week">Последна седмица</a></li>
            		<li><a href="<?php echo base_url(); ?>stats/month">Последен месец</a></li>
            		<h3>Логове</h3>
            		<li><a href="<?php echo base_url(); ?>logs/sys">Системен лог</a></li>
            		<li><a href="<?php echo base_url(); ?>logs/in">Входящи логове</a></li>
            		<li><a href="<?php echo base_url(); ?>logs/out">Изходящи логове</a></li>
	          	</ul>    		
	    	</nav>