<?php
  // create short variable names
  $BloodAgar= $_POST['BloodAgar'];
  $ChocolateAgar = $_POST['ChocolateAgar'];
  $SabouradAgar = $_POST['SabouradAgar'];
  $MacConkeyAgar = $_POST['MacConkeyAgar'];

?>
<html>
<head>
  ---------------------------------------------------------------------------
  <title>BioSolutions - Order Results</title>
</head>
<body>
<h1>BioSolutions Products</h1>
<h2>Order Results</h2>
<?php

	echo "<p>Order processed at ".date('H:i, jS F Y')."</p>";

	echo "<p>Your order is as follows: </p>";

	$totalqty = 0;
	$totalqty = $BloodAgar + $ChocolateAgar + $SabouradAgar + $MacConkeyAgar;
	echo "Items ordered: ".$totalqty."<br />";


	if ($totalqty == 0) {

	  echo "You did not order anything on the previous page!<br />";

	} else {

	  if ($BloodAgar > 0) {
		echo $BloodAgar." Blood Agar<br />";
	  }

	  if ($ChocolateAgar > 0) {
		echo $ChocolateAgar." Chocolate Agar<br />";
	  }

	  if ($SabouradAgar > 0) {
		echo $SabouradAgar." Sabourad Agar<br />";
	  }
          if ($MacConkeyAgar > 0) {
                echo $MacConkeyAgar." MacConkey Agar<br />";
          }


	}


	$totalamount = 0.00;

	define('BloodAgar', 3);
	define('ChocolateAgar', 5);
	define('SabouradAgar', 2);
        define('MacConkeyAgar',6);


	$totalamount = $BloodAgar * BloodAgar
				 + $ChocolateAgar * ChocolateAgar
				 + $SabouradAgar * SabouradAgar
         + $MacConkeyAgar * MacConkeyAgar;


	echo "Subtotal: $".number_format($totalamount,2)."<br />";

	$taxrate = 0.25;  // local sales tax is 25%
	$totalamount = $totalamount * (1 + $taxrate);
	echo "Total including tax: $".number_format($totalamount,2)."<br />";


?>
--------------------------------------------------------------------------
</body>
</html>
