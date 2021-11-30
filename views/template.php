<html>
  <head>
      <meta charset="UTF-8">
      <title>Chat</title>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style.css" />
      <link rel="icon" href="data:;base64,=">
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.3.1.min.js"></script>
  </head>
  <body>
           
  <?php $this->loadViewInTemplate($viewName, $viewData); ?>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/chat.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
  </body>
</html>
