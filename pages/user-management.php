<!-- user management -->
<div id="UserManagement" class="content">

    <div class="pagetitle">
        <h1 class="responsive-title">Gebruikerbeheer</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <!-- select user list -->
            <div class="col-2 user-list mt-2 width-100-resp">
                <!--filter-->
                <div class="filter mb-3">
                    <input type="text" class="form-control" placeholder="filter.." onkeyup="FilterNextUlParent($(this));">
                </div>

                <ul class="list-group clientlist-scroll" id="UserManageList">

                </ul>
                <div class="col-12 mt-3">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#newUserModal" class="btn btn-primary client-btn"><i class="bi bi-plus"></i> nieuwe gebruiker</button>
                </div>
            </div>

            <!-- user form -->
            <div class="col-8 mt-2 user-card card user-right max-height-user width-100-resp">

                <div class="row mt-3">
                    <div class="col-9 mb-4">
                        <h5 class="user-management-title">Bekijk / wijzig gebruikers</h5>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="newUserModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="modal-title new-user-title">Nieuwe gebruiker</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <!-- Form -->
                                    <form id="newUserForm" class="row col-12 g-3">

                                        <div class="col-md-6">
                                            <label class="form-label">weergavennaam</label>
                                            <input type="text" id="NewUserDisplayname" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Rechten</label>
                                            <select class="form-select" id="NewUserClearance">
                                                <option value="1">Gebruiker</option>
                                                <option value="2">Admin</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">gebruikersnaam</label>
                                            <input type="text" id="NewUserUsername" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">wachtwoord</label>
                                            <input type="password" id="NewUserPassword" class="form-control">
                                        </div>

                                        <!-- <hr>
                                        <div class="col-md-6">
                                          <label class="form-label">E-mail adres</label>
                                          <input type="text" id="NewUserMail" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                          <label class="form-label">Telefoon nummer</label>
                                          <input type="text" id="NewUserPhoneNr" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                          <label class="form-label">Land</label>
                                          <input type="text" id="NewUserCountry" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                          <label class="form-label">Plaats</label>
                                          <input type="text" id="NewUserLocation" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                          <label class="form-label">Adres</label>
                                          <input type="text" id="NewUserAddress" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                          <label class="form-label">Postcode</label>
                                          <input type="text" id="NewUserZipcode" class="form-control">
                                        </div> -->

                                    </form><!-- End Form -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuleer</button>
                                    <button type="button" id="btnNewUser" class="btn btn-primary" onclick="CreateUser();" data-bs-dismiss="modal">invoeren</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Modal-->
                </div>

                <!-- Form -->
                <form id="userForm" class="row col-12 g-3 user-management-form">

                    <div class="col-md-6">
                        <label class="form-label">weergavennaam</label>
                        <input type="text" name="displayName" id="UserDisplayName" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Rechten</label>
                        <select class="form-select" name="clearence" id="UserClearance">
                            <option value="1">Gebruiker</option>
                            <option value="2">Admin</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-check-inline user-actief-label">
                            <input class="form-check-input" type="checkbox" id="userActive">
                            <label class="form-check-label">actief</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">gebruikersnaam</label>
                        <input type="text" name="userName" id="UserUsername" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">wachtwoord</label>
                        <input type="password" name="password" id="UserPassword" class="form-control">
                    </div>

                    <!-- <hr> -->
                    <!-- <div class="col-md-6">
                      <label class="form-label">E-mail adres</label>
                      <input type="text" name="email" id="UserMail" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Telefoon nummer</label>
                      <input type="text" name="phoneNr" id="UserPhoneNr" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Land</label>
                      <input type="text" name="country" id="UserCountry" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Plaats</label>
                      <input type="text" name="location" id="UserLocation" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Adress</label>
                      <input type="text" name="address" id="UserAddress" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Postcode</label>
                      <input type="text" name="zipcode" id="UserZipcode" class="form-control">
                    </div> -->
                    <hr>
                    <div class="col-12 row mt-1 mb-2">
                        <div class="col-6 mb-3">
                            <button type="button" id="SaveUserChanges" onclick="UpdateUser();" class="btn btn-primary float-right">aanpassingen opslaan</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-danger float-left" onclick="DeleteUser();">gebruiker verwijderen</button>
                        </div>
                    </div>
                </form><!-- End Form -->
            </div>

        </div>
    </section>

</div><!-- End user management -->