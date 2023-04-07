$(document).ready(function () {
    $('#CompanyManagementNav').on('click', GetCompanies);
    $("#CompanyManageList").on("click", ' li', toggleCompanyList);
    $("#btnCreateCompany").on("click", getLastCompanyData);
    $("#CompanyManageList").on("click", ' li', clearForms);
    //$("#UpdateCustomerBtn").on("click", getLastCompanyData);


});

var selectedCompanyId;

function GetCompanies() {
    axios.get('http://localhost/regit/public/company/')
        .then(function (response) {
            console.log(response.data);
            var CompanyItem = response.data;
            //var CompanyItem = JSON.parse(response.data);

            $('#CompanyManageList').empty();
            var list = $('#CompanyManageList');
            $.each(CompanyItem, function (k, v) {
                var entry = document.createElement('li');
                entry.className = 'list-group-item';
                entry.innerHTML = v['name'];
                entry.id = v['id'];
                //console.log(entry.id);
                list.append(entry);
                $('#CompanyManageList li').last().data(v);

            })

            list.data(CompanyItem);

        })
        .catch(function (error) {
            //$.alert('error');
            console.log(error)
        });
}

function toggleCompanyList() {
    $("#CompanyManageList li").removeClass("active");
    $(this).addClass("active");
    selectedCompanyId = $(this).data()['id'];
    console.log(selectedCompanyId)
    // //console.log($(this))
    showCompanyInfo($(this));
}

function showCompanyInfo($el) {
    //console.log($el);
    var companyInfo = $el.data();
    selectedCompanyId = companyInfo.id;

    $.each(companyInfo, function (k, v) {

        $("input[name=" + k + "]").val(v);
        $("textarea[name=" + k + "]").val(v);

        //checkbox op wel / niet actief zetten
        if (companyInfo['active'] == true) {
            $('#CompanyActive').prop('checked', true);
        } else {
            $('#CompanyActive').prop('checked', false);
        }
    });
}


function CreateCompany() {

    var companyNew = axios({
        method: 'post',
        url: 'http://localhost/regit/public/company/Create',
        headers: {},
        data: {
            name: $('#NewCompanyName').val(),
            country: $('#NewCompanyCountry').val(),
            phoneNr: $('#NewCompanyPhoneNr').val(),
            zipcode: $('#NewCompanyZipcode').val(),
            location: $('#NewCompanyLocation').val(),
            address: $('#NewCompanyAddress').val(),
            invoiceAddress: $('#NewCompanyInvoiceAdress').val(),
        },
    });

    clearForms();


console.log("");
    console.log(companyNew);
    alert("De nieuwe klant is opgeslagen");
    GetCompanies();

}

async function UpdateCompany() {
    if (selectedUserId == null) {
        alert("er is geen gebruiker geselecteerd");
    } else {
        console.log($('#CustomerInvoiceAdress').text());
        var companyUpdated = await axios({
            method: 'post',
            url: 'http://localhost/regit/public/company/update',
            headers: {},
            data: {
                id: selectedCompanyId,
                name: $('#CompanyName').val(),
                country: $('#CustomerCountry').val(),
                active: $('#CompanyActive').is(":checked"),
                phoneNr: $('#phoneNr').val(),
                zipcode: $('#CustomerZipcode').val(),
                location: $('#CustomerLocation').val(),
                address: $('#CustomerAddress').val(),
                invoiceAddress: $('#CustomerInvoiceAdress').val(),
            },
        });
        console.log(companyUpdated);

        alert("De klant is aanepast");
        GetCompanies();
    }
}

async function deleteCompany() {
    if (selectedUserId == null) {
        alert("er is geen gebruiker geselecteerd");
    } else {
        var companyDelete = await axios({
            method: 'post',
            url: 'http://localhost/regit/public/company/deleteCompany',
            headers: {},
            data: {
                id: selectedCompanyId
            },
        });
        clearForms();
        console.log(companyDelete);
        alert("De geselecteerde klant is verwijderd");

        GetCompanies();
    }
}

function clearForms()
{
    $("#client-form")[0].reset();
    $("#newCompanyForm")[0].reset();
    $("#projectForm")[0].reset();
    $("#newUserForm")[0].reset();
    $("#userForm")[0].reset();


}


function getLastCompanyData() {
    axios.get('http://localhost/regit/public/company/lastCompany')
        .then(function (response) {
            var lastUserData = response.data;
            //console.log(lastUserData)
            $("#CompanyManageList li").removeClass("active");
            $('#CompanyManageList li').last().addClass("active");

            selectedCompanyData = $('#CompanyManageList li').last().data();
            //console.log(selectedCompanyData)
            $.each(selectedCompanyData, function (k, v) {

                $("input[name=" + k + "]").val(v);
                $("textarea[name=" + k + "]").val(v);

                if (selectedCompanyData['active'] === true) {
                    $('#CompanyActive').prop('checked', true);
                } else {
                    $('#CompanyActive').prop('checked', false);
                }
            });
        })
        .catch(function (error) {
            //$.alert('error');
            console.log(error)
        });

}

