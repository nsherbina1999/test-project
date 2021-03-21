<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\Product;
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
        return view('order.checkout', ['item' => Product::findOrFail($request->id)]);
    }

    /**
     * Stores the data of a chosen buy.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'client_name' => 'required|string|max:255',
            'client_address' => 'required|string|max:255',
            'shipment' => 'required|boolean',
            'credit_card_number' => 'required|integer|digits:16',
            'credit_card_cvv' => 'required|integer|digits:3',
            'credit_card_expire' => 'required|integer|digits:4',
        ]);

        try {
            $order = new Order;
            $order->total_product_value = Product::findOrFail($request->item_id)->price;
            $order->total_shipping_value = $order->getShipmentAttribute($request);
            $order->client_name = $request->client_name;
            $order->client_address = $request->client_address;
            $order->save();

            $data = [
                'id' => $order->id,
                'item_name' => Product::findOrFail($request->item_id)->name,
                'total_product_value' => $order->total_product_value,
                'total_shipping_value' => $order->total_shipping_value,
                'client_name' => $order->client_name,
                'client_address' => $order->client_address
            ];
            Mail::to('n.sherbina1999@gmail.com')->send(new OrderCreated($data));

            return redirect()->route('product.show')
                ->with(['message' => 'Your order is done. Order ID is ' . $order->id . '.']);
        } catch (Throwable $e) {
            return redirect()->route('product.show')
                ->with(['message' => $e->getMessage()]);
        }
    }
}
