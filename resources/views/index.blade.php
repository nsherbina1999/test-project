@extends('layouts.app')

@section('content')
    {{config('mailgun.domain')}}
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Brand</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col" style="width: 10%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <th scope="row">{{$item->brand->name}}</th>
                <td>{{$item->name}}</td>
                <td>${{$item->price / 100}}</td>
                <td>
                    <a type="button" class="btn btn-success"
                       href="{{ route('order.checkout', ['id' => $item->id]) }}">BUY NOW</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
