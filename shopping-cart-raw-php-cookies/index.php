<?php

	$connect = new PDO("mysql:host=localhost;dbname=weblessions_shopping_cart_php_mysql_cookies", "root", "");



	if (isset($_POST["add_to_cart"])) 
	{
		if (isset($_COOKIE["shopping_cart"]))
		{
			$cookie_data = stripcslashes($_COOKIE["shopping_cart"]);
			$cart_data   = json_decode($cookie_data, true);
		}
		else
		{
			$item_array = array();
		}

		$item_id_list = array_column($cart_data, 'item_id');

		if (in_array($_POST['hidden_id'], $item_id_list)) 
		{
			foreach ($cart_data as $keys => $values) {
				if ($cart_data[$keys]['item_id'] ==  $_POST["hidden_id"]) 
				{
					$cart_data[$keys]['item_quantity'] = $cart_data[$keys]["item_quantity"] + ($_POST["quantity"] <= '0' ? '1' : $_POST["quantity"]);
				}
			}
		}
		else 
		{
			$item_array = array(
				'item_id' 		=> $_POST["hidden_id"],
				'item_name' 	=> $_POST["hidden_name"],
				'item_price' 	=> $_POST["hidden_price"],
				'item_quantity' => $_POST["quantity"] <= '0' ? '1' : $_POST["quantity"],
			);
	
			$cart_data[] = $item_array;
		}


		
		$item_data = json_encode($cart_data);
		
		setcookie('shopping_cart', $item_data, time() + (86400 * 30));

		header("location:index.php?success=1");
	}

	if (isset($_GET["action"]))
	{
		if (isset($_GET["action"]) == 'delete') 
		{
			$cookie_data = stripslashes($_COOKIE['shopping_cart']);
			$cart_data	 = json_decode($cookie_data, true);

			foreach($cart_data as $keys => $values)
			{
				if ($cart_data[$keys]['item_id'] == $_GET["id"])
				{
					unset($cart_data[$keys]);
					$item_data = json_encode($cart_data);
					setcookie("shopping_cart", $item_data, time() + (86400 * 30));
					header("location:index.php?remove=1");
				}
			}
		}
	}

	if (isset($_GET['success']))
	{
		$message = '
			<div class="alert alert-success alert-dismissiable">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Item Added into Cart
			</div>
		';
	}

	if (isset($_GET['remove']))
	{
		$message = '
			<div class="alert alert-danger alert-dismissiable">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Item Remove from Cart
			</div>
		';
	}

	if (isset($_GET['action']))
	{
		if ($_GET['action'] == 'clear')
		{
			setcookie("shopping_cart", "", time() - 3600);
			header("location:index.php");
		}
	}

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

		<?php if (isset($message)) echo $message;  ?>

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

				<?php 

					if (isset($_COOKIE["shopping_cart"]))
					{
						$total = 0;

						$cookie_data = stripcslashes($_COOKIE["shopping_cart"]);

						$cart_data = json_decode($cookie_data, true);

						foreach ($cart_data as $keys => $values) 
						{
							?>
								<tr>
									<td><?php echo $values["item_name"]; ?></td>
									<td><?php echo $values["item_quantity"]; ?></td>
									<td><?php echo $values["item_price"]; ?></td>
									<td><?php echo ($values["item_price"] * number_format($values["item_quantity"])); ?></td>
									<td>
										<a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a>
									</td>
								</tr>	
							<?php

								$total =  $total + ($values["item_price"] * number_format($values["item_quantity"]));
						}

						  	?>
								<tr>
									<td colspan="3" align="right">Total</td>
									<td align="right"><?php echo $total; ?></td>
									<td></td>
								</tr>
							<?php				
					}
					else
					{
						echo '
							<tr>
								<td colspan="5" align="center">No Item in Cart</td>
							</tr>
						';
					}

				?>

			</table>
		</div>
	</div>
	<br />
 

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>