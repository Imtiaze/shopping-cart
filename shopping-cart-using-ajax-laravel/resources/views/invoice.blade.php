<?php
//index.php
?>
<!DOCTYPE html>
<html>

<head>
    <title>PHP Ajax Shopping Cart by using Bootstrap Popover</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"><!-- for ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
    <style>
        .popover {
            width: 100%;
            max-width: 800px;
        }
    </style>
</head>

<body>
    <div class="container">
        <br />
        <h3 align="center"><a href="#">PHP Ajax Shopping Cart with Add Multiple Item into Cart</a></h3>
        <br />

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">Cart Details</div>
                    <div class="col-md-6" align="right">
                        <button type="button" name="clear_cart" id="clear_cart" class="btn btn-warning btn-xs">Clear</button>
                    </div>
                </div>
            </div>
            <div class="panel-body" id="shopping_cart">

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">Product List</div>
                    <div class="col-md-6" align="right">
                        <button type="button" name="add_to_cart" id="add_to_cart" class="btn btn-success btn-xs">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="panel-body" id="display_item">

            </div>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {

        // console.log('ready');

        load_product();
        load_cart_data();


        function load_cart_data() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('fetch-cart') }}",
                method: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#shopping_cart').html(data);
                }
            });
        }


        function load_product() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ url("fetch-item") }}',
                dataType: 'json',
                success: function(data) {
                    $('#display_item').html(data);
                }
            });
        }


        // color
        $(document).on('click', '.select_product', function() {
            var product_id = $(this).data('product_id');

            if ($(this).prop('checked') == true) {
                $('#product_' + product_id).css('background-color', '#f1f1f1');
                $('#product_' + product_id).css('border-color', '#333');
            } else {
                $('#product_' + product_id).css('background-color', 'transparent');
                $('#product_' + product_id).css('border-color', '#ccc');
            }
        });



        $('#add_to_cart').click(function() {
            var product_id = [];
            var product_name = [];
            var product_price = [];
            var action = "add";
            $('.select_product').each(function() {
                if ($(this).prop('checked') == true) {
                    product_id.push($(this).data('product_id'));
                    product_name.push($(this).data('product_name'));
                    product_price.push($(this).data('product_price'));
                }
            });

            if (product_id.length > 0) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ url('action') }}',
                    method: "POST",
                    data: {
                        product_id: product_id,
                        product_name: product_name,
                        product_price: product_price,
                    },
                    success: function(data) {

                        $('.select_product').each(function() {
                            if ($(this).prop('checked') == true) {
                                $(this).attr('checked', false);
                                var temp_product_id = $(this).data('product_id');
                                $('#product_' + temp_product_id).css('background-color', 'transparent');
                                $('#product_' + temp_product_id).css('border-color', '#ccc');
                            }
                        });

                        load_cart_data();
                        alert("Item has been Added into Cart");
                    }
                });
            } else {
                alert('Select atleast one item');
            }

        });

    });
</script>