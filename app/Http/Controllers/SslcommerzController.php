<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SslcommerzController extends Controller
{
    /**
     * Payment successful
     */
    public function success(Request $request)
    {
        $orderNo = $request->input('tran_id');

        $order = Order::with([
            'customer',
            'details'
        ])
            ->where('order_no', $orderNo)
            ->firstOrFail();

        // validate SSLCommerz here

        $order->update([
            'payment_status' => 'paid',
            'order_status' => 'confirmed',
        ]);

        return view(
            'orders.success',
            compact('order')
        );
    }

    /**
     * Payment failed
     */
    public function failure(Request $request)
    {
        $orderNo = $request->input('tran_id');

        $order = Order::where(
            'order_no',
            $orderNo
        )->first();

        if ($order) {

            $order->update([
                'payment_status' => 'failed',
            ]);
        }

        return view(
            'orders.failure',
            compact('order')
        );
    }

    /**
     * Payment cancelled by customer
     */
    public function cancel(Request $request): RedirectResponse
    {
        $data = $request->all();

        // TODO:
        // Update payment/order as cancelled

        return redirect()
            ->route('order.payment')
            ->with('error', 'Payment was cancelled.');
    }

    /**
     * Instant Payment Notification
     */
    public function ipn(Request $request)
    {
        $data = $request->all();

        // Example:
        // $tran_id = $request->tran_id;
        // $amount = $request->amount;
        // $status = $request->status;

        // TODO:
        // Verify SSLCommerz transaction
        // Update payment/order status

        return response()->json([
            'success' => true,
            'message' => 'IPN received',
        ]);
    }
}
