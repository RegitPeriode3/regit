<!DOCTYPE html>

<body>

  <main style="background-image: url(assets/img/pexels-lukas-317355.jpg); background-size: cover; background-repeat: no-repeat;">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-7 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="d-flex justify-content-center py-4">
                    <a class="logo d-flex align-items-center w-auto">
                      <span class="d-lg-block">Regit</span>
                    </a>
                  </div>

                    <p class="text-center">Login op uw account.</p>

                  <hr>

                  <form class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Gebruikersnaam</label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Wachtwoord</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <hr class="mt-4 mb-4">

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>

                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

  </main>

</body>

</html>