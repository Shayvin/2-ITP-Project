<div class="container-fluid mt-5">
  <form action="index.php?site=chart-save" method="post">
    <div class="row align-items-center justify-content-center">
      <div class="col col-md-8 col-lg-6">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h1>Warenkorb</h1>
          <div>
            <button class="btn btn-outline-primary btn-lg" type="submit">Speichern</button>
            <a class="btn btn-primary btn-lg" href="index.php?site=kassa">Zur Kassa</a>
          </div>
        </div>
        <div class="row">
          <ul class="list-group list-group-flush mb-3">

            <?php
            require_once("./config/dbaccess.php"); // db access
            if (isset($_SESSION["username"])) { // check user login
              // get user_id
              $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :name");
              $stmt->execute(array(":name" => $_SESSION["username"]));
              $row = $stmt->fetch();
              $user_id = $row["ID"];
              echo "<input type='number' name='user_id' value=" . $user_id . " hidden />";
              if ($user_id) {
                $sum = 0;
                // Warenkorb-Abfrage
                $stmt2 = $mysql->prepare("SELECT * FROM warenkorb WHERE user_id = :id");
                $stmt2->execute(array(":id" => $user_id));
                for ($i = 0; $i < $stmt2->rowCount(); $i++) {
                  $row2 = $stmt2->fetch();
                  $artikel_id = $row2["artikel_id"];
                  $menge = $row2["menge"];
                  // Artikel-Abfrage
                  $stmt_artikel = $mysql->prepare("SELECT * FROM produkte WHERE ID = :id");
                  $stmt_artikel->execute(array(":id" => $artikel_id));
                  $artikel = $stmt_artikel->fetch();
                  $format = '
                  <li class="list-group-item py-3 border-bottom border-top">
                    <div class="row align-items-center">
                      <div class="col-3 col-md-2 text-center"><img class="img-fluid" src="./res/img/Artikelbilder/@imgpath" /></div>
                      <div class="col-4 col-md-7">
                        <h5>@name</h5>
                        <div class="text-muted">@details</div>
                      </div>
                      <div class="col-3 col-md-2">
                        <div class="input-group">
                          <div class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></div>
                          <input class="form-control form-control-sm" type="number" min="1" value="@menge" name="amount@pid"" />
                        </div>
                      </div>
                      <div class="col-2 col-md-1"><span>@preis,00€</span></div>
                    </div>
                  </li>
                  ';
                  echo strtr($format, [
                    "@name" => $artikel["NAME"],
                    "@details" => $artikel["BESCHREIBUNG"],
                    "@imgpath" => $artikel["IMAGE"],
                    "@preis" => $artikel["BRUTTO"],
                    "@menge" => $menge,
                    "@pid" => $artikel_id,
                  ]);
                  $sum += ($menge * $artikel["BRUTTO"]);
                }
              }
            }
            ?>
            
            <li class="list-group-item py-3">
              <div class="row align-items-center">
                <div class="col-6 col-md-8"></div>
                <div class="col-6 col-md-4 d-flex justify-content-between">
                  <span class="fs-5 fw-bolder">Summe: </span><span class="fs-5 fw-bolder">
                    <?php echo $sum; ?>,00€
                  </span>
                </div>
              </div>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </form>
</div>