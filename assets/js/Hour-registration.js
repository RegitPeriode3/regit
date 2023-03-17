$(document).ready(function() {
 SetCompanies();
 loadActivities();
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
                console.log(k);
                console.log(v);
                console.log(v['activityId']);
                $('#hourRegActivity').append( '<option value="'+v['activityId']+'">'+v['activityName']+'</option>' );
            })
        })
        .catch(function (error) {
            console.log(error)
        });
}