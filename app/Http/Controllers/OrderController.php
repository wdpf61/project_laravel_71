<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Raziul\Sslcommerz\Facades\Sslcommerz;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        echo "order is completed";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $products = Product::where('status', 1)
            ->where('qty', '>', 0)
            ->orderBy('id', 'desc')
            ->get();

        $customers = Customer::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('orders.create', compact(
            'products',
            'customers'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',

            'products' => 'required|array|min:1',

            'products.*.product_id' => 'required|exists:products,id',

            'products.*.qty' => 'required|numeric|min:1',

            'discount' => 'nullable|numeric|min:0',

            'shipping_charge' => 'nullable|numeric|min:0',

            'tax' => 'nullable|numeric|min:0',

            'customer_note' => 'nullable|string',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Variables
        |--------------------------------------------------------------------------
        */

        $discount = (float) ($request->discount ?? 0);

        $shippingCharge = (float) ($request->shipping_charge ?? 0);

        $tax = (float) ($request->tax ?? 0);


        /*
        |--------------------------------------------------------------------------
        | Create Order + Order Details
        |--------------------------------------------------------------------------
        */

        $order = DB::transaction(function () use (
            $request,
            $discount,
            $shippingCharge,
            $tax
        ) {

            $subtotal = 0;


            /*
            |--------------------------------------------------------------------------
            | Calculate Subtotal
            |--------------------------------------------------------------------------
            */

            foreach ($request->products as $item) {

                $product = Product::lockForUpdate()
                    ->findOrFail($item['product_id']);

                $qty = (float) $item['qty'];

                if ($product->qty < $qty) {

                    throw new \Exception(
                        $product->name . ' stock is not available.'
                    );
                }

                $subtotal += $product->price * $qty;
            }


            /*
            |--------------------------------------------------------------------------
            | Grand Total
            |--------------------------------------------------------------------------
            */

            $grandTotal =
                $subtotal
                - $discount
                + $shippingCharge
                + $tax;


            if ($grandTotal < 0) {
                throw new \Exception(
                    'Grand total cannot be negative.'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Generate Order Number
            |--------------------------------------------------------------------------
            */

            $orderNo = 'OrderNO' . strtoupper(
                uniqid()
            );


            /*
            |--------------------------------------------------------------------------
            | Get Customer
            |--------------------------------------------------------------------------
            */

            $customer = Customer::findOrFail(
                $request->customer_id
            );


            /*
            |--------------------------------------------------------------------------
            | Create Order
            |--------------------------------------------------------------------------
            */

            $order = Order::create([

                'order_no' => $orderNo,

                'customer_id' => $customer->id,

                'subtotal' => $subtotal,

                'discount' => $discount,

                'shipping_charge' => $shippingCharge,

                'tax' => $tax,

                'grand_total' => $grandTotal,

                'currency' => 'BDT',

                'payment_status' => 'pending',

                'order_status' => 'pending',

                'payment_method' => 'SSLCommerz',

                'shipping_address' => $customer->address,

                'customer_note' => $request->customer_note,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Create Order Details
            |--------------------------------------------------------------------------
            */

            foreach ($request->products as $item) {

                $product = Product::lockForUpdate()
                    ->findOrFail($item['product_id']);

                $qty = (float) $item['qty'];

                $price = (float) $product->price;

                $total = $price * $qty;


                OrderDetails::create([

                    'order_id' => $order->id,

                    'product_id' => $product->id,

                    'product_name' => $product->name,

                    'sku' => null,

                    'price' => $price,

                    'qty' => $qty,

                    'discount' => 0,

                    'tax' => 0,

                    'total' => $total,
                ]);


                /*
                |--------------------------------------------------------------------------
                | Reduce Stock
                |--------------------------------------------------------------------------
                */

                $product->decrement('qty', $qty);
            }


            return $order;
        });


        /*
        |--------------------------------------------------------------------------
        | SSLCommerz Payment
        |--------------------------------------------------------------------------
        */

        $customer = Customer::findOrFail(
            $order->customer_id
        );


        $itemsQuantity = $order->details()->sum('qty');


        $response = Sslcommerz::setOrder(

                $order->grand_total,

                $order->order_no,

                'Order #' . $order->order_no

            )
            ->setCustomer(

                $customer->name,

                $customer->email,

                $customer->phone

            )
            ->setShippingInfo(

                $itemsQuantity,

                $customer->address

            )
            ->makePayment();


        /*
        |--------------------------------------------------------------------------
        | Redirect SSLCommerz
        |--------------------------------------------------------------------------
        */

        if ($response->success()) {

            return redirect(
                $response->gatewayPageURL()
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Payment Failed Before Gateway
        |--------------------------------------------------------------------------
        */

        $order->update([
            'payment_status' => 'failed'
        ]);


        return back()
            ->withInput()
            ->with(
                'error',
                'Unable to initiate payment.'
            );
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
