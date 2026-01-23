<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>

<body style="font-family:Arial,sans-serif; background:#f8f8f8; padding:20px;">
    <div style="max-width:600px; margin:auto; background:white; border-radius:10px; padding:20px;">
        <h1 style="color:#f59e0b;">Order Confirmation 🎉</h1>
        <p>Hello {{ $user->name ?? 'Customer' }},</p>
        <p>Thank you for your order! Here are your order details:</p>

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

        <p style="margin-top:20px;">Estimated delivery time: <strong>5 minutes</strong></p>
        <p style="margin-top:20px;">We hope you enjoy your meal!</p>
        <p style="margin-top:10px; color:#888;">Restaurant Manager Team</p>
    </div>
</body>

</html>
