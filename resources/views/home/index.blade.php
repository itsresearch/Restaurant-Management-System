<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with FoodHut landing page.">
    <meta name="author" content="Devcrud">
    <title>FoodHut</title>
   
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">

    <link rel="stylesheet" href="assets/vendors/animate/animate.css">

    <!-- Bootstrap + FoodHut main styles -->
	<link rel="stylesheet" href="assets/css/foodhut.css">
<style>
    /* Food card image styling */
.food-img {
    width: 100%;
    height: 230px;          /* same height for all images */
    object-fit: cover;      /* crop image nicely */
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
}

/* Make cards equal height */
.card {
    height: 100%;
    transition: 0.3s ease-in-out;
}

/* Hover effect */
.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.4);
}

/* Better spacing for text */
.card-body h4 {
    min-height: 48px;
}

.card-body p {
    min-height: 70px;
    font-size: 14px;
    opacity: 0.9;
}

</style>
    
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    
    <!-- Navbar -->
@include('home.navbar')
    <!-- header -->
@include('home.header')

    <!--  About Section  -->
@include('home.about')
    <!--  gallary Section  -->
@include('home.gallary')


@include('home.blog')

@include('home.testimonial')

    <!-- CONTACT Section  -->
@include('home.contact')

    <!-- page footer  -->
@include('home.footer')
    <!-- end of page footer -->

	<!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap affix -->
    <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- wow.js -->
    <script src="assets/vendors/wow/wow.js"></script>
    
    <!-- google maps -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtme10pzgKSPeJVJrG1O3tjR6lk98o4w8&callback=initMap"></script>

    <!-- FoodHut js -->
    <script src="assets/js/foodhut.js"></script>

</body>
</html>
