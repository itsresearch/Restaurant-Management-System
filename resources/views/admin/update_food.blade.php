<!DOCTYPE html>
<html>
  <head> 
    <base href="/public">
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Bootstrap Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="admin/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="admin/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="admin/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="admin/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="admin/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="admin/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
@include('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->

@include('admin.sidebar')

      <!-- Sidebar Navigation end-->
<div class="page-content">
    <div class="page-header">

        <h1 style="color:white; margin-bottom:20px;">Update Food</h1>
<form action="{{ url('edit_food', $food->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group mb-3">
        <label style="color:white;">Food Title</label>
        <input type="text" name="title" class="form-control"
               value="{{ $food->title }}" required>
    </div>

    <div class="form-group mb-3">
        <label style="color:white;">Food Description</label>
        <textarea name="detail" class="form-control" rows="4" required>{{ $food->detail }}</textarea>
    </div>

    <div class="form-group mb-3">
        <label style="color:white;">Price</label>
        <input type="text" name="price" class="form-control"
               value="{{ $food->price }}" required>
    </div>

    <!-- Current Image -->
    <div class="form-group mb-3">
        <label style="color:white;">Current Image</label><br>
        <img src="{{ asset('storage/'.$food->image) }}"
             style="width:120px; height:120px; border-radius:8px;">
    </div>

    <!-- New Image -->
    <div class="form-group mb-4">
        <label style="color:white;">Change Image</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">
        Update Food
    </button>
</form>


    </div>
</div>

    </div>
    <!-- JavaScript files-->
@include('admin.script')
  </body>
</html>