<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?site=home">Component Corner</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <ul class="navbar-nav ms-auto">
        <?php
        if (!isset($_SESSION['username'])) {
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
          <li class="nav-item align-items-center">
            <a class="nav-link" href="index.php?site=chart">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
              </svg>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?site=userverwaltung">Accounts verwalten</a>
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