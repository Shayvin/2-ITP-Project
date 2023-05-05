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
              <button type="button" class="btn btn-primary float-end">Bezahlen</button>
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
      </div> 
</div>