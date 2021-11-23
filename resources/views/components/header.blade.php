<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--General Stylesheets -->
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap/bootstrap.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap/bootstrap.min.css') }}" type="text/css" />
        <!--Fontawsome 5.15.4-->
        <link href="{{ url('assets/css/fontawesome/css/fontawesome.css') }}" rel="stylesheet">
        <link href="{{ url('assets/css/fontawesome/css/brands.css') }}" rel="stylesheet">
        <link href="{{ url('assets/css/fontawesome/css/solid.css') }}" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        -->
    <!--General Stylesheets End-->
    
    <!--Custom Stylesheets-->
        <link href="{{ url('assets/css/custom.css') }}" rel="stylesheet">
    <!--Custom Stylesheets End-->

    <title>{{$pageTitle}}</title>
</head>
<body>
<!--Navigation Start-->
<div class="container-fluid navigation">
    <nav id="navbar_top" class="navbar navbar-expand-md">
        <a id="navbar_logo" class="navbar-brand" href="#">
            Biltrax
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fas fa-list"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
            <ul id="navbar-spaced" class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.html">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">SERVICES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">PORTFOLIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">CONTACT US</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!--Navigation End-->