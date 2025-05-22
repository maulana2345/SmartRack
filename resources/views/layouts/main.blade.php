<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SmartRack | {{ $title }}</title>
    <!-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> -->
    <!-- <script>

      Pusher.logToConsole = true;

      var pusher = new Pusher('045c1390d831e0b231da', {
        cluster: 'ap1'
      });

      var channel = pusher.subscribe('my-channel');
      channel.bind('my-event', function(data) {
        alert(JSON.stringify(data));
      });
    </script> -->

    {{-- Box Icons --}}
    <!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> -->

    {{-- manifest PWA --}}
    {{-- <link rel="manifest" href="manifest.json" /> --}}

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('landpage/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('landpage/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('landpage/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('landpage/assets/img/favicons/favicon.png') }}">
    <link rel="manifest" href="{{ asset('landpage/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('landpage/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff"> -->

    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />

    <!-- ======== CSS here ======== -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <!-- <link href="{{ asset('landpage/assets/css/theme.css') }}" rel="stylesheet" /> -->
</head>

<body>
<main class="main" id="top">
  

  @include('partials.header')

  @yield('container')

</main>

  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <!-- ======== scroll-top ======== -->
    <a href="#" class="scroll-top btn-hover">
      <i class="lni lni-chevron-up"></i>
    </a>

  <!-- <script src="{{ asset('landpage/vendors/@popperjs/popper.min.js') }}"></script>
  <script src="{{ asset('landpage/vendors/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('landpage/vendors/is/is.min.js') }}"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="{{ asset('landpage/vendors/fontawesome/all.min.js') }}"></script>
  <script src="{{ asset('landpage/assets/js/theme.js') }}"></script> -->

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/wow.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>

  <!-- <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap"
    rel="stylesheet"> -->
    @include('partials.footer')
</body>

</html>