@component('mail::message')
# Materials Fee Payment

Here is the list of materials you need to buy:
@component('mail::table')
| Name      | QTY | Price | Total |
| --------- | -------- | ----- | ----- |
@foreach ($materials as $item)
    | {{$item['item']['name']}} | {{ $item['quantity'] }} | {{ number_format($item['unit_price']) }} |  {{ number_format($item['total']) }} |
@endforeach
|           |          | **Grand Total:** | **RWF {{ number_format($grandTotal) }}** |
@endcomponent

@component('mail::button', ['url' => $checkBillsUrl])
Pay Now
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
