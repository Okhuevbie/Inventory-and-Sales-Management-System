<?php
session_start();
include '../includer.inc.php';
Session::checkCentralStoreSession();

$order = 0;
if (isset($_GET['invoice_id'])) {
    $order = intval($_GET['invoice_id']);
}
$getOrder = $sl->selectOneMatchTwoJoinedOrderedExcludeDeletedLimited('orders','warehouse_id','stores','id','name','orders','id',$order,'id','ASC','0','1');
if ($getOrder) {
    $orow = $getOrder->fetch_assoc();
    $customer_name = $orow['supplier_id'];
    $name = $sl->getName('suppliers','supplier_name','id',$customer_name);
}else{
  echo '<div class="text-center m-5"><h4>Sorry, Could not Establish a connection.</h4></div>';
  exit();
}




// $paid=$_GET['paid'];
// function getcust($link,$inv){
// $customer="select company,contactperson from customer where customerid='$inv'";
// $qry_cust=mysqli_query($link,$customer);
// if(!$qry_cust){
// 	print mysqli_error($link);
	
// }
// list($customername,$person)=mysqli_fetch_row($qry_cust);

// return $customername." ".$person;
// }

?>
<script language="javascript" type="text/javascript" src="pay.js"> </script>
<style type="text/css">

.style0 {
	font-size: 26px;
	font-weight: bold;
}
.style1 {
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-size: 14px}
#apDiv1 {
	position:absolute;
	left:290px;
	top:233px;
	width:637px;
	height:440px;
	z-index:1;
}
.style3 {font-size: 14px}

</style>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Receipt | Warehouse System</title>
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
      <meta name="author" content="codedthemes, itec247 Limited" />
      <!-- Favicon icon -->
      <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
      <!-- Google font-->     
      <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet"> -->
      <!-- waves.css -->
      <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/css/bootstrap.min.css">
      <!-- toastr -->
      <link rel="stylesheet" type="text/css" href="../assets/plugins/toastr/toastr.css">
      <!-- SweetAlert2 -->
      <!-- <link rel="stylesheet" type="text/css" href="../assets/plugins/sweetalert2/sweetalert2.css"> -->
      <link rel="stylesheet" type="text/css" href="../assets/plugins/sweetalert/css/sweetalert.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/themify-icons/themify-icons.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/fontawesome/css/all.min.css">
      <!-- <link rel="stylesheet" type="text/css" href="../assets/icon/font-awesome2/css/font-awesome.min.css"> -->
      <!-- datatables -->
      <link rel="stylesheet" type="text/css" href="../assets/plugins/DataTables/datatables.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="../assets/css/jquery.mCustomScrollbar.css">
  </head>
  <?php
