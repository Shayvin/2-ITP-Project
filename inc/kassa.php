<div class="container-fluid mt-5">
  <div class="row">
    <div class="col-1">
    </div>
    <div class="col-sm-6 d-flex flex-column">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h1>Warenkorb</h1>
<<<<<<< Updated upstream
      </div>
          <ul class="list-group list-group-flush mb-3">
            <li class="list-group-item py-3 border-bottom border-top">
              <div class="row align-items-center">
                <div class="col-3 col-md-2 text-center"><img class="img-fluid" src="./res/img/default.jpg" /></div>
                <div class="col-4 col-md-7">
                  <h5>Item #1</h5>
                  <div class="text-muted">Item details ...</div>
                </div>
                <div class="col-3 col-md-2">
                  <div class="input-group">
                    <div class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></div>
                    <input class="form-control form-control-sm" type="number" min="1" value="1" name="amount">
                  </div>
                </div>
                <div class="col-2 col-md-1"><span>12,50€</span></div>
              </div>
            </li>

            <li class="list-group-item py-3 border-bottom">
              <div class="row align-items-center">
                <div class="col-3 col-md-2 text-center"><img class="img-fluid" src="./res/img/default.jpg" /></div>
                <div class="col-4 col-md-7">
                  <h5>Item #2</h5>
                  <div class="text-muted">Item details ...</div>
                </div>
                <div class="col-3 col-md-2">
                  <div class="input-group">
                    <div class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></div>
                    <input class="form-control form-control-sm" type="number" min="1" value="1" name="amount">
                  </div>
                </div>
                <div class="col-2 col-md-1"><span>12,50€</span></div>
              </div>
            </li>
            <li class="list-group-item py-3">
            <div class="row">
              <div class="col-6 col-md-8"></div>
              <div class="col">
              </div>
      </div>   
</div>

    <div class="col-1">
    </div>
      <div class="col-3 d-flex flex-column border rounded bg-light">
        <p class="fs-3">Liefer & Rechnungsadresse</p>
        
        <p>Musterstraße 567/445</p>
        <p>1218 Linz</p>
        <hr>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
          <label class="form-check-label" for="flexRadioDefault1">
            Standard Versand (3-10 Werktage)
          </label>
        </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
            <label class="form-check-label" for="flexRadioDefault2">
            Premium Versand (1-3 Werktage)
            </label>
          </div>
          <hr>
        <p class="fs-6">Mwst(20%): 20€</p>
        <p class="fs-6">Lieferkosten: 10€</p>
        <hr>
        <p class="fs-4 fw-bold">Gesamt: 100€</p>
        <div id="btn-paypal-checkout"></div>
      </div>
</div>
<script>
    window.addEventListener("load", function () {
        var cartItems = [{
            name: "Product 1",
            description: "Description of product 1",
            quantity: 1,
            price: 50,
            sku: "prod1",
            currency: "USD"
        }, {
            name: "Product 2",
            description: "Description of product 2",
            quantity: 3,
            price: 20,
            sku: "prod2",
            currency: "USD"
        }, {
            name: "Product 3",
            description: "Description of product 3",
            quantity: 4,
            price: 10,
            sku: "prod3",
            currency: "USD"
        }];
 
        var total = 0;
        for (var a = 0; a < cartItems.length; a++) {
            total += (cartItems[a].price * cartItems[a].quantity);
        }
 
        // Render the PayPal button
        paypal.Button.render({
 
            
            env: 'sandbox', // sandbox | production
 
=======
      </div> 
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
                $mwst = 0;
                $shippingCost = 0;
                $initialSum = 0;
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
                          <a class="btn btn-outline-danger btn-sm" href="index.php?site=chart-delete&pid=@pid"><i class="bi bi-trash"></i></a>
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
                  $mwst += ($menge * $artikel["BRUTTO"]) * 0.2;
                  $initialSum += ($menge * $artikel["BRUTTO"]) + 10;
                  $sum += ($menge * $artikel["BRUTTO"]) + $shippingCost;        
                  }
                }
              }
            ?>
      </div> 
<?php
require_once("./config/dbaccess.php");
$stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :username");
$stmt->bindParam(":username", $_SESSION["username"]);
$stmt->execute();
$row = $stmt->fetch();
?>
<div class="col-1">
</div>
<div class="col-3 d-flex flex-column border rounded bg-light">
  <p class="fs-3">Liefer & Rechnungsadresse</p>
  <p><?php echo $row["ADRESSE"] ?></p>
  <p><?php echo $row["PLZ"] ?></p>
  <hr>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" id="default" value="standard" checked>
    <label class="form-check-label" for="flexRadioDefault1">
      Standard Versand (3-10 Werktage)
    </label>
  </div>
  <hr>
  <?php
  ?>
  <p class="fs-6">Mwst(20%): <?php echo $mwst ?> €</p>
  <hr>
  <p class="fs-4 fw-bold" id="totalSum">Gesamt: <?php echo $sum ?> €</p>
  <div id="btn-paypal-checkout"></div>
</div>
<?php
require("./config/dbaccess.php"); // db access

if (isset($_SESSION["username"])) { // check user login
  // get user_id
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :name");
  $stmt->execute(array(":name" => $_SESSION["username"]));
  $row = $stmt->fetch();
  $user_id = $row["ID"];

  if ($user_id) {
    $cartItems = array();

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

      $cartItems[] = array(
        "name" => $artikel["NAME"],
        "description" => $artikel["BESCHREIBUNG"],
        "quantity" => strval($menge),
        "price" => strval($artikel["BRUTTO"]),
        "currency" => "USD"
      );
    }

  }
}
?>

