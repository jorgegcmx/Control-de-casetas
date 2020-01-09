<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="push.js-master/bin/push.min.js"></script>
</head>
<body>
<?php
   echo '
   <script>
   Push.create("Hola Mundo",{
       body:"Este es una nuevo mensaje",
       onClick: function(){
           window.location="www.google.com";
           this.close();
       }
   });
   </script>
   ';
   ?>
</body>
</html>

