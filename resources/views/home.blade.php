<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <body class="pb-4">
        {{-- Navbar --}}
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid text-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_content">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar_content">
                    <ul class="navbar-nav text-center ms-auto me-auto">
                        <li class="nav-item">
                            <h4><a class="nav-link active" aria-current="page" href="#">🏡 Accueil</a></h4>
                        </li>

                        <li class="nav-item">
                            <h4><a class="nav-link" href="#">🏫 Cours</a></h4>
                        </li>

                        <li class="nav-item dropdown">
                            <h4><a class="nav-link" href="#">📚 Leçon</a></h4>
                        </li>

                        <li class="nav-item">
                            <h4><a class="nav-link">💸 Boutique</a></h4>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Logo --}}
        <div class="text-center">
            <img src="{{ asset('/storage/logo.png') }}" alt="logo" class="img-fluid">
        </div>

        {{-- Main content --}}
        <div class="container-fluid p-5">

            {{-- Atelier --}}
            <div class="row p-5 shadow rounded">
                <div class="col-lg-4">
                    <div class="text-center">
                        <img src="{{ asset('/storage/atelier.jpg') }}" alt="atelier" class="img-fluid rounded ">
                    </div>
                </div>
                <div class="col-lg-8">
                    <h1 class="mb-5">🍲 Découvrez nos ateliers</h1>
                    <p>
                        Nous sommes ravis de vous proposer une <b>expérience gastronomique</b> unique à travers nos ateliers de cuisine.<br>
                        Que vous soyez un novice ou un passionné, notre équipe de <b>chefs expérimentés</b> est là pour vous guider à chaque 
                        étape de la préparation de vos plats préférés.<br><br>
    
                        Nos ateliers culinaires offrent une <b>opportunité unique</b> de découvrir de nouvelles recettes et techniques de cuisine. 
                        Vous aurez la chance d'apprendre à cuisiner des plats délicieux, à partir d'ingrédients <b>frais et locaux</b>, dans une 
                        ambiance conviviale et chaleureuse.<br>
                        Vous pourrez également échanger avec d'autres passionnés de cuisine, partager des astuces et des conseils, 
                        et découvrir de <b>nouveaux horizons culinaires</b>.<br><br>
    
                        Nous proposons une variété de thèmes, des plats <b>traditionnels</b> aux recettes plus <b>exotiques</b>, pour répondre aux goûts et 
                        aux intérêts de chacun.<br><br>
                        
                        Alors, <b>rejoignez-nous</b> pour une expérience culinaire unique et inoubliable ! 
                        Consultez notre calendrier d'ateliers pour trouver celui qui vous convient le mieux et <b>réservez</b> votre place dès maintenant. 
                        Nous avons hâte de cuisiner avec vous !
                    </p>
                </div>
            </div>

            {{-- Course --}}
            <div class="row p-5 shadow rounded mt-4">
                <div class="col-lg-8">
                    <h1 class="mb-5">🧆 Découvrez nos cours de cuisine (pour tous les niveaux 🧑🏽‍🍳)</h1>
                    <p>
                        Nous sommes heureux de vous proposer également des cours de cuisine pour approfondir vos connaissances 
                        culinaires et <b>perfectionner</b> votre technique.<br>
                        Nos cours sont conçus pour les <b>passionnés de cuisine</b> qui souhaitent aller plus loin dans leur apprentissage 
                        et <b>améliorer</b> leur compétences culinaires.<br><br>

                        Dispensés par des chefs <b>professionnels expérimentés</b>, qui vous guideront à travers des techniques <b>avancées</b>,
                        des recettes <b>élaborées</b> et des présentations culinaires élégantes.<br><br>

                        Nous proposons des cours sur une variété de thèmes culinaires, tels que la cuisine <b>française</b>, <b>italienne</b>, <b>asiatique</b> et bien plus encore.<br>
                        Tuut cela dans une ambiance <b>conviviale et agréable</b>, où vous pourrez échanger avec d'autres passionnés de cuisine et 
                        <b>partager</b> votre expérience culinaire.<br><br>

                        Alors, si vous êtes passionné de cuisine et souhaitez vous <b>perfectionner</b>, consultez notre calendrier 
                        de cours pour trouver celui qui vous convient le mieux et <b>réservez</b> votre place dès maintenant.<br> 
                        Nous avons hâte de vous aider à atteindre votre <b>potentiel culinaire maximal</b> !
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="text-center">
                        <img src="{{ asset('storage/course.jpg') }}" alt="atelier" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>

        <footer class="text-center">
            <p>L'Atelier des Gourmets ©2023 - <a href="" class="link-secondary">Mentions Légales</a> - <a href="" class="link-secondary">Contact</a></p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
    </body>
</html>