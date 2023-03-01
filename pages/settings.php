<!-- settings -->
<div id="Settings" class="content">

  <div class="pagetitle">
    <h1>Instellingen</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <!-- Tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#email" type="button" role="tab" aria-controls="home" aria-selected="true">Email instellingen</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#activiteit" type="button" role="tab" aria-controls="profile" aria-selected="false">Activiteiten</button>
      </li>
    </ul>

    <div class="tab-content pt-2" id="myTabContent">

      <!--email-->
      <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="home-tab">
        <div class="col-12 row card card-body mt-4 instellingen-card">
        <h5 class="user-management-title mt-3">Email instellingen</h5>
          <!-- Form -->
          <form class="row col-12 g-3 user-management-form">

            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="text" class="form-control">
            </div>
            <div class="col-md-4">
              <label class="form-label">blank</label>
              <select class="form-select">
                <option selected>Choose...</option>
                <option>...</option>
              </select>
            </div>
            <div class="col-md-6">
              <div class="form-check mt-2 mb-2">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Default checkbox
                </label>
              </div>
            </div>

            <hr>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary">Aanpassingen opslaan</button>
            </div>
          </form><!-- End activity Form -->
        </div>
      </div>
      <!--end email-->



      <!--activity-->
      <div class="tab-pane fade" id="activiteit" role="tabpanel" aria-labelledby="profile-tab">
        <div class="col-12 row mt-4 instellingen-activity-card">

          <!--activity list-->
          <div class="col-4">
            <!--filter-->
            <div class="filter mb-3">
              <input type="text" class="form-control" placeholder="filter.." onkeyup="FilterNextUlParent($(this));">
            </div>
            <ul class="list-group activity-scroll card">
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
          <!--end activity list-->

          <!-- activity form -->
          <div class="col-8">

            <div class="row mt-3">
              <div class="col-8">
                <h5 class="user-management-title">Activiteiten toevoegen / aanpassen</h5>
              </div>
              <div class="col-4">
                <button type="button" data-bs-toggle="modal" data-bs-target="#activityModal" class="btn btn-primary float-right"><i class="bi bi-plus"></i> nieuwe activiteit</button>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="activityModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Nieuwe activiteit</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                      <div class="col-md-6">
                        <label class="form-label">activiteit naam</label>
                        <input type="text" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">omschrijving</label>
                        <input type="text" class="form-control">
                      </div>
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
              <div class="col-md-6">
                <label class="form-label">activiteit naam</label>
                <input type="text" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">omschrijving</label>
                <input type="text" class="form-control">
              </div>
              <hr>
              <div class="col-12 row">
                <div class="col-5">
                  <button type="submit" class="btn btn-primary float-right">Aanpassingen opslaan</button>
                </div>
                <div class="col-7">
                  <button type="submit" class="btn btn-danger float-left">Geslecteerde activiteit verwijderen</button>
                </div>
              </div>
            </form><!-- End activity Form -->
          </div>


        </div>
      </div>
      <!--end activity-->
    </div>
  </section>

</div><!-- settings -->