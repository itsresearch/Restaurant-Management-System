<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        @if ($status == 'confirmed')
            Order Confirmation
        @elseif($status == 'on_the_way')
            Order On the Way
        @elseif($status == 'delivered')
            Order Delivered
        @elseif($status == 'canceled')
            Order Canceled
        @else
            Order Update
        @endif
    </title>
</head>

<body style="font-family:Arial,sans-serif; background:#f8f8f8; padding:20px;">
    <div style="max-width:600px; margin:auto; background:white; border-radius:10px; padding:20px;">
        @if ($status == 'confirmed')
            <h1 style="color:#f59e0b;">Order Confirmation 🎉</h1>
            <p>Hello {{ $user->name ?? 'Customer' }},</p>
            <p>Thank you for your order! Here are your order details:</p>
        @elseif($status == 'on_the_way')
            <h1 style="color:#f59e0b;">Your Order is On the Way! 🚚</h1>
            <p>Hello {{ $user->name ?? 'Customer' }},</p>
            <p>Great news! Your order is now on the way. Here are your order details:</p>
        @elseif($status == 'delivered')
            <h1 style="color:#f59e0b;">Your Order Has Been Delivered! ✅</h1>
            <p>Hello {{ $user->name ?? 'Customer' }},</p>
            <p>Your order has been successfully delivered. Here are your order details:</p>
        @elseif($status == 'canceled')
            <h1 style="color:#f59e0b;">Your Order Has Been Canceled ❌</h1>
            <p>Hello {{ $user->name ?? 'Customer' }},</p>
            <p>We're sorry to inform you that your order has been canceled. Here are your order details:</p>
        @else
            <h1 style="color:#f59e0b;">Order Update</h1>
            <p>Hello {{ $user->name ?? 'Customer' }},</p>
            <p>Here's an update on your order:</p>
        @endif

        <table style="width:100%; border-collapse:collapse; margin-top:20px;">
            <thead>
                <tr>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Item</th>
                    <th style="padding:10px; border-bottom:1px solid #ddd;">Qty</th>
                    <th style="padding:10px; border-bottom:1px solid #ddd;">Price</th>
                    <th style="padding:10px; border-bottom:1px solid #ddd;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($order as $item)
                    @php
                        $subtotal = $item->price;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td style="padding:10px; border-bottom:1px solid #eee;">{{ $item->title }}</td>
                        <td style="padding:10px; border-bottom:1px solid #eee;">{{ $item->quantity }}</td>
                        <td style="padding:10px; border-bottom:1px solid #eee;">Rs
                            {{ number_format($item->price / $item->quantity, 2) }}</td>
                        <td style="padding:10px; border-bottom:1px solid #eee;">Rs {{ number_format($subtotal, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="padding:10px; text-align:right; font-weight:bold;">Total</td>
                    <td style="padding:10px; font-weight:bold;">Rs {{ number_format($total, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        @if ($hasQr ?? false)
            <div style="text-align: center; margin: 20px 0;">
                <p style="margin-bottom: 10px; font-weight: bold;">Scan QR Code for Order Details:</p>
                <img src="cid:order_qr.png" alt="Order QR Code" style="max-width: 150px; height: auto;">
            </div>
        @endif

        @if ($status == 'confirmed')
            <p style="margin-top:20px;">Estimated delivery time: <strong>5 minutes</strong></p>
            <p style="margin-top:20px;">We hope you enjoy your meal!</p>
        @elseif($status == 'on_the_way')
            <p style="margin-top:20px;">Your order will arrive soon. Please be ready to receive it!</p>
        @elseif($status == 'delivered')
            <p style="margin-top:20px;">Thank you for choosing our restaurant. We hope you enjoyed your meal!</p>
        @elseif($status == 'canceled')
            <p style="margin-top:20px;">If you have any questions or would like to place a new order, please contact us.
            </p>
        @else
            <p style="margin-top:20px;">Thank you for your patience!</p>
        @endif
        <p style="margin-top:10px; color:#888;">Restaurant Manager Team</p>
    </div>
</body>

</html>
