<!-- billing -->
<div id="Billing" class="content">

  <section class="section row">
    <div class="col-2 mt-2">
      <div class="pagetitle">
        <h1>Facturatie</h1>
      </div><!-- End Page Title -->
      <!--filter-->
      <div class="filter mb-3">
        <input type="text" class="form-control" placeholder="filter.." onkeyup="FilterNextUlParent($(this));">
      </div>
      <!-- select list -->
      <ul class="list-group userlist-scroll card">
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
    </div><!--end select list-->

    <div class="col-10 row billing-field">
      <!--menu-->
      <div class="col-10 row card-body card billing-menu">
        <div class="col-10 row mb-3 mt-4">
          <div class="col-md-2">
            <label class="form-label">van</label>
            <input type="date" class="form-control">
          </div>
          <div class="col-md-2">
            <label class="form-label">tot</label>
            <input type="date" class="form-control">
          </div>
          <div class="filter col-md-3 mb-3">
            <input type="text" class="form-control billing-search" placeholder="zoeken.." onkeyup="FilterNextUlParent($(this));">
          </div>
        </div>
        <hr>
        <div class="col-10 row">
          <div class="col-2"><button class="btn btn-primary">Maak factuur</button></div>
          <div class="col-2"><button class="btn btn-primary">pro foma</button></div>
        </div>
      </div><!--end menu-->
      <!--table-->
      <div class="col-10 row card-body card">
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
      </div><!--end table-->
    </div>
  </section>

</div><!-- End billing -->