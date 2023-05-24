<div class="container-fluid mt-5">
  <div class="row">
  <div class="col-1">
</div>
    <div class="col-sm-6 d-flex flex-column">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h1>Warenkorb</h1>
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
 
            style: {
                label: 'checkout',
                size: 'responsive', // small | medium | large | responsive
                shape: 'pill', // pill | rect
                color: 'blue', // gold | blue | silver | black,
                layout: 'vertical'
            },
 
            client: {
                sandbox: 'AbFZ3_BhtY9LxaAJXM0QHVbfd1vLSwmQ8Y-XP-gglW8JIzfFdJpvoxNG-JZX1_AjRerNhjSz6S0lR60b',
                production: ''
            },
 
            funding: {
                allowed: [
                    paypal.FUNDING.CARD,
                    paypal.FUNDING.ELV
                ]
            },
 
            payment: function(data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [{
                            amount: {
                                total: total,
                                currency: 'USD'
                            },
                            item_list: {
                                // custom cartItems array created specifically for PayPal
                                items: cartItems
                            }
                        }]
                    }
                });
            },
 
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    // Values from PayPal
                    console.log({
                        "intent": data.intent,
                        "orderID": data.orderID,
                        "payerID": data.payerID,
                        "paymentID": data.paymentID,
                        "paymentToken": data.paymentToken
                    });
 
                    paymentMade(data.orderID, data.payerID, data.paymentID, data.paymentToken);
                });
            },
             
            onCancel: function (data, actions) {
              
                console.log("failed");
            }
 
        }, '#btn-paypal-checkout');
    });

    function paymentMade(orderID, payerID, paymentID, paymentToken) {
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
