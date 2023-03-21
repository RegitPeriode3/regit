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
              <form class="row col-12 g-3">
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
              <button type="button" class="btn btn-primary" onclick="CreateCompany();" data-bs-dismiss="modal">invoeren</button>
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
            <form class="row col-12 g-3 client-form">
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
          <div class="tab-pane fade card-body card row" id="facturatie" role="tabpanel" aria-labelledby="facturatie-tab">
            <div class="pagetitle client-titles">
              <h5 class="client-management-title mt-3">facturatie</h5>
            </div><!-- End Page Title -->
            <!-- Form -->
            <form class="row col-12 g-3 client-form">

              <div class="col-md-6">
                <label class="form-label">factuur adress</label>
                <textarea class="form-control" rows="2"></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">btw nummer</label>
                <input type="text" class="form-control">
              </div>
              <hr>
              <div class="col-md-6">
                <label class="form-label">bedrijfsnaam</label>
                <input type="text" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">plaats</label>
                <input type="text" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">TAV</label>
                <input type="text" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">land</label>
                <input type="text" class="form-control">
              </div>

              <hr>

              <div class="col-md-6">
                <label class="form-label">Adres</label>
                <input type="text" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Emailadres</label>
                <input type="text" class="form-control">
              </div>

              <hr>
              <div class="col-12 row">
                <div class="col-6 mb-3">
                  <button type="submit" class="btn btn-primary float-right">Aanpassingen opslaan</button>
                </div>
                <div class="col-6">
                  <button type="button" class="btn btn-danger float-left">Geslecteerde klant verwijderen</button>
                </div>
              </div>
            </form><!-- End Form -->
          </div><!--end panel facturatie-->

          <!--panel projecten-->
          <div class="tab-pane fade card-body card row" id="projecten" role="tabpanel" aria-labelledby="projecten-tab">
            <div class="pagetitle client-titles">
              <h5 class="client-management-title mt-3">projecten</h5>
            </div><!-- End Page Title -->

            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Datum</th>
                  <th scope="col">Van</th>
                  <th scope="col">Tot</th>
                  <th scope="col">Aantal uren</th>
                  <th scope="col">Project</th>
                  <th scope="col">Activiteit</th>
                  <th scope="col">Omschrijving</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>2-19-2023</td>
                  <td>8:00</td>
                  <td>14:00</td>
                  <td>6</td>
                  <td> - </td>
                  <td> - </td>
                  <td> - </td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>2-19-2023</td>
                  <td>8:00</td>
                  <td>14:00</td>
                  <td>6</td>
                  <td> - </td>
                  <td> - </td>
                  <td> - </td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>2-19-2023</td>
                  <td>8:00</td>
                  <td>14:00</td>
                  <td>6</td>
                  <td> - </td>
                  <td> - </td>
                  <td> - </td>
                </tr>

              </tbody>
            </table>

            <hr>

            <div class="col-12 row">
              <div class="col-6 mb-3">
                <button type="submit" class="btn btn-primary float-right">nieuw project</button>
              </div>
              <div class="col-6">
                <button type="submit" class="btn btn-danger float-left">verwijder geselecteerd project</button>
              </div>
            </div>

          </div><!--end panel projecten-->
        </div>
      </div><!-- End Tabs -->
    </div>

  </section>

</div><!-- End client management -->