@component('mail::table')
| ID              | Product Name           | Product Price                            | Shipping Price                    | Client Name              | Client Address              |
|:-------------:|:-------------:|:-------------:|:-------------:|:-------------:|:-------------:|
| {{$data['id']}} | {{$data['product_name']}} | {{$data['total_product_value'] / 100}} EUR | {{$data['total_shipping_value'] / 100}} EUR | {{$data['client_name']}} | {{$data['client_address']}} |
@endcomponent
