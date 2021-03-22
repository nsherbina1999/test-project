<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class OrderController extends Controller
{
    /**
     * Show the checkout for a given product.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function checkout(Request $request)
    {
        return view('order.checkout', ['item' => Product::findOrFail($request->id), 'shipments' => Shipment::all()]);
    }

    /**
     * Stores the data of a chosen buy.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateOrderRequest $request)
    {
        try {
            $order = Order::create([
                'product_id' => $request->item_id,
                'total_product_value' => Product::findOrFail($request->item_id)->price,
                'total_shipping_value' => Shipment::findOrFail($request->shipment_id)->price,
                'client_name' => $request->client_name,
                'client_address' => $request->client_address,
            ]);
            Mail::to(config('app.admin_email'))->send(new OrderCreated($order));

            return redirect()->route('product.show')
                ->with(['message' => 'Your order is done. Order ID is ' . $order->id . '.']);
        } catch (Throwable $e) {
            return redirect()->route('product.show')
                ->with(['message' => $e->getMessage()]);
        }
    }
}
