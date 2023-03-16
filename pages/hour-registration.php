<!-- hour registration -->
<div id="HourRegistration" class="content">

  <div class="pagetitle">
    <h1>Uren registratie</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <!-- hour registration form -->
      <div class="col-lg-4">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Uren invoeren</h5>

            <form class="row g-3">
              <div class="col-md-12">
                <label class="form-label">Datum</label>
                <input type="date" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Van</label>
                <input type="time" class="form-control" id="WorkedFrom">
              </div>
              <div class="col-md-6">
                <label class="form-label">Tot</label>
                <input type="time" class="form-control" id="WorkedTill" onchange="HoursWorked();">
              </div>
              <div class="col-md-12">
                <label class="form-label">Totaal aantal uren: </label>
                  <label class="form-label" id="hoursAmt">0</label>
              </div>
                <div class="col-12">
                    <label class="form-label">Bedrijf</label>
                    <select class="form-select" id="hourRegCompanies" onchange="SetProjects($(this).val())" aria-label="Default select example">
                        <option selected>-</option>
                        <option value="1">-</option>
                        <option value="2">-</option>
                        <option value="3">-</option>
                    </select>
                </div>
              <div class="col-12">
                <label class="form-label">Project</label>
                <select class="form-select" id="hourRegProjects" aria-label="Default select example">
                      <option selected>-</option>
                      <option value="1">-</option>
                      <option value="2">-</option>
                      <option value="3">-</option>
                    </select>
              </div>
              <div class="col-12">
                <label class="form-label">Activiteit</label>
                  <select class="form-select" aria-label="Default select example">
                      <option selected>-</option>
                      <option value="1">-</option>
                      <option value="2">-</option>
                      <option value="3">-</option>
                  </select>
              </div>
              <div class="col-12">
                <label class="form-label">Omschrijving</label>
                <textarea class="form-control"></textarea>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Opslaan</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form>

          </div>
        </div>
      </div><!-- End hour registration form -->

      <!-- hour registration table -->
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Gemaakte uren</h5>

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

          </div>
        </div>
      </div><!-- End table -->

    </div>
  </section>

</div><!-- End hour registration -->