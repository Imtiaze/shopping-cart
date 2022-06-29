<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShoppingCartController extends Controller
{
    public function cart()
    {
        // dd('asdf');
        return view('cart');
    }


    public function fetchItem(Request $request)
    {
        $result = Product::get();

        $output = '';
        foreach ($result as $row) {
            $output .= '
            <div class="col-md-3" style="margin-top:12px;margin-bottom:12px;">  
                <div style="border:1px solid #ccc; border-radius:5px; padding:16px; height:300px;" align="center" id="product_' . $row["id"] . '">
                <img src="images/' . $row["image"] . '" class="img-responsive" /><br />
                <h4 class="text-info">
                            <div class="checkbox">
                                <label><input type="checkbox" class="select_product" data-product_id="' . $row["id"] . '" data-product_name="' . $row["name"] . '" data-product_price="' . $row["price"] . '" value="">' . $row["name"] . '</label>
                            </div>
                    </h4>
                <h4 class="text-danger">$ ' . $row["price"] . '</h4>
                </div>
            </div>
        ';
        }
        return response()->json($output);
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
        // dd($product_id);
        $product_name = $request->product_name;
        $product_price = $request->product_price;
        // dd($request->all(), count($product_id));
        // dd(session('shopping_cart'));
        // dd(Cache::get('shopping_cart'));
        
        for ($count = 0; $count < count($product_id); $count++) {
            // dd(session('shopping_cart'));
            $cart_product_id =  Cache::has('shopping_cart') ? array_keys(Cache::get('shopping_cart')) : [];
            // dd($cart_product_id, session::has('shopping_cart') && in_array($product_id[$count], $cart_product_id));
            
            if (Cache::has('shopping_cart') && in_array($product_id[$count], $cart_product_id)) {
                // Cache::put(Cache::get('shopping_cart')[$product_id[$count]]['product_quantity'], 500);
                $cacheArray = Cache::get('shopping_cart');
                $cacheArray[$product_id[$count]]['product_quantity'] = $cacheArray[$product_id[$count]]['product_quantity'] + 1;
                Cache::put('shopping_cart', $cacheArray);
            } else {
                $item_array = array(
                    'product_id'               =>     $product_id[$count],
                    'product_name'             =>     $product_name[$count],
                    'product_price'            =>     $product_price[$count],
                    'product_quantity'         =>     1
                );


                $cart[$product_id[$count]]  = $item_array;
                // session(['shopping_cart' => $cart]);
                Cache::put('shopping_cart', $cart);
                
            }
        }

        // dd(Cache::get('shopping_cart'));
        
        // dd('exit', session('shopping_cart'));
    }

    public function fetchCart()
    {

        $total_price = 0;
        $total_item = 0;

        $output = '
                <div class="table-responsive" id="order_table">
                <table class="table table-bordered table-striped">
                <tr>  
                            <th width="40%">Product Name</th>  
                            <th width="10%">Quantity</th>  
                            <th width="20%">Price</th>  
                            <th width="15%">Total</th>  
                            <th width="5%">Action</th>  
                        </tr>
                ';
        if (Cache::has('shopping_cart')) {
            foreach (Cache::get('shopping_cart') as $keys => $values) {
                $output .= '
                    <tr>
                    <td>' . $values["product_name"] . '</td>
                    <td>' . $values["product_quantity"] . '</td>
                    <td align="right">$ ' . $values["product_price"] . '</td>
                    <td align="right">$ ' . number_format($values["product_quantity"] * $values["product_price"], 2) . '</td>
                    <td><button name="delete" class="btn btn-danger btn-xs delete" id="' . $values["product_id"] . '">Remove</button></td>
                    </tr>
                    ';
                $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
                //$total_item = $total_item + 1;
            }
            
            $output .= '
                    <tr>  
                            <td colspan="3" align="right">Total</td>  
                            <td align="right">$ ' . number_format($total_price, 2) . '</td>  
                            <td></td>  
                        </tr>
                    ';
        } else {

            $output .= '
                        <tr>
                        <td colspan="5" align="center">
                        Your Cart is Empty!
                        </td>
                        </tr>
                        ';
        }
        $output .= '</table></div>';
        

        return response()->json($output);
    }


    public function removeFromCart(Request $request)
    {
        foreach (Cache::get('shopping_cart') as $keys => $values) {
            if ($values["product_id"] == $request->product_id) {
                // unset($_SESSION["shopping_cart"][$keys]);
                Cache::forget($keys);
            }
        }
    }
}
