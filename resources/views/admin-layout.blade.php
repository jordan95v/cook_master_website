<!DOCTYPE html>
<html lang="fr" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>
    <script src="https://kit.fontawesome.com/51d79ea4d7.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    @yield('extra_tags')
</head>

<body>
    <x-admin-navbar />

    {{-- Content of the page --}}
    <div class="md:p-0 p-5">
        <x-alerts />

        @yield('content')

        {{-- Website footer --}}
        <footer class="text-center py-5">
            <p>L'Atelier des Gourmets ©2023 -
                <a href="" class="link hover:text-primary text-gray-600">Mentions Légales</a> -
                <a href="" class="link hover:text-primary text-gray-600">Contact</a>
            </p>
        </footer>
    </div>
</body>

</html>