<script>
window.addEventListener("load", function () {
  var cartItems = <?php echo json_encode($cartItems); ?>;

var total = 0;
for (var i = 0; i < cartItems.length; i++) {
  var item = cartItems[i];
  total += parseFloat(item.price) * parseInt(item.quantity);
}

// console.log("Total:", total);

        // Render the PayPal button
        paypal.Button.render({

            env: 'sandbox', // sandbox | production

>>>>>>> Stashed changes
            style: {
                label: 'checkout',
                size: 'responsive', // small | medium | large | responsive
                shape: 'pill', // pill | rect
                color: 'blue', // gold | blue | silver | black,
                layout: 'vertical'
            },
<<<<<<< Updated upstream
 
=======

>>>>>>> Stashed changes
            client: {
                sandbox: 'AbFZ3_BhtY9LxaAJXM0QHVbfd1vLSwmQ8Y-XP-gglW8JIzfFdJpvoxNG-JZX1_AjRerNhjSz6S0lR60b',
                production: ''
            },
<<<<<<< Updated upstream
 
=======

>>>>>>> Stashed changes
            funding: {
                allowed: [
                    paypal.FUNDING.CARD,
                    paypal.FUNDING.ELV
                ]
            },
<<<<<<< Updated upstream
 
=======

>>>>>>> Stashed changes
            payment: function(data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [{
                            amount: {
<<<<<<< Updated upstream
                                total: total,
                                currency: 'USD'
                            },
                            item_list: {
                                // custom cartItems array created specifically for PayPal
                                items: cartItems
                            }
=======
                                total: total.toFixed(2),
                                currency: 'USD'
                            },
                            item_list: {
                                items: cartItems
                            },
>>>>>>> Stashed changes
                        }]
                    }
                });
            },
<<<<<<< Updated upstream
 
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    // Values from PayPal
=======

            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
>>>>>>> Stashed changes
                    console.log({
                        "intent": data.intent,
                        "orderID": data.orderID,
                        "payerID": data.payerID,
                        "paymentID": data.paymentID,
                        "paymentToken": data.paymentToken
                    });
<<<<<<< Updated upstream
 
                    paymentMade(data.orderID, data.payerID, data.paymentID, data.paymentToken);
                });
            },
             
            onCancel: function (data, actions) {
              
                console.log("failed");
            }
 
=======
                    paymentMade(data.orderID, data.payerID, data.paymentID, data.paymentToken);
                });
            },
            
            onApprove: function(data, actions) {
              window.location.href = "index.php?site=order-success";
            },
            onCancel: function (data, actions) {
              console.log("Payment cancelled");
            }

>>>>>>> Stashed changes
        }, '#btn-paypal-checkout');
    });

    function paymentMade(orderID, payerID, paymentID, paymentToken) {
<<<<<<< Updated upstream
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "./inc/paypal.php", true);
 
    ajax.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                console.log(response);
            }
 
            if (this.status == 500) {
                console.log(this.responseText);
            }
        }
    };
 
    var formData = new FormData();
    formData.append("orderID", orderID);
    formData.append("payerID", payerID);
    formData.append("paymentID", paymentID);
    formData.append("paymentToken", paymentToken);
    ajax.send(formData);
}
</script>
=======
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "./inc/paypal.php", true);

        ajax.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    console.log(response);
                } else if (this.status == 500) {
                    console.log(this.responseText);
                }
            }
        };
        var formData = new FormData();
        formData.append("orderID", orderID);
        formData.append("payerID", payerID);
        formData.append("paymentID", paymentID);
        formData.append("paymentToken", paymentToken);
        ajax.send(formData);
    }
    function saveOrder(orderID, payerID, paymentID, paymentToken) {
      var ajax = new XMLHttpRequest();
      ajax.open("POST", "./inc/order-save.php", true);

      var formData = new FormData();
      formData.append("orderID", orderID);
      formData.append("payerID", payerID);
      formData.append("paymentID", paymentID);
      formData.append("paymentToken", paymentToken);

      ajax.onreadystatechange = function () {
        if (this.readyState == 4) {
          if (this.status == 200) {
            var response = JSON.parse(this.responseText);
            console.log(response);
          } else if (this.status == 500) {
            console.log(this.responseText);
          }
        }
      };

      ajax.send(formData);
    }
</script>
>>>>>>> Stashed changes
