<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Food Hut</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #121212;
            color: #fff;
        }

        /* Navbar spacing fix */
        .page-offset {
            padding-top: 90px;
        }

        /* Food Image */
        .food-img {
            width: 100%;
            height: 230px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        /* Food Card */
        .food-card {
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .food-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.6);
        }

        .price-badge {
            font-size: 18px;
            padding: 6px 14px;
        }

        .food-title {
            min-height: 48px;
            font-weight: 600;
        }

        .food-desc {
            min-height: 70px;
            font-size: 14px;
            opacity: 0.9;
        }

        /* Cart summary */
        .cart-total {
            background: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-top: 30px;
        }

        /* Order Form */
        .order-card {
            background: #1e1e1e;
            border-radius: 10px;
            padding: 25px;
        }

        label {
            font-size: 14px;
            opacity: 0.9;
        }

        input {
            background: #2a2a2a !important;
            color: #fff !important;
            border: none !important;
        }

        input:focus {
            box-shadow: none !important;
            border: 1px solid #007bff !important;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Food Hut</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#nav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#foods">Foods</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>
    </div>
</nav>

<div class="page-offset"></div>

<!-- FOOD SECTION -->
<section id="foods" class="container py-5">
    <h2 class="text-center mb-5">🍽 Our Foods</h2>

    <div class="row">
        @php $total_price = 0; @endphp

        @foreach($data as $item)
        <div class="col-md-4 mb-4">
            <div class="card bg-dark border food-card">
                <img src="{{ asset('storage/'.$item->image) }}" class="food-img" alt="food">

                <div class="card-body text-center">
                    <span class="badge badge-primary price-badge mb-3">
                        Rs {{ $item->price }}
                    </span>

                    <h4 class="food-title">{{ $item->title }}</h4>
                    <p class="food-desc">{{ $item->detail }}</p>

                    <a onclick="return confirm('Are you sure to remove this item?')"
                       href="{{ url('remove_cart',$item->id) }}"
                       class="btn btn-outline-warning btn-sm mt-2">
                        Remove from Cart
                    </a>
                </div>
            </div>
        </div>

        @php $total_price += $item->price; @endphp
        @endforeach
    </div>

    <!-- CART TOTAL -->
    <div class="cart-total">
        <h4>Total Cart Price</h4>
        <h2 class="text-success">$ {{ $total_price }}</h2>
    </div>

    <!-- ORDER FORM -->
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="order-card">
                <h4 class="text-center mb-4">Confirm Your Order</h4>

                <form action="{{url('confirm_order')}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{Auth()->user()->name}}" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{Auth()->user()->email}}" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" name="phone" class="form-control" value="{{Auth()->user()->phone}}" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control"  value="{{Auth()->user()->address}}" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Confirm Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-dark text-center py-3 mt-5">
    <small>© {{ date('Y') }} Food Hut. All rights reserved.</small>
</footer>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
