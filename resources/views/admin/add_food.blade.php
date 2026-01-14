<!DOCTYPE html>
<html>

<head>
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

      <style>
    .page-header {
        background: #1f2327;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        max-width: 700px;
        margin: 30px auto;
    }

    .page-header h2 {
        color: #fff;
        margin-bottom: 25px;
        text-align: center;
    }

    .div_deg {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .div_deg label {
        color: #cfcfcf;
        margin-bottom: 6px;
        font-weight: 600;
    }

    .div_deg input,
    .div_deg textarea {
        background: #2c3035;
        border: 1px solid #444;
        border-radius: 6px;
        padding: 10px 12px;
        color: #fff;
        outline: none;
        transition: 0.3s;
    }

    .div_deg input:focus,
    .div_deg textarea:focus {
        border-color: #4caf50;
        box-shadow: 0 0 5px rgba(76,175,80,0.5);
    }

    .div_deg textarea {
        resize: none;
    }

    .div_deg input[type="submit"] {
        background: #4caf50;
        border: none;
        color: #fff;
        padding: 12px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 10px;
        transition: 0.3s;
    }

    .div_deg input[type="submit"]:hover {
        background: #43a047;
        transform: translateY(-2px);
    }
</style>

</head>

<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->

        @include('admin.sidebar')

        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">

                <form action="{{url('upload_food')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="div_deg">
                        <label for="">Food title</label>
                        <input type="text" name="title" required>
                    </div>
                    <div class="div_deg">
                        <label for="">Food details</label>
                        <textarea name="details" cols="20" rows="10" required></textarea>
                    </div>
                    <div class="div_deg">
                        <label for="">Price</label>
                        <input type="text" name="price" required>
                    </div>
                    <div class="div_deg">
                        <label for="">Image</label>
                        <input type="file" name="img" required>

                        <input type="submit" value="Add Food">
                    </div>
                </form>

            </div>
        </div>
        <!-- JavaScript files-->
        @include('admin.script')
</body>

</html>
