$(document).ready(function () {

    $("#projecten-tab").on("click", getProjects);
    $("#projectManageList").on("click", ' li', toggleProjectList);
});

var selectedProject;
function getProjects() {
    axios.get('http://localhost/regit/public/project/')
        .then(function (response) {
            var Project = response.data;

            $('#projectManageList').empty();
            var list = $('#projectManageList');
            $.each(Project, function (k, v) {
                var entry = document.createElement('li');
                entry.className = 'list-group-item';
                entry.innerHTML = v['name'];
                entry.id = v['id'];
                //console.log(entry.id);
                list.append(entry);
                $('#projectManageList li').last().data(v);

            })

            list.data(Project);

        })
        .catch(function (error) {
            //$.alert('error');
            console.log(error)
        });
}

function showCompanyInfo($el) {
    //console.log($el);
    var projectInfo = $el.data();
    selectedProject = projectInfo.id;

    $.each(projectInfo, function (k, v) {

        $("input[name=" + k + "]").val(v);
        $("textarea[name=" + k + "]").val(v);

    });
}

function toggleProjectList() {
    $("#projectManageList li").removeClass("active");
    $(this).addClass("active");
    var projectInfo = $(this).data();
    console.log(projectInfo)
    selectedProject = projectInfo.id;

    $.each(projectInfo, function (k, v) {

        $("input[name=" + k + "]").val(v);
       

    });
}