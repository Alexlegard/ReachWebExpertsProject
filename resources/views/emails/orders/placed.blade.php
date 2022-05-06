@component('mail::message')

# Hello {{ $order->billing_name }},

Thank you for shopping with us. Your order will be delivered shortly.

# Order Details

@component('mail::table')
| Price                  | Amount                                        |
| ---------------------- | --------------------------------------------- |
| Subtotal               | {{ $order->billing_subtotal }}                |
| Subtotal with discount | {{ $order->billing_subtotal_after_discount }} |
| Tax                    | {{ $order->billing_tax }}                     |
| Total                  | {{ $order->billing_total }}                   |
@endcomponent

@component('mail::button', ['url' => ''])
Order Details
@endcomponent

@component('mail::button', ['url' => ''])
Continue Shopping
@endcomponent

RWEStore is not a real store. You haven't actually been charged for anything.

Thanks,<br>
Alex Legard, owner of {{ config('app.name') }}
@endcomponent
