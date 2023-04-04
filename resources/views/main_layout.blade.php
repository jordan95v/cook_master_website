<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid text-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_content">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar_content">
                <ul class="navbar-nav text-center mx-auto ps-5 pe-0">
                    <li class="nav-item">
                        <h5><a class="nav-link active" aria-current="page" href="/">🏡 Accueil</a></h5>
                    </li>

                    <li class="nav-item">
                        <h5><a class="nav-link" href="">🏫 Cours</a></h5>
                    </li>

                    <li class="nav-item dropdown">
                        <h5><a class="nav-link" href="">📚 Leçon</a></h5>
                    </li>

                    <li class="nav-item">
                        <h5><a class="nav-link" href="">💸 Boutique</a></h5>
                    </li>

                    <li class="nav-item">
                        <h5><a class="nav-link" href="/login">📤 Se connecter</a></h5>
                    </li>

                    <li class="nav-item">
                        <h5><a class="nav-link" href="/register">📥 S'inscrire</a></h5>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    {{-- Content of the page --}}
    @yield('content')

    {{-- End of html --}}
    <footer class="text-center my-5">
        <p>L'Atelier des Gourmets ©2023 - <a href="" class="link-secondary">Mentions Légales</a> - <a
                href="" class="link-secondary">Contact</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
