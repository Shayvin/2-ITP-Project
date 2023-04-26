<?php
session_start();
$site = @$_GET['site'];
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- TODO <link rel="shortcut icon" type="image/png" href=""> -->
  <title><?php echo $site; ?> | Component Corner</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./res/css/style.css">
</head>

<body>
  <?php
    include 'inc/navbar.php';
  ?>
  <?php
  if ($site == '') {
    header('Location: index.php?site=home');
  }
  switch ($site) {
    case 'home':
      include 'inc/home.php';
      break;

    case 'hilfe':
      include 'inc/hilfe.php';
      break;
    
    case 'profile':
      include 'inc/profile.php';
      break;

    case 'login':
      include 'inc/login.php';
      break;

    case 'register':
      include 'inc/register.php';
      break;

    case 'impressum':
      include 'inc/impressum.php';
      break;

    case 'logout':
      include 'inc/logout.php';
      break;

    case 'chart':
      include 'inc/chart.php';
      break;

    case 'artikel':
      include 'inc/artikel.php';
      break;
      
  }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>