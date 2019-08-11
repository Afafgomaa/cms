$(document).ready(function(){

    var myLanguage = {
        errorTitle: 'عفوا، هناك أخطاء!'
    };

    $.validate({
        form : '#form-purchase_order-add',
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
    $.validate({
        form : '#form-purchase_order-article-add',
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


});

    function deleteElement(btn, e) {
        e.preventDefault();
        if (confirm("هل تريد فعلا حذف هذا العنصر؟")) {
            var obj = {
                ajax_action: 'purchase_order_clt.delete',
                purchase_order_id: $(btn).attr('purchase_order_id')
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
    function deleteElementArt(btn, e) {
        e.preventDefault();
        if (confirm("هل تريد فعلا حذف هذا العنصر؟")) {
            var obj = {
                ajax_action: 'purchase_order_clt.deleteArt',
                purchase_order_art_id: $(btn).attr('purchase_order_art_id')
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
    function loadArticles(e){
        e.preventDefault();
        var obj = {
            ajax_action : 'article.modal'
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

function selectArticle(btn, e){
    e.preventDefault();
    var tr = $(btn).parent().parent();
    $('.box-infos-id').val($(btn).attr('article_id'));
    $('.box-infos-desig').text($(tr).children('.article_desig').text());
    $('.box-infos-ref').text($(tr).children('.article_ref').text());
    $('#myModal').modal('hide');

}
function selectClient(btn, e){
    e.preventDefault();
    var tr = $(btn).parent().parent();
    $('.box-infos-id').val($(btn).attr('client_id'));
    $('.box-infos-name').text($(tr).children('.client_name').text());
    $('.box-infos-city').text($(tr).children('.client_city').text());
    $('.box-infos-address').text($(tr).children('.client_address').text());
    $('#myModal').modal('hide');

}

function calcTotal(){

    var qte = $('#qte').val(),
        price = $('#price').val();

    if(!isNaN(qte) && !isNaN(price)){
        $('#total').val(nFormat(qte * price));
    } else{
        $('#total').val('0.00');

    }
}

function loadQuotationsClt(e){
    e.preventDefault();
    var obj = {
        ajax_action : 'Quotation_clt.modal',
        client_id : $('#client_id').val()
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

function selectQuotationClt(btn, e){
    e.preventDefault();
    quotation_clt_id = $(btn).attr('quotation_clt_id');
    Import_QuotationClt_Articles(quotation_clt_id);
    $('#myModal').modal('hide');
}

function Import_QuotationClt_Articles(quotation_clt_id){
    var obj = {
        ajax_action : 'quotation_clt.articlesByQuotationCltId',
        quotation_clt_id : quotation_clt_id,
        purchase_order_clt_id : $('#purchase_order_clt_id').val()
    };
    $.post(
        cm_app_index,
        obj,
        function(data){
            if(data == 1){
                window.location.reload();
            } else {
                alert(data);
            }
        },
        'html'
    );

}
