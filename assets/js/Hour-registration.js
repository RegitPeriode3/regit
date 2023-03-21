$(document).ready(function() {
 SetCompanies();
 loadActivities();
 getInvoiceRows();
});

function HoursWorked(){
    var workedFrom = $('#WorkedFrom').val();
    var workedTill = $('#WorkedTill').val();
    if(workedTill <= workedFrom){
        $.alert('gewerkt tot is niet groter dan gewerkt van dat kan niet, probeer opnieuw');
    }else {
        axios.get('http://localhost/regit/public/hourRegistration/calcHours/'+workedFrom+'/'+workedTill)
            .then(function (response) {
                var HoursWorked = response.data;
                $('#hoursAmt').text(HoursWorked);
            })
            .catch(function (error) {
                console.log(error)
            });
    }
}

function SetCompanies(){
    $('#hourRegCompanies').html('');
    axios.get('http://localhost/regit/public/hourRegistration/GetCompanyPerUser/'+4)//let op hier moet nog een variable als id komen en niet hardcoded
        .then(function (response) {
            var companies = response.data;
            $.each(companies, function (k,v){
                $('#hourRegCompanies').append( '<option value="'+v['companyId']+'">'+v['companyName']+'</option>' );
            });
            SetProjects($('#hourRegCompanies option:eq(0)').val());
        })
        .catch(function (error) {
            console.log(error)
        });
}

function SetProjects(companyId){
    $('#hourRegProjects').html('');
    axios.get('http://localhost/regit/public/hourRegistration/GetProjectPerCompany/'+companyId)
        .then(function (response) {
            var companies = response.data;
            $.each(companies, function (k,v){
                $('#hourRegProjects').append( '<option value="'+v['projectId']+'">'+v['projectName']+'</option>' );
            })
        })
        .catch(function (error) {
            console.log(error)
        });
}

function loadActivities(){
    $('#hourRegActivity').html('');
    axios.get('http://localhost/regit/public/hourRegistration/GetActivities')
        .then(function (response) {
            var Activities = response.data;
            $.each(Activities, function (k,v){
                $('#hourRegActivity').append( '<option value="'+v['activityId']+'">'+v['activityName']+'</option>' );
            })
        })
        .catch(function (error) {
            console.log(error)
        });
}

async function registerHour(){
    //console.log(objectifyForm($('#hourRegForm')));
    //var formData = objectifyForm($('#hourRegForm').serializeArray());

    var result = await axios({
        method: 'post',
        url: 'http://localhost/regit/public/hourRegistration/RegisterHour',
        headers: {},
        data: {
            Date: $('#hourRegDate').val(),
            hoursWorked: $('#hoursAmt').text(),
            Company: $('#hourRegCompanies').val(),
            Project: $('#hourRegProjects').val(),
            Activity: $('#hourRegActivity').val(),
            Description: $('#hourDescription').val(),
        },
    });
    getInvoiceRows();
    $.alert(await result.data);
}

function getInvoiceRows(){
    $('#tblInvoiceRow tbody').html('');
    $WorkedFrom = $('#WorkedFrom').val();
    $WorkedTill = $('#WorkedTill').val();
    axios.get('http://localhost/regit/public/hourRegistration/getInvoiceRows')
        .then(function (response) {
            var invoiceRows = response.data;
            $.each(invoiceRows, function (k,v){
                $('#tblInvoiceRow').append( '<tr id="'+v['Id']+'">' +
                    '<td>' + v["InvoiceNr"] + '</td>' +
                    '<td>' + v["Date"] + '</td>' +
                    '<td>' + v["HoursWorked"] + '</td>' +
                    '<td>' + v["Project"] + '</td>' +
                    '<td>' + v["Activity"] + '</td>' +
                    '<td>' + v["Description"] + '</td>' +
                    '<td name="Action"><i class="bx bxs-trash" name="deleteRow" onclick="DeleteHourReg($(this));" style="cursor:pointer;" title="Verwijderen">Verwijder</i></td>'+
                    '</tr>' );
                $('#tblInvoiceRow tbody tr:last').data(v)
            })
        })
        .catch(function (error) {
            console.log(error)
        });
}

async function DeleteHourReg(row){
    data = row.closest('tr').data();
    console.log(data);

    var result = await axios({
        method: 'post',
        url: 'http://localhost/regit/public/hourRegistration/DeleteHourReg',
        headers: {},
        data: {
            Id: data['Id']
        },
    });

    getInvoiceRows();
}
