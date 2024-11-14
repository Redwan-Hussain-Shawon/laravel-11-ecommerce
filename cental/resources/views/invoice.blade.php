<!DOCTYPE html>
<html>
<head>
    <style>
        @font-face {
            font-family: 'SolaimanLipi';
            src: url("{{ storage_path('fonts/SolaimanLipi.ttf') }}") format('truetype');

        }

        body {
            font-family: 'SolaimanLipi', sans-serif;
            font-size: 14px;
        }

        h1 {
            font-family: 'SolaimanLipi', sans-serif;
        }

        p {
            font-family: 'SolaimanLipi', sans-serif;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Date: {{ $Date }}</p>
</body>
</html>