$getItems = $sl->selectOneMatchTwoJoinedOrderedExcludeDeleted('order_items', 'product_price_id', 'products', 'id', 'product_name', 'order_items', 'order_id', $order, 'id', 'ASC');
if ($getItems) {
  $i = 0;
  while ($row = $getItems->fetch_assoc()) {
      // $itemno[$i]=$row['product_price_id'];
      $itemno[$i] = $sl->getName('products','tracking_id','id',$row['product_price_id']);
      $mdesc[$i] = $sl->getName('products','product_name','id',$row['product_price_id']);
      // $mdesc[$i]=$row['description'];
      $mqty[$i]=$row['quantity'];
      $upr[$i]=number_format($row['unit_price'],2);

      $am[$i]=number_format($row['subtotal'],2);
      $i++;
  }
}else{
    echo '<div class="text-center m-5"><h4>Sorry, No Product Bought With the id: '.$orow['invoice_id'].'.</h4><br><h6>Products Bought Most Have Been Deleted, PLease Contact the Admin or Customer Service to rectify the issue</h6></div>';
    exit();
}
  ?>
    <body onLoad="window.opener.location.reload();">
        <table width="35%" style="border:1px solid #333333; background:url(); height:600px;" align="center">
          <tr>
          <!-- <td colspan="5"><div align="center"><img src=""/></div></td> -->
          <td colspan="5"><div  class="style0" align="center"><span ></span><i> <?php print $orow['name'];?></i></div></td>
          </tr>
        <tr>
          
          <td colspan="2" rowspan="2">
            <div align="left" class="style1 "><span class="style3">Customer Name:</span><i> <?php print $name;?></i></div>    
          <td colspan="3"><strong>Invoice No</strong>: <?php echo $orow['invoice_id'];?> </td>
          </tr>
        <tr>
          <td colspan="3"><strong>Date</strong>: <?php echo $fm->DateFormat7($orow['added_date']);?></td>
        </tr>
        <tr style="background:#666666; color:#FFFFFF;">
        <td height="29" style="border:1px solid #666666;"><strong> Item Number </strong></td>
        <td width="46%" style="border:1px solid #666666;" align="center"><strong>  Description of Goods</strong></td> 
        <td width="13%" style="border:1px solid #666666;"><strong>Quantity</strong></td>
        <td ><strong> Unit Price </strong></td>
        <td><strong>Amount </strong></td>
        </tr>


        

        <tr style="border:1px dashed #666666">
        <td valign="top" style="border:1px solid #cccccc;"> <strong>
        <?php 
          foreach($itemno as $item){
          print $item."<br>";
          }
        ?>
        </strong></td>
        <td valign="top" style="border:1px solid #cccccc;"><strong>
        <?php 
        foreach($mdesc as $desc){
          print $desc."<br>";
        }
        ?>
        </strong></td>
        <td valign="top" style="border:1px solid #cccccc;"><strong>
          <?php  
        foreach($mqty as $qty){
          print $qty."<br>";
        }
            ?>
        </strong></td> 
        <td valign="top" style="border:1px solid #cccccc;"><strong>
        <?php 
        foreach($upr as $pr){
          print $pr."<br>";
        }
        
        ?>
        </strong> </td>
        <td valign="top" style="border:1px solid #cccccc;"><strong>
        <?php 
        foreach($am as $myam){
          print $myam."<br>";
        }
        ?></strong></td>
        </tr>


        <tr style="border:1px dashed #666666">
          <td colspan="3" style="border-bottom:2px double #666666; font-size:12px; font-weight:bold; background-color:#FFFFFF;border:1px solid #cccccc;">Total Sales </td>
          <td colspan="2" style="border-bottom:2px double #666666; font-size:15px; font-weight:bold; background-color:#FFFFFF; border:1px solid #cccccc;" valign='top'><?php
          $total = $orow['total'];
          echo "NGN ".number_format($total, 2)."<br>"; 
          ?>
            </td>
        </tr>
        <tr style="border:1px dashed #666666">
          <td height="26" colspan="3" style="border-bottom:2px double #666666; font-size:12px; font-weight:bold; background-color:#FFFFFF;border:1px solid #cccccc;">Discount</td>
          <td colspan="2" style="border-bottom:2px double #666666; font-size:15px; font-weight:bold; background-color:#FFFFFF; border:1px solid #cccccc;" valign='top'><?php echo "NGN ".number_format($orow['discount'], 2); ?></td>
        </tr>
        <tr style="border:1px dashed #666666">
          <td colspan="3" style="border-bottom:2px double #666666; font-size:12px; font-weight:bold; background-color:#FFFFFF;border:1px solid #cccccc;">Amount Paid</td>
          <td colspan="2" style="border-bottom:2px double #666666; font-size:15px; font-weight:bold; background-color:#FFFFFF; border:1px solid #cccccc;" valign='top'><?php
          $paid = $ct->sumMatchThreeExcludingDeleted('finances','amount','table_name','orders','item_id',$order,'category','Income');
          echo "NGN ".number_format($paid, 2);
          ?>
        </td>
        </tr>
        <tr style="border:1px dashed #666666"><td colspan="3" style="border-bottom:2px double #666666; font-size:18px; font-weight:bold; background-color:#FFFFFF;border:1px solid #cccccc;"><span style="border-bottom:2px double #666666; font-size:12px; font-weight:bold; background-color:#FFFFFF;border:0px solid #cccccc;">Balance Due</span></td>
          <td colspan="2" style="border-bottom:2px double #666666; font-size:15px; font-weight:bold; background-color:#FFFFFF; border:1px solid #cccccc;"><?php 
          $balance = $total - $paid;
          echo "NGN ".number_format($balance, 2);
          ?></td>
        </tr>
        <tr style="border:1px dashed #666666">
          <td height="64" colspan="5" style="border-bottom:2px double #666666; font-size:18px; font-weight:bold; background-color:#FFFFFF;border:1px solid #cccccc;" valign="bottom"><span class="style2">Customer Sign</span>______________________ <span class="style2">Phone: <?php 
          $phone_no = $sl->getName('suppliers','phone','id',$customer_name);
          echo $phone_no ?></span></td>
          </tr>
        <tr style="border:1px dashed #666666">
          <td height="30" colspan="3" style="border-bottom:0px double #666666; font-size:18px; font-weight:bold; background-color:#FFFFFF;border:1px solid #cccccc;"><span class="style2">Thanks for your Patronage. Items Bought in Good Conditions are not Returnable</span></td>
          <td colspan="2" style="border-bottom:2px double #666666; font-size:18px; font-weight:bold; background-color:#FFFFFF;border:0px solid #cccccc;"><span class="style2">Cashier: <?php 
          $user = Session::get('user_fullname');
          echo $user;?></span></td>
        </tr>
        <tr style="border:1px dashed #666666">
          <td height="12" colspan="5" align="center" style="border-bottom:0px double #666666; font-size:14px; font-weight:bold; background-color:#333333;color:#ffffff;border:1px solid #cccccc;">Software By: O.J Toluwani and Richard Pam.<br><i class="fa fa-phone"></i> 08138450009 || 09071482526</td>
          </tr>
          <?php 
          $uid = USERID;
          $user_phone_no = $sl->getName('users','phone','id',$uid);
          $_SESSION['phone']=$user_phone_no;
        ?>
        </table>
        <script>
        window.print();
        //window.close();
        //location.replace("alertSMS.php");
        </script>
        <?php 
        //header("location:alertSMS.php?phone=$_GET[phone]");
        //exit();
        ?>
  </body>
</html>