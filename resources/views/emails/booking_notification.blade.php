<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        @if ($status == 'accepted')
            Booking Accepted
        @elseif($status == 'rejected')
            Booking Rejected
        @else
            Booking Update
        @endif
    </title>
</head>

<body style="font-family:Arial,sans-serif; background:#f8f8f8; padding:20px;">
    <div style="max-width:600px; margin:auto; background:white; border-radius:10px; padding:20px;">
        @if ($status == 'accepted')
            <h1 style="color:#f59e0b;">Table Booking Accepted 🎉</h1>
            <p>Hello {{ $booking->name }},</p>
            <p>Great news! Your table booking has been accepted. Here are your booking details:</p>
        @elseif($status == 'rejected')
            <h1 style="color:#f59e0b;">Table Booking Rejected ❌</h1>
            <p>Hello {{ $booking->name }},</p>
            <p>We're sorry to inform you that your table booking has been rejected. Here are your booking details:</p>
        @else
            <h1 style="color:#f59e0b;">Booking Update</h1>
            <p>Hello {{ $booking->name }},</p>
            <p>Here's an update on your booking:</p>
        @endif

        <table style="width:100%; border-collapse:collapse; margin-top:20px;">
            <tbody>
                <tr>
                    <td style="padding:10px; border-bottom:1px solid #eee; font-weight:bold;">Name</td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">{{ $booking->name }}</td>
                </tr>
                <tr>
                    <td style="padding:10px; border-bottom:1px solid #eee; font-weight:bold;">Phone</td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">{{ $booking->phone }}</td>
                </tr>
                <tr>
                    <td style="padding:10px; border-bottom:1px solid #eee; font-weight:bold;">Email</td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">{{ $booking->email }}</td>
                </tr>
                <tr>
                    <td style="padding:10px; border-bottom:1px solid #eee; font-weight:bold;">Guests</td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">{{ $booking->guest }}</td>
                </tr>
                <tr>
                    <td style="padding:10px; border-bottom:1px solid #eee; font-weight:bold;">Date</td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">{{ $booking->date }}</td>
                </tr>
                <tr>
                    <td style="padding:10px; border-bottom:1px solid #eee; font-weight:bold;">Time</td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">{{ $booking->time }}</td>
                </tr>
                <tr>
                    <td style="padding:10px; border-bottom:1px solid #eee; font-weight:bold;">Status</td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">{{ ucfirst($status) }}</td>
                </tr>
            </tbody>
        </table>

        @if ($status == 'accepted')
            <p style="margin-top:20px;">We look forward to seeing you at the restaurant!</p>
        @elseif($status == 'rejected')
            <p style="margin-top:20px;">If you have any questions or would like to make another booking, please contact
                us.</p>
        @else
            <p style="margin-top:20px;">Thank you for your interest!</p>
        @endif
        <p style="margin-top:10px; color:#888;">Restaurant Manager Team</p>
    </div>
</body>

</html>
