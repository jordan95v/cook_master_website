@extends('main_layout')

@section('content')
    {{-- Logo --}}
    <div class="text-center">
        <img src="{{ asset('/images/logo.png') }}" alt="logo" class="mt-4 img-fluid w-25">
    </div>

    {{-- Main content --}}
    <div class="container-fluid p-5">

        {{-- Atelier --}}
        <div class="row p-5 shadow-lg rounded">
            <div class="col-lg-4">
                <div class="text-center">
                    <img src="{{ asset('/images/atelier.jpg') }}" alt="atelier" class="img-fluid rounded">
                </div>
            </div>
            <div class="col-lg-8">
                <h1 class="mb-5">🍲 Découvrez nos ateliers</h1>
                <p>
                    Nous sommes ravis de vous proposer une <b>expérience gastronomique</b> unique à travers nos ateliers
                    de cuisine.<br>
                    Que vous soyez un novice ou un passionné, notre équipe de <b>chefs expérimentés</b> est là pour vous
                    guider à chaque
                    étape de la préparation de vos plats préférés.<br><br>

                    Nos ateliers culinaires offrent une <b>opportunité unique</b> de découvrir de nouvelles recettes et
                    techniques de cuisine.
                    Vous aurez la chance d'apprendre à cuisiner des plats délicieux, à partir d'ingrédients <b>frais et
                        locaux</b>, dans une
                    ambiance conviviale et chaleureuse.<br>
                    Vous pourrez également échanger avec d'autres passionnés de cuisine, partager des astuces et des
                    conseils,
                    et découvrir de <b>nouveaux horizons culinaires</b>.<br><br>

                    Nous proposons une variété de thèmes, des plats <b>traditionnels</b> aux recettes plus
                    <b>exotiques</b>, pour répondre aux goûts et
                    aux intérêts de chacun.<br><br>

                    Alors, <b>rejoignez-nous</b> pour une expérience culinaire unique et inoubliable !
                    Consultez notre calendrier d'ateliers pour trouver celui qui vous convient le mieux et
                    <b>réservez</b> votre place dès maintenant.
                    Nous avons hâte de cuisiner avec vous !
                </p>
            </div>
        </div>

        {{-- Course --}}
        <div class="row p-5 shadow-lg rounded mt-5">
            <div class="col-lg-8">
                <h1 class="mb-5">🧆 Découvrez nos cours de cuisine (pour tous les niveaux 🧑🏽‍🍳)</h1>
                <p>
                    Nous sommes heureux de vous proposer également des cours de cuisine pour approfondir vos
                    connaissances
                    culinaires et <b>perfectionner</b> votre technique.<br>
                    Nos cours sont conçus pour les <b>passionnés de cuisine</b> qui souhaitent aller plus loin dans leur
                    apprentissage
                    et <b>améliorer</b> leur compétences culinaires.<br><br>

                    Dispensés par des chefs <b>professionnels expérimentés</b>, qui vous guideront à travers des
                    techniques <b>avancées</b>,
                    des recettes <b>élaborées</b> et des présentations culinaires élégantes.<br><br>

                    Nous proposons des cours sur une variété de thèmes culinaires, tels que la cuisine <b>française</b>,
                    <b>italienne</b>, <b>asiatique</b> et bien plus encore.<br>
                    Tuut cela dans une ambiance <b>conviviale et agréable</b>, où vous pourrez échanger avec d'autres
                    passionnés de cuisine et
                    <b>partager</b> votre expérience culinaire.<br><br>

                    Alors, si vous êtes passionné de cuisine et souhaitez vous <b>perfectionner</b>, consultez notre
                    calendrier
                    de cours pour trouver celui qui vous convient le mieux et <b>réservez</b> votre place dès
                    maintenant.<br>
                    Nous avons hâte de vous aider à atteindre votre <b>potentiel culinaire maximal</b> !
                </p>
            </div>
            <div class="col-lg-4">
                <div class="text-center">
                    <img src="{{ asset('images/course.jpg') }}" alt="atelier" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
@endsection
