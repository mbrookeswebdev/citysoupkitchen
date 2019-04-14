<?php

namespace App\Http\Controllers;

use App\OrderItem;
use App\ShoppingCart;
use App\Product;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    // display all available products on the main shop page
    public function getAllProducts ()
    {
        $products = Product::all();
        return view('shop.index', ['products' => $products]);
    }

    // display shopping cart
    public function getShoppingCart (Request $request)
    {
        if ($request->session()->has('shoppingCart')) {
            $shoppingCart = session('shoppingCart');
            return view('shop.shoppingcart', ['shoppingCart' => $shoppingCart, 'products' => $shoppingCart->products, 'totalPrice' => $shoppingCart->totalPrice, 'message' => 'You have deleted all products.']);
        } else {
            return view('shop.shoppingcart')->with('message', 'You have no products selected.');
        }
    }

    // add one product to the shopping cart
    public function addOneProduct (Request $request)
    {
        $id = $request->route('id');
        // if shopping cart has already been created
        if ($request->session()->exists('shoppingCart')) {
            $shoppingCart = $request->session()->get('shoppingCart');
            $shoppingCart->addProduct($id);
            return redirect()->action('ShopController@getShoppingCart');
        } else {

            // if shopping cart does not exist
            $shoppingCart = new ShoppingCart();
            $shoppingCart->addProduct($id);
            $request->session()->put('shoppingCart', $shoppingCart);
            return redirect()->action('ShopController@getShoppingCart');
        }
    }

    // remove a product from the shopping cart
    public function removeOneProduct (Request $request)
    {
        $id = $request->route('id');
        // if shopping cart exist
        if ($request->session()->exists('shoppingCart')) {
            $shoppingCart = $request->session()->get('shoppingCart');
            $shoppingCart->removeProduct($id);
            return redirect()->action('ShopController@getShoppingCart');
        } else {
            // if shopping cart does not exist
            return view('shop.shoppingcart')->with('message', 'You have no products selected.');
        }
    }

    // remove all products from the shopping cart and delete it
    public function removeAllProducts (Request $request)
    {
        if ($request->session()->exists('shoppingCart')) {
            $shoppingCart = $request->session()->get('shoppingCart');
            $shoppingCart->deleteAll();
            $request->session()->forget('shoppingCart');
            return view('shop.shoppingcart')->with('message', 'The products have been deleted.');
        } else {
            return view('shop.shoppingcart')->with('message', 'You have no products selected.');
        }
    }

    // re-calculate the final price depending on delivery/collection
    public function reCalculate (Request $request)
    {
        $shoppingCart = $request->session()->get('shoppingCart');

        if ($request->has('delivery') && $shoppingCart->totalPrice != 0) {
            $deliveryAdded = true;
            $shoppingCart->reCalculate($deliveryAdded);
        } else {
            $deliveryAdded = false;
            $shoppingCart->reCalculate($deliveryAdded);
        }
        return view('shop.shoppingcart', ['products' => $shoppingCart->products, 'totalPrice' => $shoppingCart->totalPrice, 'shoppingCart' => $shoppingCart]);
    }

    // make a payment for selected products (no pay provider implemented)
    // and create a new order in the database
    public function pay (Request $request)
    {
        //get shopping cart from session
        $shoppingCart = $request->session()->get('shoppingCart');
        //set collection/delivery, depending on user choice
        if ($shoppingCart->delivery == true) {
            $method = "delivery";
        } else {
            $method = "collection";
        }
        $id = Auth::id();
        //create a new order
        $order = new Order(array(
            'user_id' => $id,
            'method' => $method,
            'totalPrice' => $shoppingCart->totalPrice,
            'status' => 'pending'
        ));
        $order->save();
        //get a new order id
        $orderNo = $order->id;
        //create an order item out of each ordered product
        foreach ($shoppingCart->products as $item) {
            $orderItem = new OrderItem(array(
                'order_id' => $orderNo,
                'product_id' => $item['product']->id,
                'productQuantity' => $item['quantity']
            ));
            $orderItem->save();
        }
        //delete products from session
        $request->session()->flush();
        //update user
        return view('shop.success')->with('status', 'Your reference number is: ' . $order->id);
    }

    // display all user's orders
    public function displayOrders ()
    {
        $id = Auth::id();
        $user = User::find($id);
        $userName = $user->name;
        $orders = User::find($id)->order;

        if (count($orders) > 0) {
            $orders = $orders->sortBy('id');
            // find in the database all orders that belong to that user
            $orderedProducts = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->select('products.title', 'products.description', 'products.price')
                ->get();
            return view('shop.displayallorders', ['userName' => $userName, 'orders' => $orders, 'products' => $orderedProducts, 'message' => 'Please review your order(s) below: ']);
        } else {
            // if the users has no orders
            return view('shop.displayallorders', ['userName' => $userName, 'message' => 'You have no products ordered.']);
        }
    }

    // show the order details
    public function showOrder ($id)
    {
        $order = Order::find($id);
        $orderTotalPrice = $order->totalPrice;
//        $orderItems = Order::all()->find($id)->orderItem;
        $orderStatus = $order->status;
        $orderItems = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')->where('order_items.order_id', '=', $id)
            ->select('products.title', 'products.description', 'products.price', 'order_items.productQuantity')
            ->get();
        return view('shop.showorder', ['order' => $order, 'orderItems' => $orderItems, 'orderStatus' => $orderStatus, 'orderTotalPrice' => $orderTotalPrice, 'message' => 'Please review below the product(s) you ordered:']);
    }

    // delete order (only possible if it's status changed to 'completed')
    public function deleteOrder ($id)
    {
        $order = Order::find($id);
        if ($order->status == 'completed') {
            DB::table('order_items')->where('order_id', '=', $order->id)->delete();
            DB::table('orders')->where('id', '=', $id)->delete();
        }
        return redirect()->action('ShopController@displayOrders')->with('status', 'Your order was deleted!');
    }
}
