<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    public function getShipmentAttribute(Request $request)
    {
        if ($request->shipment == 1) {
            return 1000;
        } else {
            return 0;
        }
    }
}
