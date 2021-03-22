@extends('layouts.app')

@section('content')
    <form action="{{route('order.store')}}" method="POST">
        @csrf
        <input type="hidden" value="{{$item->id}}" name="item_id">
        <div class="mb-3">
            <label for="client-name" class="form-label">Your name</label>
            <input class="form-control" name="client_name" id="client-name">
            @if($errors->has('client_name'))
                <span class="text-danger">{{ $errors->first('client_name') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="client-address" class="form-label">Your address</label>
            <input class="form-control" name="client_address" id="client-address">
            @if($errors->has('client_address'))
                <span class="text-danger">{{ $errors->first('client_address') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Choose shipping option</label>
            @foreach($shipments as $shipment)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="shipment_id" id="shipment-{{$shipment->id}}"
                           value="{{$shipment->id}}" @if($loop->first) checked @endif>
                    <label class="form-check-label" for="shipment-{{$shipment->id}}">
                        {{$shipment->name}} ({{$shipment->price / 100}} EUR)
                    </label>
                </div>
            @endforeach
            @if($errors->has('shipment'))
                <br><span class="text-danger">{{ $errors->first('shipment') }}</span>
            @endif
        </div>
        <div class="row g-3">
            <div class="col-sm-3">
                <label for="credit-card-number" class="form-label">Your Credit Card</label>
                <input class="form-control" name="credit_card_number" id="credit-card-number" type="number" min="0">
                <small>Example: 1234 5678 9012 3456</small><br>
                @if ($errors->has('credit_card_number'))
                    <span class="text-danger">{{ $errors->first('credit_card_number') }}</span>
                @endif
            </div>
            <div class="col-sm-2">
                <label for="credit-card-cvv" class="form-label">CVV</label>
                <input class="form-control" name="credit_card_cvv" id="credit-card-cvv" type="number" min="0" max="999">
                <small>Example: 123</small><br>
                @if ($errors->has('credit_card_cvv'))
                    <span class="text-danger">{{ $errors->first('credit_card_cvv') }}</span>
                @endif
            </div>
            <div class="col">
                <label for="credit-card-expire" class="form-label">Expiration Year</label>
                <input class="form-control" name="credit_card_expire" id="credit-card-expire" type="number" min="2015"
                       max="2025">
                <small>Example: 2021</small><br>
                @if ($errors->has('credit_card_expire'))
                    <span class="text-danger">{{ $errors->first('credit_card_expire') }}</span>
                @endif
            </div>
        </div>
        <div class="col">
            <a href="{{route('product.show')}}" class="btn btn-primary">Back</a>
            <button type="submit" class="btn btn-success">Buy</button>
        </div>
    </form>
@endsection
