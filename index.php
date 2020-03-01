<?php

	$connect = new PDO("mysql:host=localhost;dbname=weblessions_shopping_cart_php_mysql_cookies", "root", "");


?>

<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<title>Shopping Cart</title>
</head>
<body>

	<br />
  	<div class="container">
   		<br />
   		<h3 align="center">Simple PHP Mysql Shopping Cart using Cookies</h3><br/><br/><br/> 

   
   		<div class="row">
		   <?php
				$query 	   = "SELECT * FROM products ORDER BY id ASC";
				$statement = $connect->prepare($query);
				$statement->execute();
				$result    = $statement->fetchAll();

				foreach($result as $row)
				{
					?>
						<div class="col-md-3">
							<form method="post">
								<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
									<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />

									<h4 class="text-info"><?php echo $row["name"]; ?></h4>

									<h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

									<input type="text" name="quantity" value="1" class="form-control" />
									<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
									<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
									<input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>" />
									<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
								</div>
							</form>
						</div>
					<?php
				}
			?>
		</div>

		<div style="clear:both"></div>
		<br />
		<h3>Order Details</h3>
		<div class="table-responsive">
			<div align="right">
				<a href="index.php?action=clear"><b>Clear Cart</b></a>
			</div>
			<table class="table table-bordered">
				<tr>
					<th width="40%">Item Name</th>
					<th width="10%">Quantity</th>
					<th width="20%">Price</th>
					<th width="15%">Total</th>
					<th width="5%">Action</th>
				</tr>
				<tr>
					<td>test</td>
					<td>test</td>
					<td>test</td>
					<td>test</td>
					<td>
						<a href=""><span class="text-danger">Remove</span></a>
					</td>
				</tr>
   
				<tr>
					<td colspan="3" align="right">Total</td>
					<td align="right">test</td>
					<td></td>
				</tr>
 
				<tr>
					<td colspan="5" align="center">No Item in Cart</td>
				</tr>
			</table>
		</div>
	</div>
	<br />
 

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>