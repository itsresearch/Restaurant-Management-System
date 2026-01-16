<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Food List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="admin/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="admin/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="admin/css/font.css">
    <!-- Google fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="admin/css/style.default.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="admin/css/custom.css">

    <style>
        .page-header {
            background: #1f2327;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            margin: 20px;
        }

        .page-header h2 {
            color: #fff;
            margin: 0;
        }

        .table-wrapper {
            margin: 20px;
            background: #1f2327;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: #fff;
        }

        thead {
            background: #2c3035;
        }

        th, td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #3d4248;
        }

        th {
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
            color: #cfcfcf;
        }

        tr:hover {
            background: #2a2f34;
        }

        img.food-img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }
    </style>
</head>

<body>

@include('admin.header')

<div class="d-flex align-items-stretch">

    @include('admin.sidebar')

    <div class="page-content">

        <div class="page-header">
            <h2>Food List</h2>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Food Title</th>
                        <th>Details</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                </thead>

                <tbody>
    
                      @foreach($data as $data)
                    <tr>
                        <td>{{$data->title}}</td>
                        <td>{{$data->detail}}</td>
                        <td>{{$data->price}}</td>
                        <td><img  width="150" src="{{ asset('storage/'.$data->image) }}" alt=""></td>
                        <td>
                          <a href="{{url('delete_food',$data->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                        <td><a class="btn  btn-warning" href="{{url('update_food',$data->id)}}">Update </a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@include('admin.script')

</body>
</html>
