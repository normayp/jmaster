<head>
        <!--let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--import materialize.css-->
        <link rel="stylesheet" href="css/materialize.min.css">
        <!--import google icon font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- for social medias icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <!-- style -->
        <link rel="stylesheet" href="style.css">
        <!-- icon title -->
        <link type="img/icons8-flight-16.png" sizes="16x16" rel="icon" href="img/icons8-flight-16.png">
    <title>Journey Masters</title>
    <style>
        /* Custom hover effect for Materialize navbar */

    </style>
</head>
<body>
    <!-- navbar-fixed -->
    <div class="navbar-fixed">
        <nav class="nav-wrapper" style="background-color:#110d27;">
            <div class="container">
                <a href="#" class="brand-logo" style="color: #f27f0c;">J<span class="white-text" style="font-weight: bold;">MASTERS</span></a>
                <a href="#" class="sidenav-trigger" data-target="mobile-links">
                  <i class ="material-icons">menu</i>
                </a>
                <!-- navbar for sidenav -->
                <ul class="right hide-on-med-and-down">
                    <li><a href="index.php#home">HOME</a></li>
                    <li><a href="index.php#service">SERVICES</a></li>
                    <li><a href="index.php#about">ABOUT</a></li>
                    <li><a href="index.php#popularPlaces">PLACES</a></li>
                    <li><a href="booking-form.php?from=booking">BOOKING</a></li>
                    <li><a href="index.php#contact">CONTACT</a></li>
                    <li><a href="flights.php">FLIGHTS</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- sidenav -->
    <ul class="sidenav" id="mobile-links">
    <li><a href="index.php#home"><i class="material-icons orange-text">home</i>HOME</a></li>
    <li><a href="index.php#service"><i class="material-icons brown-text">business_center</i>SERVICES</a></li>
    <li><a href="index.php#about"><i class="material-icons blue-text">info</i>ABOUT</a></li>
    <li><a href="index.php#popularPlaces"><i class="material-icons green-text">location_on</i>PLACES</a></li>
    <li><a href="booking-form.php"><i class="material-icons brown-text">book</i>BOOKING</a></li>
    <li><a href="index.php#contact"><i class="material-icons green-text">call</i>CONTACT</a></li>
    <li><a href="flights.php"><i class="material-icons blue-text">flight</i>FLIGHTS</a></li>
    <li><a class="sidenav-close"><i class="material-icons black-text">exit_to_app</i>Exit</a></li>
    </ul>
    