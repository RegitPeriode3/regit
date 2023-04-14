$(document).ready(function () {

    $("#CompanyManageList").on("click", ' li', getProjectsByCompany);
    $("#projectManageList").on("click", ' li', toggleProjectList);
    $("#btnCreateProject").on("click", LoadProjectsByCompany);
    $("#btnDeleteProject").on("click", deleteProject);
    $("#btnDeleteProject").on("click", LoadProjectsByCompany);
    $("#btnEditProject").on("click", Updateproject);
    $("#btnEditProject").on("click", LoadProjectsByCompany);


});

var selectedProject;
var selectedCompanyId;


function getProjectsByCompany() {

    $("#CompanyManageList li").removeClass("active");
    $(this).addClass("active");
    selectedCompanyId = $(this).data()['id'];
    //console.log(selectedCompanyId)


    axios.get('http://localhost/regit/public/project/getproject/', {
        params: {
            id: selectedCompanyId
        }
    })
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


function LoadProjectsByCompany() {

    axios.get('http://localhost/regit/public/project/LoadLastProject/', {
        params: {
            id: selectedCompanyId
        }
    })
        .then(function (response) {
            var Project = response.data;

            $('#projectManageList').empty();
            var list = $('#projectManageList');

            $("#projectManageList li").removeClass("active");

            selectedUserData = $('#projectManageList li').last().data();

            $.each(Project, function (k, v) {

                var entry = document.createElement('li');
                entry.className = 'list-group-item';
                entry.innerHTML = v['name'];
                entry.id = v['id'];

                //console.log(entry.id);
                list.append(entry);
                $('#projectManageList li').last().data(v);

                $("#Name").val(v['name']);
                $("#Description").val(v['description']);
            })
            $('#projectManageList li').last().addClass("active");
            //list.data(Project);

        })
        .catch(function (error) {
            //$.alert('error');
            console.log(error)
        });

}


// function toggleCompanyList() {
//     clearForms();
//     $("#CompanyManageList li").removeClass("active");
//     $(this).addClass("active");
//     selectedCompanyId = $(this).data()['id'];
//     console.log(selectedCompanyId)
//     // //console.log($(this))
//     $("#invoicePdf").attr("src", "")
//     FillInvoiceList($(this).data());
//     showCompanyInfo($(this));
//
// }

function CreateProject() {


    var projectNew = axios({
        method: 'post',
        url: 'http://localhost/regit/public/project/createProject',
        headers: {},
        data: {
            id: selectedProject,
            name: $('#newName').val(),
            description: $('#newDescription').val(),
            companyID: selectedCompanyId,

        },

    });

    clearForms();
    console.log("");
    console.log(projectNew);
    alert("Het nieuw project is aangemaakt");


}

 function Updateproject() {
    if (selectedProject == null) {
        alert("er is geen project geselecteerd");
    } else {
        var projectUpdated =  axios({
            method: 'POST',
            url: 'http://localhost/regit/public/project/updateProject',
            headers: {},
            data: {
                id: selectedProject,
                name: $('#Name').val(),
                description: $('#Description').val(),
            },
        });
        console.log(projectUpdated);
        console.log(selectedProject);
        clearForms();
        alert("Het project is aangepast");
        //getProjects();
    }
}

 function deleteProject() {
    if (selectedProject == null) {
        alert("er is geen project geselecteerd");
    } else {
        var projectDelete =  axios({
            method: 'put',
            url: 'http://localhost/regit/public/project/deleteProject',
            headers: {},
            data: {
                id: selectedProject
            },
        });
        clearForms();
        console.log(projectDelete);
        console.log(selectedProject);
        alert("Het geselecteerde project is verwijderd");

        //LoadProjectsByCompany();
    }
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

// function test()
// {
//     console.log("123")
//     $("#client-form")[0].reset();
//     $("#newCompanyForm")[0].reset();
//     $("#projectForm")[0].reset();
//     $("#projectModal")[0].reset();
//     $("#projectFormModal")[0].reset();
//     $("#newUserForm")[0].reset();
//     $("#userForm")[0].reset();
//     $("#newClientModal")[0].reset();
//
//
// }