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
   		<h3 align="center">Simple PHP Mysql Shopping Cart using Cookies</h3><br />
   		<br /><br />
   
   		<div class="row">
		   <div class="col-md-3">
				<form method="post">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="images/1.jpg" class="img-responsive" /><br />

						<h4 class="text-info">Mobile Phone</h4>

						<h4 class="text-danger">$ 100.00</h4>

						<input type="text" name="quantity" value="1" class="form-control" />
						<input type="hidden" name="hidden_name" value="" />
						<input type="hidden" name="hidden_price" value="" />
						<input type="hidden" name="hidden_id" value="" />
						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
					</div>
				</form>
			</div>
			<div class="col-md-3">
				<form method="post">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="images/2.jpg" class="img-responsive" /><br />

						<h4 class="text-info">Notebook</h4>

						<h4 class="text-danger">$ 299.00</h4>

						<input type="text" name="quantity" value="1" class="form-control" />
						<input type="hidden" name="hidden_name" value="" />
						<input type="hidden" name="hidden_price" value="" />
						<input type="hidden" name="hidden_id" value="" />
						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
					</div>
				</form>
			</div>
			<div class="col-md-3">
				<form method="post">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="images/3.jpg" class="img-responsive" /><br />

						<h4 class="text-info">Mobile Lite</h4>

						<h4 class="text-danger">$ 125.00</h4>

						<input type="text" name="quantity" value="1" class="form-control" />
						<input type="hidden" name="hidden_name" value="" />
						<input type="hidden" name="hidden_price" value="" />
						<input type="hidden" name="hidden_id" value="" />
						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
					</div>
				</form>
			</div>
			<div class="col-md-3">
				<form method="post">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="images/4.jpg" class="img-responsive" /><br />

						<h4 class="text-info">Writst Watch</h4>

						<h4 class="text-danger">$ 85.00</h4>

						<input type="text" name="quantity" value="1" class="form-control" />
						<input type="hidden" name="hidden_name" value="" />
						<input type="hidden" name="hidden_price" value="" />
						<input type="hidden" name="hidden_id" value="" />
						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
					</div>
				</form>
			</div>
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