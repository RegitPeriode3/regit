$(document).ready(function () {
    $('#CompanyManagementNav').on('click', GetCompanies);
    $("#CompanyManageList").on("click", ' li', toggleCompanyList);
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
                list.append(entry);
                $('#CompanyManageList li').last().data(v);
                //console.log($('#opdrachtgeverLijstGegevens li'));
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
    // selectedCompanyId = $(this).data()['Id'];
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
    console.log(companyNew);
    alert("De nieuwe klant is opgeslagen");
    GetCompanies();
}