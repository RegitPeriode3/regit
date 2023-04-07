<!-- client management -->
<div id="ClientManagement" class="content">

  <div class="pagetitle">
    <h1>Klantbeheer</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="col-12 row">
      <!-- select client list -->
      <div class="col-2 mt-2">
        <!--filter-->
        <div class="filter mb-3">
          <input type="text" class="form-control" placeholder="filter.." onkeyup="FilterNextUlParent($(this));">
        </div>
        <ul class="list-group clientlist-scroll card mb-3" id="CompanyManageList">

        </ul>
        <!--new client-->
        <div class="col-12">
          <button type="button" data-bs-toggle="modal" data-bs-target="#newClientModal" class="btn btn-primary client-btn"><i class="bi bi-plus"></i> nieuwe klant</button>
        </div><!--end new client-->
      </div>

      <!-- new client Modal -->
      <div class="modal fade" id="newClientModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <span class="modal-title new-user-title">Nieuwe klant</span>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
              <!-- Form -->
              <form id="newCompanyForm" class="row col-12 g-3">
                <div class="col-md-6">
                  <label class="form-label">bedrijfsnaam</label>
                  <input type="text" id="NewCompanyName" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">tel nr.</label>
                  <input type="text" id="NewCompanyPhoneNr" class="form-control">
                </div>
                <hr>
                <div class="col-md-6">
                  <label class="form-label">Land</label>
                  <input type="text" id="NewCompanyCountry" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Plaats</label>
                  <input type="text" id="NewCompanyLocation" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Adres</label>
                  <input type="text" id="NewCompanyAddress" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Postcode</label>
                  <input type="text" id="NewCompanyZipcode" class="form-control">
                </div>
                <hr>
                <div class="col-md-6">
                  <label class="form-label">factuur adress</label>
                  <textarea class="form-control" id="NewCompanyInvoiceAdress" rows="2"></textarea>
                </div>
              </form><!-- End Form -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuleer</button>
              <button type="button" id="btnCreateCompany" class="btn btn-primary" onclick="CreateCompany();" data-bs-dismiss="modal">invoeren</button>
            </div>
          </div>
        </div>
      </div><!-- End new client Modal-->

      <!--client tabs-->
      <div class="col-10 client-field-right">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="algemeen-tab" data-bs-toggle="tab" data-bs-target="#algemeen" type="button" role="tab" aria-controls="algemeen" aria-selected="true">bedrijfs gegevens</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="facturatie-tab" data-bs-toggle="tab" data-bs-target="#facturatie" type="button" role="tab" aria-controls="contact" aria-selected="false">facturatie</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="projecten-tab" data-bs-toggle="tab" data-bs-target="#projecten" type="button" role="tab" aria-controls="projecten" aria-selected="false">projecten</button>
          </li>
        </ul>

        <div class="tab-content pt-2 field-client-data" id="myTabContent">
          <div class="tab-pane fade show active card-body card row client-algemeen" id="algemeen" role="tabpanel" aria-labelledby="algemeen-tab">
            <div class="pagetitle client-titles">
              <h5 class="client-management-title mt-3">bedrijfs gegevens</h5>
            </div><!-- End Page Title -->
            <!-- Form -->
            <form id="client-form" class="row col-12 g-3 client-form">
              <div class="col-md-5">
                <label class="form-label">bedrijfsnaam</label>
                <input type="text" name="name" id="CompanyName" class="form-control">
              </div>
              <div class="col-md-4">
                <label class="form-label">tel nr.</label>
                <input type="text" name="phoneNr" id="phoneNr" class="form-control">
              </div>
              <div class="col-md-3">
                <div class="form-check form-check-inline user-actief-label">
                  <input class="form-check-input" type="checkbox" id="CompanyActive">
                  <label class="form-check-label">actief</label>
                </div>
              </div>
              <hr>
              <div class="col-md-6">
                <label class="form-label">Land</label>
                <input type="text" name="country" id="CustomerCountry" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Plaats</label>
                <input type="text" name="location" id="CustomerLocation" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Adres</label>
                <input type="text" name="address" id="CustomerAddress" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Postcode</label>
                <input type="text" name="zipcode" id="CustomerZipcode" class="form-control">
              </div>
              <hr>
              <div class="col-md-6">
                <label class="form-label">factuur adress</label>
                <textarea class="form-control" name="invoiceAdress" id="CustomerInvoiceAdress" rows="2"></textarea>
              </div>
              <hr>
              <div class="col-12 row">
                <div class="col-6 mb-3">
                  <button type="button" id="UpdateCustomerBtn" onclick="UpdateCompany();" class="btn btn-primary float-right">Aanpassingen opslaan</button>
                </div>
                <div class="col-6">
                  <button type="button" id="DeleteCustomerBtn" onclick="deleteCompany();" class="btn btn-danger float-left">Geslecteerde klant verwijderen</button>
                </div>
              </div>
            </form><!-- End Form -->
          </div><!--end panel algemeen-->

          <!--panel facturatie-->
          <div class="tab-pane fade card-body card row invoice-panel" id="facturatie" role="tabpanel" aria-labelledby="facturatie-tab">
            <div class="pagetitle client-titles">
              <h5 class="client-management-title mt-3">facturatie</h5>
            </div><!-- End Page Title -->
            <div class="row col-12 g-3 client-form">
              <!--invoice list-->
              <div class="col-3">
                <!--filter-->
                <div class="filter mb-3">
                  <input type="text" class="form-control" placeholder="filter.." onkeyup="FilterNextUlParent($(this));">
                </div>
                <ul class="list-group activity-scroll card" id="InvoiceList">
