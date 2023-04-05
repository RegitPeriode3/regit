$(document).ready(function () {
    $('#settingsNav').on('click', GetSettings);
    $("#activityList").on("click", ' li', toggleActivityList);
    $('#profile-tab').on('click', clearForms);
});

//settings- email

    function GetSettings() {
        axios.get('http://localhost/regit/public/settings/')
            .then(function (response) {
                console.log(response.data);

                let SettingInfo = response.data;
                $.each(SettingInfo, function (k, v) { //put data in matching inputs
                    $("input[name=" + k + "]").val(v);
                    $("textarea[name=" + k + "]").val(v);
                });

            })
            .catch(function (error) {
                console.log(error)
            });
    }

    function UpdateSettings() {
        var settingsUpdate = axios({
            method: 'put',
            url: 'http://localhost/regit/public/settings/Update',
            headers: {},
            data: {
                id: 1,
                Name: $('#SettingsName').val(),
                Email: $('#SettingsEmail').val(),
                Server: $('#SettingsServer').val(),
                Port: $('#SettingsPort').val(),
                UserName: $('#SettingsUserName').val(),
                Password: $('#SettingsPassword').val(),
            },
        });
        console.log(settingsUpdate);
        alert("De gegevens zijn gewijzigd");
        GetSettings();
    }

// settings- activity

    var selectedActivityId;

    function GetActivities() {
        axios.get('http://localhost/regit/public/settings/GetActivities')
            .then(function (response) {
                console.log(response.data);
                var ActivityItem = response.data;

                $('#activityList').empty();
                var list = $('#activityList');
                $.each(ActivityItem, function (k, v) {
                    var entry = document.createElement('li');
                    entry.className = 'list-group-item';
                    entry.innerHTML = v['activityName'];
                    entry.id = v['id'];
                    list.append(entry);
                    $('#activityList li').last().data(v);
                })
                list.data(ActivityItem);
            })
            .catch(function (error) {
                console.log(error)
            });
    }

    function toggleActivityList() {
        $("#activityList li").removeClass("active");
        $(this).addClass("active");
        showActivityInfo($(this));
    }

    function showActivityInfo($el) {
        //console.log($el);
        var activityInfo = $el.data();
        selectedActivityId = activityInfo.id;

        $.each(activityInfo, function (k, v) {
            $("input[name=" + k + "]").val(v);
            $("textarea[name=" + k + "]").val(v);
        });
    }

    //new activity
    function CreateActivity() {

        var activityNew = axios({
            method: 'post',
            url: 'http://localhost/regit/public/settings/CreateActivity',
            headers: {},
            data: {
                activityName: $('#NewActivityName').val(),
                activityDescr: $('#NewActivityDescr').val(),
            },
        });
        clearForms();

        console.log(activityNew);
        alert("De nieuwe activiteit is opgeslagen");
        GetActivities();
    }

    //update & delete activities
    function UpdateActivity() {

        if (selectedActivityId == null) {
            alert("er is geen activiteit geselecteerd");
        } else {
            var activityUpdate = axios({
                method: 'put',
                url: 'http://localhost/regit/public/settings/UpdateActivity',
                headers: {},
                data: {
                    id: selectedActivityId,
                    activityName: $('#activityName').val(),
                    activityDescr: $('#activityDescr').val(),
                },
            });
            console.log(activityUpdate);
            alert("De activiteit is gewijzigd");
            GetActivities();
        }

    }

    function DeleteActivity() {
        if (selectedActivityId == null) {
            alert("er is geen activiteit geselecteerd");
        } else {
            var activityDelete = axios({
                method: 'put',
                url: 'http://localhost/regit/public/settings/DeleteActivity',
                headers: {},
                data: {
                    id: selectedActivityId
                },
            });
    
            clearForms();
            console.log(activityDelete);
            alert("De activiteit is verwijderd");
            clearForms();
            GetActivities();
        }
    }



    function clearForms() {
    $("#client-form")[0].reset();
    $("#newCompanyForm")[0].reset();
    $("#changeUserForm")[0].reset();
    $("#newUserForm")[0].reset();
    $("#userForm")[0].reset();
    $("#activityForm")[0].reset();
    }