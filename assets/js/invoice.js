$(document).ready(function() {
    SetCompaniesInvoice();
    $("#clientListInvoice").on("click", ' li', toggleClientList);
    $("#mail").on("click",Mailprompt);
});

var selectedCompanyId;

function SetCompaniesInvoice(){
    $('#clientListInvoice').html('');
    axios.get('http://localhost/regit/public/invoice/SetCompaniesInvoice')
        .then(function (response) {
            var companies = response.data;
            $('#clientListInvoice').empty();
            var list = $('#clientListInvoice');
            $.each(companies, function (k,v){
                var entry = document.createElement('li');
                entry.className = 'list-group-item';
                entry.innerHTML = v['companyName'];
                entry.id = v['companyId'];
                list.append(entry);
                $('#clientListInvoice li').last().data(v);
            });
            //SetProjects($('#clientListInvoice option:eq(0)').val());
        })
        .catch(function (error) {
            console.log(error)
        });
}

function toggleClientList() {
    $("#clientListInvoice li").removeClass("active");
    $(this).addClass("active");
    // selectedUserId = $(this).data()['Id'];
    // //console.log($(this))
    showInvoiceRows($(this));
}

function showInvoiceRows($el = 0, refresh = false) {
    var companyInfo = '';
    if($el != 0){
        if(refresh){
            companyInfo = $el;
            selectedCompanyId = companyInfo[0]['companyId'];
        }else {
            companyInfo = $el.data();
            selectedCompanyId = companyInfo.companyId;
        }
    }

    $('#tblInvoiceRowCompany tbody').html('');

    axios.get('http://localhost/regit/public/invoice/GetCompanyInvoiceRows/'+selectedCompanyId+'/'+ $('#dateFromInvoice').val()+'/'+$('#dateTillInvoice').val())
        .then(function (response) {
            var invoiceRows = response.data;
            console.log(invoiceRows);
            $.each(invoiceRows, function (k,v){
                if(!v['factureren']){
                    $checked = '';
                }else{
                    $checked = 'checked';
                }
                console.log(v)
                $('#tblInvoiceRowCompany').append( '<tr id="'+v['hourRegId']+'">' +
                    '<td>' + v["date"] + '</td>' +
                    '<td>' + v["HourlyCost"] + '</td>' +
                    '<td>' + v["Time"] + '</td>' +
                    '<td>' + v["projectName"] + '</td>' +
                    '<td>' + v["activityName"] + '</td>' +
                    '<td>' + v["description"] + '</td>' +
                    '<td>' + '<input type="checkbox" name="myTextEditBox"  onclick="toggleFactureren($(this));" '+$checked+'>' + '</td>' +

                    // '<td name="Action"><i class="bx bxs-trash" name="deleteRow" onclick="DeleteHourReg($(this));" style="cursor:pointer;" title="Verwijderen">Verwijder</i></td>'+
                    '</tr>' );
                $('#tblInvoiceRowCompany tbody tr:last').data(v)
            })
        })
        .catch(function (error) {
            console.log(error)
        });
}

async function toggleFactureren(row){
    data = row.closest('tr').data();
    console.log(data);

    var result = await axios({
        method: 'post',
        url: 'http://localhost/regit/public/invoice/toggleFactureren',
        headers: {},
        data: {
            invoiceRowId: data["hourRegId"],
            bool: row.is(":checked")
        },
    });
}

async function MakeInvoice($mail){
    //$mail = Mailprompt();

    var InvoiceRowIds = [];

    $("#tblInvoiceRowCompany tr").each(function(k,v) {
        if(k != 0){
            InvoiceRowIds.push(v.id);
        }
    });

    var result = await axios({
        method: 'post',
        url: 'http://localhost/regit/public/invoice/createInvoice',
        headers: {},
        data: {
            invoiceRowIds: InvoiceRowIds,
            mail: $mail,
        },
    });
    //Mailprompt();
    result = result.data;

    showInvoiceRows(result, true);
}

function Mailprompt()
{
    $.confirm({
        title: 'Mail',
        content: 'Wilt u de factuur als mail naar de klant versturen?',
        buttons: {
            ja: function () {
                // var result = axios({
                //     method: 'post',
                //     url: 'http://localhost/regit/public/invoice/sendMail',
                //     headers: {},
                //     data:
                // });
                //return true;
                //$.alert('Mail is verzonden');
                MakeInvoice(true);
            },
            nee: function () {
                MakeInvoice(false);
                //$.alert('Mail is niet verzonden');
            }

        }
    });
}