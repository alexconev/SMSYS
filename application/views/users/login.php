<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMSYS</title>  
    <meta name="description" content="">
    <link rel="icon" href="static/img/favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300&subset=cyrillic-ext,latin' rel='stylesheet' type='text/css'>
    <link href="static/css/normalize.css" rel="stylesheet">
    <link href="static/css/index.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <h1>SMSYS</h1>
      <form action="/main" method="POST">
        <div class="row">
          <input id="Mail" name="Mail" placeholder="e-mail..." type="email">
          <div class="clear"></div>
        </div>
        <div class="row">
          <input id="Pass" name="Pass" placeholder="password..." type="password">
          <div class="clear"></div>
        </div>
        <div class="row">
          <input type="submit" value="Влез"/>
          <div class="clear"></div>
        </div>
      </form>
    </div> <!-- /container -->
  </body>
</html>