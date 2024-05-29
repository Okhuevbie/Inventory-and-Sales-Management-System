<?php
session_start();
    include '../includer.inc.php';
    Session::checkStoreSession();
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard | Warehouse System </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Mega Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
      <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
      <meta name="author" content="codedthemes" />
      <!-- Favicon icon -->
      <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
      <!-- waves.css -->
      <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- Required Framwork -->
      <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/css/bootstrap.min.css">
      <!-- waves.css -->
      <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- themify icon -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/themify-icons/themify-icons.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/fontawesome/css/all.min.css">
      <!-- scrollbar.css -->
      <link rel="stylesheet" type="text/css" href="../assets/css/jquery.mCustomScrollbar.css">
      <!-- am chart export.css -->
      <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  </head>

  <body> 
                  <?php include 'navigation.inc.php'; ?>
                  <div class="pcoded-content">
                      <!-- Page-header start -->
                      <div class="page-header">
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      <div class="page-header-title">
                                          <h5 class="m-b-10">Dashboard</h5>
                                          <p class="m-b-0">Welcome to Warehouse System Warehouse Management</p>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <ul class="breadcrumb-title">
                                          <li class="breadcrumb-item">
                                              <a href="index.html"> <i class="fa fa-home"></i> </a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <?php 
                                            $getProducts = $sl->selectAllExcludeDeleted('products');
                                            $stock_alert = $out_of_stock = 0;
                                            if ($getProducts) {
                                                while ($row = $getProducts->fetch_assoc()) {
                                                    $available = intval($ct->sumAvailableProducts($row['id']));
                                                    if ($available <= $row['alert_quantity']) {
                                                        $stock_alert++;
                                                    }
                                                    if ($available == 0) {
                                                        $out_of_stock++;
                                                    }
                                                }
                                            }
                                            if (USER_ROLE == 0 || USER_ROLE == 1 || USER_ROLE == 2) {
                                         ?>

                                          <div class="col-12">
                                            <div class="card mat-stat-card">
                                                <div class="card-block p-0">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-6 col-md-3 b-r-default p-b-20 p-t-20">
                                                            <div class="row align-items-center text-center">
                                                                <div class="col-4 p-r-0">
                                                                    <i class="fa fa-boxes text-c-purple f-24"></i>
                                                                </div>
                                                                <div class="col-8 p-l-0">
                                                                    <h5><?php echo number_format($ct->countExcludingDeleted('products')); ?></h5>
                                                                    <p class="text-muted m-b-0">Products</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 p-b-20 p-t-20  b-r-default">
                                                            <div class="row align-items-center text-center">
                                                                <div class="col-4 p-r-0">
                                                                    <i class="fa fa-exclamation-triangle text-c-yellow f-24"></i>
                                                                </div>
                                                                <div class="col-8 p-l-0">
                                                                    <h5><?php echo number_format($stock_alert); ?></h5>
                                                                    <p class="text-muted m-b-0">Stock Alert</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 p-b-20 p-t-20 b-r-default">
                                                            <div class="row align-items-center text-center">
                                                                <div class="col-4 p-r-0">
                                                                    <i class="fa fa-exclamation-circle text-c-red f-24"></i>
                                                                </div>
                                                                <div class="col-8 p-l-0">
                                                                    <h5><?php echo number_format($out_of_stock); ?></h5>
                                                                    <p class="text-muted m-b-0">Out of Stock</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 p-b-20 p-t-20">
                                                            <div class="row align-items-center text-center">
                                                                <div class="col-4 p-r-0">
                                                                    <i class="fa fa-trash text-c-red f-24"></i>
                                                                </div>
                                                                <div class="col-8 p-l-0">
                                                                    <h5><?php echo number_format($ct->sumExpiredProducts()); ?></h5>
                                                                    <p class="text-muted m-b-0">Expired Products</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                          </div>
                                          <?php }?>
                                            <!-- task, page, download counter  start -->
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-purple"><?php echo number_format($ct->countExcludingDeleted('users')); ?></h4>
                                                                <h6 class="text-muted m-b-0">Users</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-users f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#">
                                                      <div class="card-footer bg-c-purple text-center text-white">
                                                        <i class="fa fa-arrow-right text-white f-18"></i>
                                                      </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <h4 class="text-c-red"><?php echo number_format($ct->countExcludingDeleted('product_categories')); ?></h4>
                                                                <h6 class="text-muted m-b-0">Product Categories</h6>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                                <i class="fa fa-list f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#">
                                                      <div class="card-footer bg-c-red text-center text-white">
                                                        <i class="fa fa-arrow-right text-white f-18"></i>
                                                      </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-blue"><?php echo number_format($ct->countExcludingDeleted('suppliers')); ?></h4>
                                                                <h6 class="text-muted m-b-0">Customers</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-user-tie f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="suppliers.php">
                                                      <div class="card-footer bg-c-blue text-center text-white">
                                                        <i class="fa fa-arrow-right text-white f-18"></i>
                                                      </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-orenge"><?php echo number_format($ct->countExcludingDeleted('orders')); ?></h4>
                                                                <h6 class="text-muted m-b-0">Sales</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-truck f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="orders.php">
                                                      <div class="card-footer bg-c-lite-green text-center text-white">
                                                        <i class="fa fa-arrow-right text-white f-18"></i>
                                                      </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php if (USER_ROLE == 0) { ?>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-green"><?php echo number_format($ct->countExcludingDeleted('stores')); ?></h4>
                                                                <h6 class="text-muted m-b-0">Warehouses</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-warehouse f-32"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="warehouses.php">
                                                      <div class="card-footer bg-c-green text-center text-white">
                                                        <i class="fa fa-arrow-right text-white f-18"></i>
                                                      </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-blue"><?php echo number_format($ct->countExcludingDeleted('requests')); ?></h4>
                                                                <h6 class="text-muted m-b-0">Requests</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-question f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#">
                                                      <div class="card-footer bg-c-yellow text-center text-white">
                                                        <i class="fa fa-arrow-right text-white f-18"></i>
                                                      </div>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-blue"><?php echo number_format($ct->countExcludingDeleted('returned_orders')); ?></h4>
                                                                <h6 class="text-muted m-b-0">Returned Orders</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-history f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#">
                                                      <div class="card-footer bg-c-purple text-center text-white">
                                                        <i class="fa fa-arrow-right text-white f-18"></i>
                                                      </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-blue"<i class="fa fa-cash text-white f-18">New Sale</i></h4>
                                                                <h6 class="text-muted m-b-0">Quick Lik</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-cart-plus f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="outgoing-products.php">
                                                      <div class="card-footer bg-c-green text-center text-white">
                                                        <i class="fa fa-arrow-right text-white f-18"></i>
                                                      </div>
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            <?php
                                              if (USER_ROLE == 0 || USER_ROLE == 1 || USER_ROLE == 2) {
                                            ?>

                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Finance Analytics</h5>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                <li><i class="fa fa-minus minimize-card"></i></li>
                                                                <li><i class="fa fa-refresh reload-card"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <div id="chartdiv" style="height: 400px;"></div>
                                                        <div id="charterror" style="display: none;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                             <?php } ?>
                                            <!--  sale analytics end -->
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Required Jquery -->
    <script type="text/javascript" src="../assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="../assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap/js/bootstrap.min.js "></script>
    <script type="text/javascript" src="../assets/pages/widget/excanvas.js "></script>
    <!-- waves js -->
    <script src="../assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="../assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="../assets/js/modernizr/modernizr.js "></script>
    <!-- slimscroll js -->
    <script type="text/javascript" src="../assets/js/SmoothScroll.js"></script>
    <script src="../assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
    <!-- Chart js -->
    <script type="text/javascript" src="../assets/js/chart.js/Chart.js"></script>
    <!-- amchart js -->
    <script src="../assets/plugins/amchart/v4/core.js"></script>
    <script src="../assets/plugins/amchart/v4/charts.js"></script>
    <script src="../assets/plugins/amchart/v4/themes/animated.js"></script>
    <script src="../assets/plugins/amchart/v4/deps/pdfmake.js"></script>
    <script src="../assets/plugins/amchart/v4/deps/xlsx.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <!-- menu js -->
    <script src="../assets/js/pcoded.min.js"></script>
    <script src="../assets/js/vertical-layout.min.js "></script>
    <!-- custom js -->
    <script type="text/javascript" src="../assets/pages/dashboard/custom-dashboard.js"></script>
    <script type="text/javascript" src="../assets/js/script.js "></script>

    
    <script>
        $(function(){
            getVisualReport();
            function getVisualReport() {
                
                    $.ajax({
                        type        : 'GET',
                        url         : '../assets/data/select-data.php',
                        data        : {table:"all_finance_statement"}, 
                        dataType    : 'json',
                        encode      : true
                    })
                    .done(function(response) {
                      if (response.status === true) {
                        $('#chartdiv').css('display', 'block');
                        $('#charterror').css('display', 'none');
                        plotChart(response.values);

                      } else {
                        $('#chartdiv').css('display', 'none');
                        $('#charterror').css('display', 'block');
                        $('#charterror').html('<div class="text-center p-5"><h2>'+ response.errors +'</h2></div>');
                      }
                    })
                    .fail(function () {
                        $('#chartdiv').css('display', 'none');
                        $('#charterror').css('display', 'block');
                        $('#charterror').html('<div class="text-center p-5"><h2>Sorry, Could not Establish a connection.</h2></div>');
                    });

                } 
              
              // Set theme
              am4core.useTheme(am4themes_animated);
       
            // Create chart
            function plotChart(data) {
            var chart = am4core.createFromConfig({
                // Data
                "data": data, 
                // Category axis
                "xAxes": [
                  {
                    "type": "DateAxis",
                    "dataFields": {
                      "date": "date"
                    },
                    "dashLength": 1,
                    "minorGridEnabled": true
                  }
                ],

                // Value axis
                "yAxes": [
                  {
                    "type": "ValueAxis",
                    // "min": 0,
                    "tooltip": {
                      "disabled": true
                    }
                  }
                ],

                // Series
                "series": [
                  {
                    "id": "s1",
                    "type": "LineSeries",
                    "dataFields": {
                      "dateX": "date",
                      "valueY": "expense"
                    },
                    "tooltipText": "Expense: {valueY.value}",
                    "tooltip": {
                      "getFillFromObject": false,
                      "background": {
                        "fill": "#fca48e"
                      },
                      "label": {
                        "fill": "#000000"
                      }
                    },
                    "sequencedInterpolation": true,
                    "stroke": "#fa4316",
                    "strokeWidth": 2,
                  },
                  {
                    "id": "s2",
                    "type": "LineSeries",
                    "dataFields": {
                      "dateX": "date",
                      "valueY": "income"
                    },
                    "tooltipText": "Income: {valueY.value}",
                    "tooltip": {
                      "getFillFromObject": false,
                      "background": {
                        "fill": "#8afcb9"
                      },
                      "label": {
                        "fill": "#000000"
                      }
                    },
                    "sequencedInterpolation": true,
                    "stroke": "#05d85c", 
                    "strokeWidth": 2,
                  }
                ],
                // Add cursor
                "cursor": {
                  "behavior": "none",
                  "lineX": {
                    "opacity": 0
                  },
                  "lineY": {
                    "opacity": 0
                  }
                },

                // Add horizontal scrollbar
                "scrollbarX": {
                  "type": "XYChartScrollbar",
                  "series": ["s1", "s2"]
                },

                //Chart Title
                "titles": [{
                  "text": "Finances",
                  "fontSize": 25,
                  "tooltipText": "Income and Expenditures"
                }],

                //Exports
                "exporting": {
                  "menu": {
                    "align": "right",
                    "verticalAlign": "top"
                  },
                  "formatOptions": {
                    "csv": {
                      "disabled": true
                    },
                    "json": {
                      "disabled": true
                    },
                    "html": {
                      "disabled": true
                    }
                  }
                }

              },
              "chartdiv", "XYChart"
            );

            }
        })
    </script>
</body>

</html>
