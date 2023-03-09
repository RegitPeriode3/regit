$(document).ready(function() {
    $('#UserManagementNav').on('click', GetUsers);
    $("#UserManageList").on("click", ' li', toggleUserList);
});

var selectedUserId;

function GetUsers(){
    // var resultElement = document.getElementById('getResult1');
    // resultElement.innerHTML = '';

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
}

function toggleUserList() {
    $("#UserManageList li").removeClass("active");
    $(this).addClass("active");
    selectedUserId = $(this).data()['Id'];
    showUserInfo($(this));
    //opdrachtgeverFactuurLijst(opdrachtgeverID);
}

function showUserInfo($el){
    //console.log($el);
    var userInfo = $el.data();
    $.each(userInfo, function (k, v) {
        //console.log(k);
        $("input[name=" + k + "]").val(v);
        $("textarea[name=" + k + "]").val(v);
    });
}

function CreateUser(){
    var test = axios({
        method: 'post',
        url: 'http://localhost/regit/public/user/Create',
        headers: {},
        data: {
            displayName: "Thomas",
            UserName: "Thomas",
            password: "test123",
            email: "test@test.nl",
            phoneNr: "1234567890",
            country: "land",
            location: "dorp",
            zipcode: "4747ak",
            address: "straat",
            active: true,
            deleted: false,
            clearence: "1"
        }
    }).then(function (response) {
        console.log(response);
    })
    .catch(function (error) {
        console.error(error.response.data);
    });
    console.log(test);
}