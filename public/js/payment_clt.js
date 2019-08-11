$(document).ready(function(){

    var myLanguage = {
        errorTitle: 'عفوا، هناك أخطاء!'
    };

    $.validate({
        form : '#form-payment-add',
        language : myLanguage,
        modules : 'file',
        validateOnBlur : false,
        errorMessagePosition : 'top',
        onError : function() {
            //alert('alert !');
        },
        onSuccess : function() {
            //alert('success!');
        }
    });

    $('#form-payment-add').submit(function(){
        var total_rest_to_pay = $('#total_rest_to_pay').val(),
            amount = $('#amount').val();
        total_rest_to_pay = total_rest_to_pay.replace(/ /g, "");

        if((total_rest_to_pay == 0) || (amount > total_rest_to_pay)){
            alert("Inviled amount !");
            return false;
        }

    });


});

    function deleteElement(btn, e) {
        e.preventDefault();
        if (confirm("هل تريد فعلا حذف هذا العنصر؟")) {
            var obj = {
                ajax_action: 'payment_clt.delete',
                payment_id: $(btn).attr('payment_id')
            };
            $.post(
                cm_app_index,
                obj,
                function (data) {

                    if (data == 1) {
                        window.location.reload();
                    } else {
                        alert("واجهتا مشاكل، المرجو المحاولة.");
                    }
                },
                'html'
            );
        }
    }

    function LoadClients(e){
        e.preventDefault();
        var obj = {
            ajax_action : 'client.modal'
        };
        $.post(
            cm_app_index,
            obj,
            function(data){
                $('#myModal').modal('show');
                $('.modal-content .modal-body .table-responsive table tbody').html(data);
            },
            'html'
        );
    }
    function showPayments(btn, e){
        e.preventDefault();
        var obj = {
            ajax_action : 'payment_clt.modal',
            invoice_id : $(btn).attr('invoice_id')
        };
        $.post(
            cm_app_index,
            obj,
            function(data){
                $('#myModal').modal('show');
                $('.modal-content .modal-body').html(data);
            },
            'html'
        );
    }

function selectClient(btn, e){
    e.preventDefault();
    var tr = $(btn).parent().parent();
    var client_id = $(btn).attr('client_id');
    $('.box-infos-id').val(client_id);
    $('.box-infos-name').text($(tr).children('.client_name').text());
    $('.box-infos-city').text($(tr).children('.client_city').text());
    $('.box-infos-address').text($(tr).children('.client_address').text());
    $('#myModal').modal('hide')

    loadInvoicesByClient(client_id);
}


function loadInvoicesByClient(client_id){
    var obj = {
        ajax_action : 'payment_clt.byClient',
        client_id : client_id
    };
    $.post(
        cm_app_index,
        obj,
        function(data){
            var obj = JSON.parse(data);
            $('#total_invoices').val(obj.total_invoices);
            $('#total_paied').val(obj.total_paied);
            $('#total_rest').val(obj.total_rest);
            $('#total_rest_to_pay').val(obj.total_rest);
            $('.payment_table.table-responsive table tbody').html(obj.invoices);
        },
        'html'
    );
}

function calcTotalRest(){

    var total_rest_to_pay = $('#total_rest_to_pay').val(),
        amount = $('#amount').val();
    total_rest_to_pay = total_rest_to_pay.replace(/ /g, "");

    if(!isNaN(total_rest_to_pay) && !isNaN(amount)){
        $('#amount_rest').val(nFormat(total_rest_to_pay - amount));
    } else{
        $('#amount_rest').val('0.00');

    }
}



