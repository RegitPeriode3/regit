
$(document).ready(function () {
    $('#UserManagementNav').on('click', GetUsers);
    $("#UserManageList").on("click", ' li', toggleUserList);
    $("#btnNewUser").on("click", getLastUserData);
    $("#UpdateCustomerBtn").on("click", getLastUserData);


});

var selectedUserId;

function GetUsers() {

    axios.get('http://localhost/regit/public/user/')
        .then(function (response) {
            console.log(response.data);
            var UserItem = response.data;
            //var UserItem = JSON.parse(response.data);

            $('#UserManageList').empty();
            var list = $('#UserManageList');
            $.each(UserItem, function (k, v) {
                var entry = document.createElement('li');
                entry.className = 'list-group-item';
                entry.innerHTML = v['displayName'];
                entry.id = v['id'];
                list.append(entry);
                $('#UserManageList li').last().data(v);
                //console.log($('#opdrachtgeverLijstGegevens li'));
            })
            list.data(UserItem);
        })
        .catch(function (error) {
            console.log(error)
        });
}

function toggleUserList() {
    $("#UserManageList li").removeClass("active");
    $(this).addClass("active");
    // selectedUserId = $(this).data()['Id'];
    // //console.log($(this))
    showUserInfo($(this));
}

function showUserInfo($el) {
    //console.log($el);
    var userInfo = $el.data();
    selectedUserId = userInfo.id;

    $.each(userInfo, function (k, v) {
        $("input[name=" + k + "]").val(v);
        $("textarea[name=" + k + "]").val(v);


        //fill user clearance select
        let select = document.querySelector('#UserClearance');
        if (userInfo.clearence) {
            select.value = userInfo.clearence;
        } else {
            select.value = 1;
        }

        //checkbox op wel / niet actief zetten
        if (userInfo['active'] == true) {
            $('#userActive').prop('checked', true);
        } else {
            $('#userActive').prop('checked', false);
        }
    });
}

function CreateUser() {

    var userNew = axios({
        method: 'post',
        url: 'http://localhost/regit/public/user/Create',
        headers: {},
        data: {
            displayName: $('#NewUserDisplayname').val(),
            UserName: $('#NewUserUsername').val(),
            password: $('#NewUserPassword').val(),
            // email: $('#NewUserMail').val(),
            // phoneNr: $('#NewUserPhoneNr').val(),
            // country: $('#NewUserCountry').val(),
            // location: $('#NewUserLocation').val(),
            // zipcode: $('#NewUserZipcode').val(),
            // address: $('#NewUserAddress').val(),
            clearence: $('#NewUserClearance').val()
        },
    });

    clearForms();
    $('#UserClearance').prop('selectedIndex',0);
    $('#userActive').prop('selectedIndex',0);

    console.log(userNew);
    alert("De nieuwe gebruiker is opgeslagen");
    GetUsers();
}


function DeleteUser() {

    if (selectedUserId == null) {
        alert("er is geen gebruiker geselecteerd");
    } else {
        var userDelete = axios({
            method: 'put',
            url: 'http://localhost/regit/public/user/Delete',
            headers: {},
            data: {
                id: selectedUserId
            },
        });

        clearForms();
        console.log(userDelete);
        alert("De gebruiker is verwijderd");
        GetUsers();
    }
}

function UpdateUser() {

    if ($('#userActive').is(":checked")) {
        activeCheck = 1;
    } else {
        activeCheck = 0;
    }

    if (selectedUserId == null) {
        alert("er is geen gebruiker geselecteerd");
    } else {
        var userUpdate = axios({
            method: 'put',
            url: 'http://localhost/regit/public/user/Update',
            headers: {},
            data: {
                id: selectedUserId,
                DisplayName: $('#UserDisplayName').val(),
                UserName: $('#UserUsername').val(),
                Password: $('#UserPassword').val(),
                // Email: $('#UserMail').val(),
                // PhoneNr: $('#UserPhoneNr').val(),
                // Country: $('#UserCountry').val(),
                // Location: $('#UserLocation').val(),
                // Zipcode: $('#UserZipcode').val(),
                // Address: $('#UserAddress').val(),
                clearence: $('#UserClearance').val(),
                active: activeCheck
            },
        });
        console.log(userUpdate);
        alert("De gebruiker gegevens zijn gewijzigd");
        GetUsers();
    }
}

function clearForms()
{
    $("#client-form")[0].reset();
    $("#newCompanyForm")[0].reset();
    $("#changeUserForm")[0].reset();
    $("#newUserForm")[0].reset();
    $("#userForm")[0].reset();

}


function getLastUserData() {
    axios.get('http://localhost/regit/public/user/lastUser')
        .then(function (response) {
            var lastCompanyData = response.data;
            console.log(lastCompanyData)
            $("#UserManageList li").removeClass("active");
            $('#UserManageList li').last().addClass("active");

            selectedUserData = $('#UserManageList li').last().data();

            $.each(selectedUserData, function (k, v) {
                $("input[name=" + k + "]").val(v);
            });
        })
        .catch(function (error) {
            //$.alert('error');
            console.log(error)
        });

}