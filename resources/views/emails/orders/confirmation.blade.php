<x-mail::message>
# Hello {{ $user->name }},

Thank you for your order! Here are the details:

- **Order ID:** {{ $order->id }}
- **Product:** {{ $product->name }}
- **Quantity:** {{ $order->quantity }}
- **Price per item:** ${{ number_format($product->price, 2) }}
- **Discount:** ${{ number_format($order->discount, 2) }}
- **Total:** ${{ number_format($order->total, 2) }}

<x-mail::button :url="url('/orders/'.$order->id)">
View Your Order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
