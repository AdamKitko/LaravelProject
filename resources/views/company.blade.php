<!doctype html>
<html lang="english">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Project</title>
</head>

<body class="flex flex-col min-h-screen">
@include('partials.header2')
<main class="flex-grow p-10 font-bold">
<h1>{{ $name }}</h1>
</main>
@include('partials.footer')
</body>

</html>
