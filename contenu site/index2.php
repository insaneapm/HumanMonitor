<!DOCTYPE html>
<?php
try{
$bdd = new PDO('mysql:host=damay.org;dbname=HumanMonitorDatabase;charset=utf8', 'piou@damay.org', 'juanDAMA1')
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
<html>
    <head>
        <title>Basic Web Page</title>
    </head>
    <body>
Hello World!
    </body>
</html>