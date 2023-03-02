<!-- user management -->
<div id="UserManagement" class="content">

  <div class="pagetitle">
    <h1>Gebruiker beheer</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <!-- select user list -->
      <div class="col-3 user-list mt-2">
        <!--filter-->
        <div class="filter mb-3">
          <input type="text" class="form-control" placeholder="filter.." onkeyup="FilterNextUlParent($(this));">
        </div>

        <ul class="list-group clientlist-scroll" id="UserManageList">

        </ul>
        <div class="col-12">
          <button type="button" data-bs-toggle="modal" data-bs-target="#newUserModal" class="btn btn-primary client-btn"><i class="bi bi-plus"></i> nieuwe gebruiker</button>
        </div>
      </div>

      <!-- user form -->
      <div class="col-8 mt-2 user-card card">

        <div class="row mt-3">
          <div class="col-9">
            <h5 class="user-management-title">Bekijk / wijzig gebruikers</h5>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="newUserModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Nieuwe gebruiker</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                  <!-- Form -->
                  <form class="row col-12 g-3">
                    <div class="col-md-4">
                      <label class="form-label">Voornaam</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Tussenvoegsels</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Achternaam</label>
                      <input type="text" class="form-control">
                    </div>

                    <hr>

                    <div class="col-md-6">
                      <label class="form-label">weergavennaam</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Rechten</label>
                      <select class="form-select">
                        <option selected>Choose...</option>
                        <option>...</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">gebruikersnaam</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">wachtwoord</label>
                      <input type="password" class="form-control">
                    </div>

                    <hr>
                    <div class="col-md-6">
                      <label class="form-label">E-mail adres</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Telefoon nummer</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Land</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="col-md-5">
                      <label class="form-label">Adress</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Postcode</label>
                      <input type="text" class="form-control">
                    </div>

                  </form><!-- End Form -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuleer</button>
                  <button type="button" class="btn btn-primary">invoeren</button>
                </div>
              </div>
            </div>
          </div><!-- End Modal-->
        </div>

        <!-- Form -->
        <form class="row col-12 g-3 user-management-form">
          <div class="col-md-4">
            <label class="form-label">Voornaam</label>
            <input type="text" name="displayName" class="form-control">
          </div>
          <div class="col-md-4">
            <label class="form-label">Tussenvoegsels</label>
            <input type="text" name="" class="form-control">
          </div>
          <div class="col-md-4">
            <label class="form-label">Achternaam</label>
            <input type="text" name="" class="form-control">
          </div>

          <hr>

          <div class="col-md-6">
            <label class="form-label">weergavennaam</label>
            <input type="text" name="displayName" class="form-control">
          </div>
          <div class="col-md-4">
            <label class="form-label">Rechten</label>
            <select class="form-select">
              <option selected>Choose...</option>
              <option>...</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">gebruikersnaam</label>
            <input type="text" name="userName" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">wachtwoord</label>
            <input type="password" name="password" class="form-control">
          </div>

          <hr>
          <div class="col-md-6">
            <label class="form-label">E-mail adres</label>
            <input type="text" name="email" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Telefoon nummer</label>
            <input type="text" name="phoneNr" class="form-control">
          </div>
          <div class="col-md-4">
            <label class="form-label">Land</label>
            <input type="text" name="country" class="form-control">
          </div>
          <div class="col-md-5">
            <label class="form-label">Adress</label>
            <input type="text" name="address" class="form-control">
          </div>
          <div class="col-md-3">
            <label class="form-label">Postcode</label>
            <input type="text" name="zipcode" class="form-control">
          </div>
          <hr>
          <div class="col-12 row">
            <div class="col-6 mb-3">
              <button type="button" id="SaveUserChanges" onclick="EditUser();" class="btn btn-primary float-right">Aanpassingen opslaan</button>
            </div>
            <div class="col-6">
              <button type="button" class="btn btn-danger float-left">Geslecteerde gebruiker verwijderen</button>
            </div>
          </div>
        </form><!-- End Form -->
      </div>

    </div>
  </section>

</div><!-- End user management -->