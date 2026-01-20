<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <title>Admin | Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
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
            vertical-align: middle;
        }

        table td {
            text-align: center;
            vertical-align: middle;
        }

        .order-img {
            width: 70px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }

        .badge {
            padding: 6px 10px;
            font-size: 13px;
        }
    </style>
</head>

<body>

@include('admin.header')

<div class="d-flex align-items-stretch">

    @include('admin.sidebar')

    <div class="page-content">

        <h2 class="mb-4">📦 All Orders</h2>

        <div class="card shadow">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-dark table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Food</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Change status</th>
                            </tr>
                        </thead>
                        @foreach($data as $data)

                        <tbody>
                            <!-- Example row -->
                            <tr>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->phone}}</td>
                                <td>{{$data->address}}</td>
                                <td>{{$data->food_name}}</td>
                                <td>{{$data->quantity}}</td>
                                <td>{{$data->price}}</td>

                                <td>
                                    <img src="{{ asset('storage/'.$data->image) }}" class="order-img">
                                </td>
                                <td>
                                   {{$data->delivery_status}}
                                </td>
                                <td>
                                  <a clss="btn btn-info" onclick="return confirm('Are you sure to change this?')" href="{{url('on_the _way',$data->id)}}"> On the Way</a>
                                  <a clss="btn btn-warning" onclick="return confirm('Are you sure to change this?')" href="{{url('delivered',$data->id)}}">Delivered</a>
                                  <a clss="btn btn-danger" onclick="return confirm('Are you sure to change this?')" href="{{url('canceled',$data->id)}}">Cancel</a>
                                </td>
                            </tr>

                        </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

@include('admin.script')

</body>
</html>
