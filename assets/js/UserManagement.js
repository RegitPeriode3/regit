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

function EditUser(){
    console.log('saved');
}