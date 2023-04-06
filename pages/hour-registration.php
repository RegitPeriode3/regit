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

            <form id="hourRegForm" class="row g-3">
              <div class="col-md-12">
                <label class="form-label">Datum</label>
                <input type="date" id="hourRegDate" value='<?php echo date("Y-m-d"); ?>' class="form-control">
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
                <select class="form-select" id="hourRegActivity" aria-label="Default select example">
                  <option selected>-</option>
                  <option value="1">-</option>
                  <option value="2">-</option>
                  <option value="3">-</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label">Omschrijving</label>
                <textarea class="form-control" id="hourDescription"></textarea>
              </div>

              <div class="text-center">
                <button type="button" class="btn btn-primary" onclick="registerHour()">Opslaan</button>
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

            <table role="table" class="table table-striped" id="tblInvoiceRow">
              <thead role="rowgroup">
                <tr role="row">
                  <th role="columnheader" scope="col">Factuurnummer</th>
                  <th role="columnheader" scope="col">Datum</th>
                  <th role="columnheader" scope="col">Aantal uren</th>
                  <th role="columnheader" scope="col">Project</th>
                  <th role="columnheader" scope="col">Activiteit</th>
                  <th role="columnheader" scope="col">Omschrijving</th>
                  <th role="columnheader" scope="col">Verwijder</th>
                </tr>
              </thead>
              <tbody role="rowgroup">

              </tbody>
            </table>

          </div>
        </div>
      </div><!-- End table -->

      <style>
        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {

          .table>:not(caption)>*>* {
            padding: 4%;
            min-height: 40px;
          }

          td {
            padding-left: 50% !important;
          }

          table,
          thead,
          tbody,
          th,
          td,
          tr {
            display: block;
          }

          /* Hide table headers (but not display: none;, for accessibility) */
          thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
          }

          tr {
            margin: 0 0 1rem 0;
          }

          tr:nth-child(odd) {
            background: #ccc;
          }

          td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
          }

          td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 0;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
          }

          /* Label the data */
          td:nth-of-type(1):before {
            content: "Factuurnummer";
            padding-top: 3%;
          }

          td:nth-of-type(2):before {
            content: "Datum";
            padding-top: 3%;
          }

          td:nth-of-type(3):before {
            content: "Aantal uren";
            padding-top: 3%;
          }

          td:nth-of-type(4):before {
            content: "Project";
            padding-top: 3%;
          }

          td:nth-of-type(5):before {
            content: "Activiteit";
            padding-top: 3%;
          }

          td:nth-of-type(6):before {
            content: "Omschrijving";
            padding-top: 3%;
          }

          td:nth-of-type(7):before {
            content: "Verwijder";
            padding-top: 3%;
          }

        }
      </style>

    </div>
  </section>

</div><!-- End hour registration -->