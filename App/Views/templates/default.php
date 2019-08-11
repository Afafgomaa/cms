<!doctype html>
<html>
<head>
    <title>إدارة المبيعات</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= App::$path ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= App::$path ?>css/style.css" />
    <link rel="stylesheet" href="<?= App::$path ?>css/responsive.css" />
    <link rel="stylesheet" href="<?= App::$path ?>css/font-awesome.min.css" />

</head>
<body class="">

<div id="wrap" class="wrapper">
    <header class="main-header">
        <a href="" class="logo">
            <span class="logo-mini"><b>إ.د</b></span>
            <span class="logo-lg"><b>إدارة الميعات</b></span>
        </a>
        <nav class="navbar navbar-default navbar-static-top">
            <a href="#" id="btn-sidebar-collapse" class="sidebar-toggle"><span class="glyphicon glyphicon-menu-hamburger"></span></a>

            <ul class="nav navbar-nav navbar-notifs-top">
                <?php if(isset($_SESSION['user'])){ ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-globe"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="en">English</a></li>
                    <li><a href="fr">Français</a></li>
                </ul>
            </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="<?= App::$path ?>img/avatar/<?= $_SESSION['user']->avatar ?>" class="user-img-top" />
                        <span class="hidden-xs user-name-top"><b><?= $_SESSION['user']->fname.' '. $_SESSION['user']->lname ?></b></span>

                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="user-header">
                            <img src="<?= App::$path ?>img/avatar/<?= $_SESSION['user']->avatar ?>" class="img-circle" />
                            <p><b><?= $_SESSION['user']->fname.' '. $_SESSION['user']->lname ?></b></p>
                            <p><small><?= $_SESSION['user']->function ?></small></p>
                        </li>
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">المشتريات</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">المبيعات</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">خيار</a>
                            </div>
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="<?= App::$path ?>user/profile/<?= $_SESSION['user']->id ?>" class="btn btn-default">بروفايل</a>
                            </div>
                            <div class="pull-left">
                                <a href="<?= App::$path ?>user/logout" class="btn btn-default">خروج</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-envelope"></span>
                        <span class="label label-warning">15</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">لديك  5 رسائل</li>
                        <li>
                            <ul class="list-group menu-msg">
                                <li class="list-group-item">Cras justo odio</li>
                                <li class="list-group-item list-group-item-danger">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Morbi leo risus</li>
                                <li class="list-group-item list-group-item-warning">Porta ac consectetur ac</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>
                        </li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-flag"></span>
                        <span class="label label-danger">15</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
                <?php } else{ ?>
                <li>
                    <a href="<?= App::$path ?>user/login" class="btn-nav"><span class="fa fa-flag"></span> دخول</a>
                </li>
                <?php } ?>
            </ul>

        </nav>

    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="gnav">
                <div class="gnav-header" style="background-color: #000">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapsehome" aria-expanded="false" aria-controls="collapsehome">
                        <span class="fa fa-edit"></span>
                        <span class="hidden-on-collapse"> الرئيسية</span></a>
                </div>
                <ul class="subnav collapse in" id="collapsehome">
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->show_suppliers): ?>
                        <li>
                            <div class="gnav">
                        <div class="gnav-header">
                            <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapsesuppliers" aria-expanded="false" aria-controls="collapsesuppliers">
                                <span class="fa fa-edit"></span>
                                <span class="hidden-on-collapse">الموردين</span></a>
                        </div>
                        <ul class="subnav collapse" id="collapsesuppliers">
                            <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_suppliers): ?>
                            <li><a href="<?= App::$path ?>supplier/add">
                                    <span class="fa fa-edit"></span>
                                    <span class="hidden-on-collapse">إضافة مورد</span>
                                </a></li>
                            <?php endif; ?>
                            <li><a href="<?= App::$path ?>supplier/index">
                                    <span class="fa fa-edit"></span>
                                    <span class="hidden-on-collapse">الموردين</span>
                                </a></li>
                        </ul>
                    </div>
                        </li>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->show_clients): ?>
                        <li>
                            <div class="gnav">
                        <div class="gnav-header">
                            <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapseclients" aria-expanded="false" aria-controls="collapseclients">
                                <span class="fa fa-edit"></span>
                                <span class="hidden-on-collapse">العملاء</span></a>
                        </div>
                        <ul class="subnav collapse" id="collapseclients">
                            <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_clients): ?>
                            <li><a href="<?= App::$path ?>client/add">
                                    <span class="fa fa-edit"></span>
                                    <span class="hidden-on-collapse">إضافة عميل</span>
                                </a></li>
                            <?php endif; ?>
                            <li><a href="<?= App::$path ?>client/index">
                                    <span class="fa fa-edit"></span>
                                    <span class="hidden-on-collapse">العملاء</span>
                                </a></li>
                        </ul>
                    </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- sales start -->
            <?php if(isset($_SESSION['user']) && $_SESSION['user']->show_sales): ?>
            <div class="gnav">
                <div class="gnav-header" style="background-color: #000">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapsesales" aria-expanded="false" aria-controls="collapsesales">
                        <span class="fa fa-edit"></span>
                        <span class="hidden-on-collapse"> المبيعات</span></a>
                </div>
                <ul class="subnav collapse in" id="collapsesales">
                    <li>
                        <div class="gnav">
                <div class="gnav-header">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapseprice_requests" aria-expanded="false" aria-controls="collapseprice_requests">
                        <span class="fa fa-edit"></span>
                        <span class="hidden-on-collapse"> طلبات الأثمنة</span></a>
                </div>
                <ul class="subnav collapse" id="collapseprice_requests">
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_sales): ?>
                    <li><a href="<?= App::$path ?>price_request_clt/add">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">طلب أثمنة جديد</span>
                        </a></li>
                    <?php endif; ?>
                    <li><a href="<?= App::$path ?>price_request_clt/index">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse"> طلبات الأثمنة</span>
                        </a></li>
                </ul>
            </div>
                    </li><li>
                        <div class="gnav">
                <div class="gnav-header">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapquotations" aria-expanded="false" aria-controls="collapquotations">
                        <span class="fa fa-edit"></span>
                        <span class="hidden-on-collapse"> عروض الأثمنة</span></a>
                </div>
                <ul class="subnav collapse" id="collapquotations">
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_sales): ?>
                    <li><a href="<?= App::$path ?>quotation_clt/add">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">إضافة عرض أثمنة</span>
                        </a></li>
                    <?php endif; ?>
                    <li><a href="<?= App::$path ?>quotation_clt/index">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">  عروض الأثمنة</span>
                        </a></li>
                </ul>
            </div>
                    </li><li>
                        <div class="gnav">
                <div class="gnav-header">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapsepurchase_orders" aria-expanded="false" aria-controls="collapsepurchase_orders">
                        <span class="fa fa-edit"></span>
                        <span class="hidden-on-collapse"> طلبات المنتجات</span></a>
                </div>
                <ul class="subnav collapse" id="collapsepurchase_orders">
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_sales): ?>
                    <li><a href="<?= App::$path ?>purchase_order_clt/add">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">إضافة طلب أثمنة</span>
                        </a></li>
                    <?php endif; ?>
                    <li><a href="<?= App::$path ?>purchase_order_clt/index">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">  طلبات المنتجات</span>
                        </a></li>
                </ul>
            </div>
                    </li><li>
                        <div class="gnav">
                <div class="gnav-header">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapsedelivery_forms" aria-expanded="false" aria-controls="collapsedelivery_forms">
                        <span class="fa fa-edit"></span>
                        <span class="hidden-on-collapse"> تسليم المنتجات</span></a>
                </div>
                <ul class="subnav collapse" id="collapsedelivery_forms">
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_sales): ?>
                    <li><a href="<?= App::$path ?>delivery_form_clt/add">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">إضافة تسليم منتجات</span>
                        </a></li>
                    <?php endif; ?>
                    <li><a href="<?= App::$path ?>delivery_form_clt/index">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">   تسليم المنتجات</span>
                        </a></li>
                </ul>
            </div>
                    </li><li>
                        <div class="gnav">
                <div class="gnav-header">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapseinvoice_clts" aria-expanded="false" aria-controls="collapseinvoice_clts">
                        <span class="fa fa-edit"></span>
                        <span class="hidden-on-collapse"> الفواتير</span></a>
                </div>
                <ul class="subnav collapse" id="collapseinvoice_clts">
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_sales): ?>
                    <li><a href="<?= App::$path ?>invoice_clt/add">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">إضافة فاتورة</span>
                        </a></li>
                    <?php endif; ?>
                    <li><a href="<?= App::$path ?>invoice_clt/index">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">    الفواتير</span>
                        </a></li>
                </ul>
            </div>
                    </li><li>
                        <div class="gnav">
                <div class="gnav-header">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapsepayment_clts" aria-expanded="false" aria-controls="collapsepayment_clts">
                        <span class="fa fa-edit"></span>
                        <span class="hidden-on-collapse"> عمليات الدفع</span></a>
                </div>
                <ul class="subnav collapse" id="collapsepayment_clts">
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_sales): ?>
                    <li><a href="<?= App::$path ?>payment_clt/add">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">عملية دفع جديدة</span>
                        </a></li>
                    <?php endif; ?>
                    <li><a href="<?= App::$path ?>payment_clt/index">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">     عمليات الدفع</span>
                        </a></li>
                </ul>
            </div>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
            <!-- sales end -->
            <!-- purchases start -->
            <?php if(isset($_SESSION['user']) && $_SESSION['user']->show_purchases): ?>
                <div class="gnav">
                    <div class="gnav-header" style="background-color: #000">
                        <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapsepurchases" aria-expanded="false" aria-controls="collapsepurchases">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse"> المشتريات</span></a>
                    </div>
                    <ul class="subnav collapse in" id="collapsepurchases">
                        <li>
                            <div class="gnav">
                                <div class="gnav-header">
                                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapseprice_requests_supplier" aria-expanded="false" aria-controls="collapseprice_requests_supplier">
                                        <span class="fa fa-edit"></span>
                                        <span class="hidden-on-collapse"> طلبات الأثمنة</span></a>
                                </div>
                                <ul class="subnav collapse" id="collapseprice_requests_supplier">
                                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_purchases): ?>
                                        <li><a href="<?= App::$path ?>price_request_supplier/add">
                                                <span class="fa fa-edit"></span>
                                                <span class="hidden-on-collapse">طلب أثمنة جديد</span>
                                            </a></li>
                                    <?php endif; ?>
                                    <li><a href="<?= App::$path ?>price_request_supplier/index">
                                            <span class="fa fa-edit"></span>
                                            <span class="hidden-on-collapse"> طلبات الأثمنة</span>
                                        </a></li>
                                </ul>
                            </div>
                        </li><li>
                            <div class="gnav">
                                <div class="gnav-header">
                                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapquotations_supplier" aria-expanded="false" aria-controls="collapquotations_supplier">
                                        <span class="fa fa-edit"></span>
                                        <span class="hidden-on-collapse"> عروض الأثمنة</span></a>
                                </div>
                                <ul class="subnav collapse" id="collapquotations_supplier">
                                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_purchases): ?>
                                        <li><a href="<?= App::$path ?>quotation_supplier/add">
                                                <span class="fa fa-edit"></span>
                                                <span class="hidden-on-collapse">إضافة عرض أثمنة</span>
                                            </a></li>
                                    <?php endif; ?>
                                    <li><a href="<?= App::$path ?>quotation_supplier/index">
                                            <span class="fa fa-edit"></span>
                                            <span class="hidden-on-collapse">  عروض الأثمنة</span>
                                        </a></li>
                                </ul>
                            </div>
                        </li><li>
                            <div class="gnav">
                                <div class="gnav-header">
                                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapsepurchase_orders_supplier" aria-expanded="false" aria-controls="collapsepurchase_orders_supplier">
                                        <span class="fa fa-edit"></span>
                                        <span class="hidden-on-collapse"> طلبات المنتجات</span></a>
                                </div>
                                <ul class="subnav collapse" id="collapsepurchase_orders_supplier">
                                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_purchases): ?>
                                        <li><a href="<?= App::$path ?>purchase_order_supplier/add">
                                                <span class="fa fa-edit"></span>
                                                <span class="hidden-on-collapse">إضافة طلب أثمنة</span>
                                            </a></li>
                                    <?php endif; ?>
                                    <li><a href="<?= App::$path ?>purchase_order_supplier/index">
                                            <span class="fa fa-edit"></span>
                                            <span class="hidden-on-collapse">  طلبات المنتجات</span>
                                        </a></li>
                                </ul>
                            </div>
                        </li><li>
                            <div class="gnav">
                                <div class="gnav-header">
                                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapsedelivery_forms_supplier" aria-expanded="false" aria-controls="collapsedelivery_forms_supplier">
                                        <span class="fa fa-edit"></span>
                                        <span class="hidden-on-collapse"> تسليم المنتجات</span></a>
                                </div>
                                <ul class="subnav collapse" id="collapsedelivery_forms_supplier">
                                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_purchases): ?>
                                        <li><a href="<?= App::$path ?>delivery_form_supplier/add">
                                                <span class="fa fa-edit"></span>
                                                <span class="hidden-on-collapse">إضافة تسليم منتجات</span>
                                            </a></li>
                                    <?php endif; ?>
                                    <li><a href="<?= App::$path ?>delivery_form_supplier/index">
                                            <span class="fa fa-edit"></span>
                                            <span class="hidden-on-collapse">   تسليم المنتجات</span>
                                        </a></li>
                                </ul>
                            </div>
                        </li><li>
                            <div class="gnav">
                                <div class="gnav-header">
                                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapseinvoice_suppliers" aria-expanded="false" aria-controls="collapseinvoice_suppliers">
                                        <span class="fa fa-edit"></span>
                                        <span class="hidden-on-collapse"> الفواتير</span></a>
                                </div>
                                <ul class="subnav collapse" id="collapseinvoice_suppliers">
                                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_purchases): ?>
                                        <li><a href="<?= App::$path ?>invoice_supplier/add">
                                                <span class="fa fa-edit"></span>
                                                <span class="hidden-on-collapse">إضافة فاتورة</span>
                                            </a></li>
                                    <?php endif; ?>
                                    <li><a href="<?= App::$path ?>invoice_supplier/index">
                                            <span class="fa fa-edit"></span>
                                            <span class="hidden-on-collapse">    الفواتير</span>
                                        </a></li>
                                </ul>
                            </div>
                        </li><li>
                            <div class="gnav">
                                <div class="gnav-header">
                                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapsepayment_suppliers" aria-expanded="false" aria-controls="collapsepayment_suppliers">
                                        <span class="fa fa-edit"></span>
                                        <span class="hidden-on-collapse"> عمليات الدفع</span></a>
                                </div>
                                <ul class="subnav collapse" id="collapsepayment_suppliers">
                                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_purchases): ?>
                                        <li><a href="<?= App::$path ?>payment_supplier/add">
                                                <span class="fa fa-edit"></span>
                                                <span class="hidden-on-collapse">عملية دفع جديدة</span>
                                            </a></li>
                                    <?php endif; ?>
                                    <li><a href="<?= App::$path ?>payment_supplier/index">
                                            <span class="fa fa-edit"></span>
                                            <span class="hidden-on-collapse">     عمليات الدفع</span>
                                        </a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
            <!-- purchases end -->
            <?php if(isset($_SESSION['user']) && $_SESSION['user']->show_articles): ?>
            <div class="gnav">
                <div class="gnav-header" style="background-color: #000">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapsestocks" aria-expanded="false" aria-controls="collapsestocks">
                        <span class="fa fa-edit"></span>
                        <span class="hidden-on-collapse"> المخازن</span></a>
                </div>
                <ul class="subnav collapse in" id="collapsestocks">
                    <li>
                        <div class="gnav">
                <div class="gnav-header">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <span class="fa fa-edit"></span>
                        <span class="hidden-on-collapse">المنتجات</span></a>
                </div>
                <ul class="subnav collapse" id="collapseExample">
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_articles): ?>
                    <li><a href="<?= App::$path ?>article/add">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">إضافة منتج جديد</span>
                        </a></li>
                    <?php endif; ?>
                    <li><a href="<?= App::$path ?>article/index">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">المنتجات</span>
                        </a></li>
                    <li><a href="<?= App::$path ?>category/index">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">الأصناف</span>
                        </a></li>
                    <li><a href="<?= App::$path ?>unit/index">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">الوحدات</span>
                        </a></li>
                </ul>
            </div>
                        <div class="gnav">
                <div class="gnav-header">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapsestock" aria-expanded="false" aria-controls="collapsestock">
                        <span class="fa fa-edit"></span>
                        <span class="hidden-on-collapse">المخازن</span></a>
                </div>
                <ul class="subnav collapse" id="collapsestock">
                    <li><a href="<?= App::$path ?>stock/index">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">المخازن</span>
                        </a></li>
                </ul>
            </div>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['user']) && $_SESSION['user']->show_users_roles): ?>
            <div class="gnav">
                <div class="gnav-header" style="background-color: #000">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapseusers_admin" aria-expanded="false" aria-controls="collapseusers_admin">
                        <span class="fa fa-edit"></span>
                        <span class="hidden-on-collapse"> إدارة المستخدمين</span></a>
                </div>
                <ul class="subnav collapse in" id="collapseusers_admin">
                    <li>
                        <div class="gnav">
                <div class="gnav-header">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                        <span class="fa fa-users"></span>
                        <span class="hidden-on-collapse">المستخدمين</span></a>
                </div>
                <ul class="subnav collapse" id="collapseUsers">
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_users_roles): ?>
                    <li><a href="<?= App::$path ?>user/add">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">إضافة مستخدم جديد</span>
                        </a></li>
                    <?php endif; ?>
                    <li><a href="<?= App::$path ?>user/index">
                            <span class="fa fa-users"></span>
                            <span class="hidden-on-collapse">تدبير المستخدمين</span>
                        </a></li>
                    <li><a href="<?= App::$path ?>user/profile/<?= $_SESSION['user']->id ?>">
                            <span class="fa fa-users"></span>
                            <span class="hidden-on-collapse">بروفايل</span>
                        </a></li>
                    <li><a href="<?= App::$path ?>user/profileedit/<?= $_SESSION['user']->id ?>">
                            <span class="fa fa-users"></span>
                            <span class="hidden-on-collapse">تعديل البروفايل</span>
                        </a></li>
                </ul>
            </div>
                    </li><li>
            <div class="gnav">
                <div class="gnav-header">
                    <a class="has-childs collapse" role="button" data-toggle="collapse" href="#collapseRoles" aria-expanded="false" aria-controls="collapseRoles">
                        <span class="fa fa-lock"></span>
                        <span class="hidden-on-collapse">حقوق الولوج</span></a>
                </div>
                <ul class="subnav collapse" id="collapseRoles">
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->aed_users_roles): ?>
                    <li><a href="<?= App::$path ?>role/add">
                            <span class="fa fa-edit"></span>
                            <span class="hidden-on-collapse">إضافة حق الولوج جديد</span>
                        </a></li>
                    <?php endif; ?>
                    <li><a href="<?= App::$path ?>role/index">
                            <span class="fa fa-lock"></span>
                            <span class="hidden-on-collapse">تدبير حقوق الولوج</span>
                        </a></li>
                </ul>
            </div>
                    </li>
                </ul>
            </div>
            <?php endif; ?>





        </section>
    </aside>
<!-- view content start -->
    <div class="content-wrapper">
        <?= $content; ?>
    </div>

<!-- view content start -->
    <footer class="main-footer">
        <p>&copy; درب النجاح 2015، كل الحقوق محفوظة.</p>
    </footer>

</div>

<script src="<?= App::$path ?>js/jquery-1.11.3.min.js"></script>
<script src="<?= App::$path ?>js/bootstrap.min.js"></script>
<script src="<?= App::$path ?>js/form-validator/jquery.form-validator.min.js"></script>
<script src="<?= App::$path ?>js/functions.js"></script>
<script src="<?= App::$path ?>js/<?= App::getInstance()->cur_page ?>.js"></script>
<script>
            $(document).ready(function(){

            $('#btn-sidebar-collapse').click(function(){

                if( $('body').hasClass('has-mini-sidebar') )
                    $('body').removeClass('has-mini-sidebar')
                else
                    $('body').addClass('has-mini-sidebar')
            });


        });
</script>
</body>
