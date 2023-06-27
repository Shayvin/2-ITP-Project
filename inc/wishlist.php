<div class="container-fluid mt-5">
  <div class="row align-items-center justify-content-center">
    <div class="col col-md-10 col-lg-8">
      <h1 class="mb-4">Wunschliste</h1>
      <div class="table-responsive">
        <table class="table table-hover text-center">
          <thead class="table-secondary">
            <th colspan="2">Produkt</th>
            <th>Preis</th>
            <th>Warenkorb</th>
            <th>Entfernen</th>
          </thead>
          <tbody>
          <?php
            require_once("./config/dbaccess.php"); // db access
            if (isset($_SESSION["userID"])) { //nur für eingeloggte user
              $stmt_wish = $mysql->prepare("SELECT wl.artikel_id, p.NAME, p.IMAGE, p.BRUTTO FROM wishlist wl INNER JOIN produkte p ON wl.artikel_id = p.ID WHERE wl.user_id = :id");
              $stmt_wish->execute(array(":id" => $_SESSION["userID"]));
              for ($i = 0; $i < $stmt_wish->rowCount(); $i++) {
                $row = $stmt_wish->fetch();
                $format = '
                  <tr class="align-middle">
                    <td>
                      <img class="image-fluid wl-img" src="./res/img/Artikelbilder/@image" />
                    </td>
                    <td class="text-start">
                      <div class="fs-5">@name</div>
                      <a class="text-muted" href="index.php?site=artikel&id=@id">Details</a>
                    </td>
                    <td>@price,00€</td>
                    <td><a class="btn btn-primary btn-sm" href="index.php?site=chart-add&pid=@id">Hinzufügen</a></td>
                    <td><a class="btn btn-danger btn-sm" href="index.php?site=wishlist-delete&pid=@id">Entfernen</a></td>
                  </tr>
                  ';
                  echo strtr($format, [
                    "@image" => $row["IMAGE"],
                    "@name" => $row["NAME"],
                    "@price" => $row["BRUTTO"],
                    "@id" => $row["artikel_id"],
                  ]);
              }
            }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>