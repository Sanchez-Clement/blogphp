<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/materialize.min.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
      <main class="container">
        <section class="row">



<?php
if (isset($_POST['id'])) {
  # code...

try
{
  $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$req = $bdd->prepare('SELECT titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date_creation_fr FROM article WHERE id=?');
$req->execute(array($_POST['id']));
while ($donnees = $req->fetch()) {  ?>

  <article class="billets purple card col s12 m7">
    <h6><?php echo htmlspecialchars($donnees["titre"]) ?> <em> <?php echo $donnees["date_creation_fr"] ?></em></h6>
    <p><?php echo htmlspecialchars($donnees["contenu"] )?></p>


  </article>
<?php }; 


$req = $bdd->prepare('SELECT  commentaire_article, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaire WHERE id_article = ? ORDER BY date_commentaire');
$req->execute(array($_POST['id']));
while ($donnees = $req->fetch()) {

 ?>
<article class="red card col s12 m7">


<p><?php echo $donnees["commentaire_article"] ?></p>
<caption><?php echo $donnees["date_commentaire_fr"] ?></caption>
</article>
<?php }
}

else {
header('Location: index.php');
}


?>

  </section>


</main>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='https://www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
</body>
</html>
