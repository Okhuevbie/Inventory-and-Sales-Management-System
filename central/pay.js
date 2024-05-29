// JavaScript Document
function pay()
{
	str=document.getElementById('invoiceno').value;
	customer=document.getElementById('customer').value;	
	phone=document.getElementById('phone').value;
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	document.getElementById("txtHint").innerHTML="";	
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","pay.php?pid="+str+"customer="+customer+"phone="+phone,true);
xmlhttp.send();
//window.print(str);
//window.location.href="checkoutprint.php";
}

