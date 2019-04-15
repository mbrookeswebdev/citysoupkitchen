<?php

namespace App;

use Illuminate\Support\Facades\DB;

class ShoppingCart
{
    private $products = null;
    private $totalQuantity = 0;
    public $totalPrice = 0;
    private $delivery = null;

    /**
     * @return null
     */
    public function getProducts ()
    {
        return $this->products;
    }

    /**
     * @return float
     */
    public function getTotalPrice (): float
    {
        return $this->totalPrice;
    }

    /**
     * @return null
     */
    public function getDelivery ()
    {
        return $this->delivery;
    }

    public function addProduct ($id)
    {
        // find the product in the database by it's id.
        $product = DB::table('products')->where('id', $id)->first();
        //add it to the products array
        $storedProduct = ['product' => $product, 'quantity' => 0, 'price' => $product->price];
        // or if this product has been added before, select it from the array
        if ($this->products) {
            if (array_key_exists($product->id, $this->products)) {
                $storedProduct = $this->products[$product->id];
            }
        }
        // increase quantity of the product in shopping cart
        $storedProduct['quantity']++;
        //calculate the total price of the product units
        $storedProduct['price'] = $product->price * $storedProduct['quantity'];
        $this->products[$product->id] = $storedProduct;
        // calculate the total quantity of all products in a cart
        $this->totalQuantity++;
        // add newly added product's price to total price
        $this->totalPrice += $product->price;
    }

    public function removeProduct ($id)
    {
        // find the product in the database by it's id.
        $product = DB::table('products')->where('id', $id)->first();
        //if product already exists in a shopping cart
        if ($this->products) {
            if (array_key_exists($product->id, $this->products)) {
                $storedProduct = $this->products[$product->id];
                // decrease the total quantity and total price
                $this->totalQuantity--;
                $this->totalPrice -= $product->price;
                // if there is more than one product
                if ($storedProduct['quantity'] > 1) {
                    // decrease quantity of the product in the shopping cart
                    $storedProduct['quantity']--;
                    //calculate the total price of the product units
                    $storedProduct['price'] = $product->price * $storedProduct['quantity'];
                    $this->products[$product->id] = $storedProduct;
                } else {
                    // otherwise, remove the product from the shopping cart if quantity is less than one
                    unset($this->products[$product->id]);
                }
            }
        }
    }

    // delete all products from the shopping cart
    public function deleteAll ()
    {
        unset($this->products);
        $this->totalQuantity = 0;
        $this->totalPrice = 0;
        $this->delivery = null;
    }

    // recalculate totalPrice if the user opted for a delivery
    public function recalculate ($deliveryAdded)
    {
        if (($deliveryAdded) && ($this->delivery == null)) {
            $this->totalPrice = $this->totalPrice + 2.99;
            $this->delivery = true;
        } else {
            if ((!$deliveryAdded) && ($this->delivery == true)) {
                $this->totalPrice = $this->totalPrice - 2.99;
                $this->delivery = false;
            }
        }
    }

    // return no of products in the shopping cart
    public function count ()
    {
        return $this->totalQuantity;
    }
}



