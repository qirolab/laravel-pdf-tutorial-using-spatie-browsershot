<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Borel&display=swap"
rel="stylesheet">

    <style>
        body {
            font-size: 1.2rem;
        }
        .cursive {
            font-family: 'Borel', cursive;
        }
        .page-break {
            page-break-after: always;
        }
    </style>

    @yield('scripts')
</head>
<body>



    <div>
        {{ $slot }}
    </div>
</body>
</html>
