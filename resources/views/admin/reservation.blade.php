<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <title>Admin | Table Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="admin/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin/css/style.default.css">
    <link rel="stylesheet" href="admin/css/custom.css">

    <style>
        .page-content {
            padding: 30px;
        }

        .card {
            background: #1f1f1f;
            border-radius: 10px;
        }

        table th {
            background: #343a40;
            color: #fff;
            text-align: center;
        }

        table td {
            text-align: center;
            vertical-align: middle;
        }

        .badge {
            font-size: 14px;
            padding: 6px 12px;
        }
    </style>
</head>

<body>

@include('admin.header')

<div class="d-flex align-items-stretch">

    @include('admin.sidebar')

    <div class="page-content">

        <h2 class="mb-4">📅 Table Bookings</h2>

        <div class="card shadow">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-dark table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Phone Number</th>
                                <th>No. of Guests</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($book as $booking)
                            <tr>
                                <td>{{ $booking->phone }}</td>
                                <td>{{ $booking->guest }}</td>
                                <td>{{ $booking->date }}</td>
                                <td>{{ $booking->time }}</td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

@include('admin.script')

</body>
</html>