=
                </ul>
              </div>
              <!--end invoice list-->

              <div class="col-9 client-invoice">
                <iframe class="invoice-iframe" id="invoicePdf"></iframe>
              </div>

            </div>
          </div><!--end panel facturatie-->


          <!--panel project-->
          <div class="tab-pane fade" id="projecten" role="tabpanel" aria-labelledby="projecten-tab">
            <div class="col-12 row mt-4 settings-white-card">

              <!--activity list-->
              <div class="col-3">
                <!--filter-->
                <div class="filter mb-3">
                  <input type="text" class="form-control" placeholder="filter.." onkeyup="FilterNextUlParent($(this));">
                </div>
                <ul class="list-group activity-scroll card">
                  <li class="list-group-item">A second item</li>
                  <li class="list-group-item">A third item</li>
                  <li class="list-group-item">A fourth item</li>
                  <li class="list-group-item disabled">A fifth item</li>
                </ul>
              </div>
              <!--end activity list-->

              <!-- activity form -->
              <div class="col-9">

                <div class="row mt-3">
                  <div class="col-8">
                    <h5 class="user-management-title">Projecten toevoegen / aanpassen</h5>
                  </div>
                  <div class="col-4">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#projectModal" class="btn btn-primary float-right"><i class="bi bi-plus"></i> nieuw project</button>
                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="projectModal" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <span class="modal-title new-user-title">Nieuw project</span>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                          <div class="col-md-6">
                            <label class="form-label">project naam</label>
                            <input type="text" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">omschrijving</label>
                            <input type="text" class="form-control">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuleer</button>
                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">invoeren</button>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Modal-->

                </div>

                <!-- Form -->
                <form id="changeUserForm" class="row col-12 g-3 user-management-form">
                  <div class="col-md-6">
                    <label class="form-label">project naam</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">omschrijving</label>
                    <input type="text" class="form-control">
                  </div>
                  <hr class="mt-5 mb-4">
                  <div class="col-12 row">
                    <div class="col-5">
                      <button type="submit" class="btn btn-primary float-right">Aanpassingen opslaan</button>
                    </div>
                    <div class="col-7">
                      <button type="submit" class="btn btn-danger float-left">Geslecteerd project verwijderen</button>
                    </div>
                  </div>
                </form><!-- End activity Form -->
              </div>

            </div>
          </div><!--end panel projecten-->
        </div>
      </div><!-- End Tabs -->
    </div>

  </section>

</div><!-- End client management -->