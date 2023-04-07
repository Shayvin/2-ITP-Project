<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/res/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php?site=home">Component Corner</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <ul class="navbar-nav ms-auto">
            <?php
            if(!isset($_SESSION['username']))
            {
            ?>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?site=register">Register</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?site=login">Login</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?site=hilfe">Häufige Fragen</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?site=impressum">Impressum</a>
              </li>
                <?php
              }
              ?>
              
              <?php if (isset($_SESSION['username'])) // Checkt ob der User eingeloggt ist
              {
                ?>
                </li>
                <li class="nav-item navcenter"><a class="nav-link" href="index.php?site=logout">Logout</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?site=hilfe">Häufige Fragen</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?site=impressum">Impressum</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Logged in as: <?php echo $_SESSION["username"] // gibt den Username aus?></a>
              </li>
                <?php } ?>
          </ul>
        </div>
      </div>
  </nav>
</body>
</html>