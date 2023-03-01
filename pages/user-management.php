<!-- user management -->
<div id="UserManagement" class="content">

  <div class="pagetitle">
    <h1>Gebruiker beheer</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <!-- select user list -->
      <div class="col-2 mt-4 list-scroll card-body card">
        <div class="card">
          <ul class="list-group">
            <li class="list-group-item active" aria-current="true">An active item</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item disabled">A fifth item</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item disabled">A fifth item</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item disabled">A fifth item</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item disabled">A fifth item</li>
          </ul>
        </div>
      </div>

      <!-- edit user form-->
      <div class="col-10 mt-4 card-body card">

        <div class="row">
          <div class="col-9">
            <h5 class="user-management-title">Bekijk / wijzig gebruikers</h5>
          </div>
          <div class="col-3">
            <button class="btn btn-primary float-right"><i class="bi bi-plus"></i> nieuwe gebruiker</button>
          </div>
        </div>

        <!-- Form -->
        <form class="row col-12 g-3 user-management-form">
          <div class="col-md-4">
            <label for="inputName5" class="form-label">Voornaam</label>
            <input type="text" class="form-control" id="inputName5">
          </div>
          <div class="col-md-4">
            <label for="inputName5" class="form-label">Tussenvoegsels</label>
            <input type="text" class="form-control" id="inputName5">
          </div>
          <div class="col-md-4">
            <label for="inputName5" class="form-label">Achternaam</label>
            <input type="text" class="form-control" id="inputName5">
          </div>
          <div class="col-md-6">
            <label for="inputEmail5" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail5">
          </div>
          <div class="col-md-6">
            <label for="inputPassword5" class="form-label">wachtwoord</label>
            <input type="password" class="form-control" id="inputPassword5">
          </div>
          <div class="col-md-4">
            <label for="inputState" class="form-label">Rechten</label>
            <select id="inputState" class="form-select">
              <option selected>Choose...</option>
              <option>...</option>
            </select>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Opslaan</button>
          </div>
        </form><!-- End Multi Columns Form -->
      </div>

    </div>
  </section>

</div><!-- End user management -->