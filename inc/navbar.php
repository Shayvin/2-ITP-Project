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