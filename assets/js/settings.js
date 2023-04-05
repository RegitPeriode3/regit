$(document).ready(function () {
    $('#settingsNav').on('click', GetSettings);
});

// var AdminId = $_SESSION['id'];

function GetSettings() {
    
    
    var resultElement = document.getElementById('getResult1');
    resultElement.innerHTML = '';

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
            //$.alert('error');
            console.log(error)
        });
    showUserInfo();
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

function UpdateSettings() {

    var settingsUpdate = axios({
        method: 'put',
        url: 'http://localhost/regit/public/settings/Update',
        headers: {},
        data: {
            id: AdminId,
            UserName: $('#UserUsername').val(),
            Password: $('#UserPassword').val(),
        },
    });
    console.log(settingsUpdate);
    alert("De gegevens zijn gewijzigd");
}