$(document).ready(function(){

    var myLanguage = {
        errorTitle: 'عفوا، هناك أخطاء!'
    };

    $.validate({
        form : '#form-delivery_form-add',
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
        form : '#form-delivery_form-article-add',
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
                ajax_action: 'delivery_form_supplier.delete',
                delivery_form_id: $(btn).attr('delivery_form_id')
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
                ajax_action: 'delivery_form_supplier.deleteArt',
                delivery_form_art_id: $(btn).attr('delivery_form_art_id')
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

    function LoadSuppliers(e){
        e.preventDefault();
        var obj = {
            ajax_action : 'supplier.modal'
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
function selectSupplier(btn, e){
    e.preventDefault();
    var tr = $(btn).parent().parent();
    $('.box-infos-id').val($(btn).attr('supplier_id'));
    $('.box-infos-name').text($(tr).children('.supplier_name').text());
    $('.box-infos-city').text($(tr).children('.supplier_city').text());
    $('.box-infos-address').text($(tr).children('.supplier_address').text());
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

function loadPurchase_ordersSupplier(e){
    e.preventDefault();
    var obj = {
        ajax_action : 'purchase_order_supplier.modal',
        supplier_id : $('#supplier_id').val()
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

function selectPurchase_orderSupplier(btn, e){
    e.preventDefault();
    var purchase_order_supplier_id = $(btn).attr('purchase_order_supplier_id');
    Import_Purchase_orderSupplier_Articles(purchase_order_supplier_id);
    $('#myModal').modal('hide');
}

function Import_Purchase_orderSupplier_Articles(purchase_order_supplier_id){
    var obj = {
        ajax_action : 'purchase_order_supplier.articlesByPurchase_orderSupplierId',
        purchase_order_supplier_id : purchase_order_supplier_id,
        delivery_form_supplier_id : $('#delivery_form_supplier_id').val()
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
