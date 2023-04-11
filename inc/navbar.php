<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/res/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
              <li class="nav-item">
                  <a class="nav-link" href="index.php?site=hilfe">Häufige Fragen</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?site=impressum">Impressum</a>
              </li>
              <?php
              require("./config/dbaccess.php");
              $stmt = $mysql->prepare("SELECT IMAGE FROM accounts WHERE USERNAME = :username");
              $stmt->bindParam(":username", $_SESSION["username"]);
              $stmt->execute();
              $row = $stmt->fetch();
              $image_name = $row["IMAGE"] ?? "default.jpg";
              $image_path = "./res/img/user/" . $image_name;
              ?>
              <div class="dropstart">
                <li class="nav-item">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo $image_path ?>" width="30" height="30" alt="">
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="nav-link" href="index.php?site=profile">Profil</a>
                    <a class="nav-link" href="index.php?site=logout">Logout</a>
                    <a class="nav-link disabled">Logged in as: <?php echo $_SESSION["username"] ?></a>
                  </div>
                </li>
              </div>
              <?php } ?>
          </ul>
        </div>
      </div>
  </nav>
</body>
</html>