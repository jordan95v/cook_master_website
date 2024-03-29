@props(['admin', 'title', 'datatables', 'calendar'])

<!DOCTYPE html>
<html lang="{{ App::getLocale('lang') }}" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ __($title) }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <script src="https://kit.fontawesome.com/51d79ea4d7.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')

    {{-- Datatables CDN --}}
    @isset($datatables)
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
            crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    @endisset

    @isset($calendar)
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    @endisset

    {{-- Google Adsense --}}
    @auth
        @if (!Auth::user()->isSubscribed())
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5629070617397142"
                crossorigin="anonymous"></script>
        @endif
    @else
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5629070617397142"
            crossorigin="anonymous"></script>
    @endauth
</head>

<body>
    {{-- Navbar management --}}
    @auth
        @if (Auth::user()->isAdmin())
            <x-admin.navbar />
        @else
            <x-navbar />
        @endif
    @else
        <x-navbar />
    @endauth

    {{-- Content of the page --}}
    <div class="md:p-0 p-4 flex flex-col h-screen">
        <x-utils.alerts />
        <div class="mb-auto">
            {{ $slot }}
        </div>
        <div class="pb-10">
            <x-footer />
        </div>
    </div>


    {{-- Datatables script --}}
    @isset($datatables)
        <script>
            function changeBtn() {
                const $paginateButtons = $(".paginate_button");
                $paginateButtons.addClass("btn hover:btn-primary").on("click", changeBtn);
                $paginateButtons.removeClass("paginate_button");
                $("#listing-table_paginate span").remove();
                $("#listing-table_paginate").addClass("btn-group flex justify-center mt-4");
                $("#listing-table_info").addClass("mt-4");
            }

            $(function() {
                $('#listing-table').DataTable({
                    lengthChange: false,
                    language: {
                        search: "",
                        @if (app()->getLocale() == 'fr')
                            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json',
                        @elseif (app()->getLocale() == 'es')
                            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                        @elseif (app()->getLocale() == 'kr')
                            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ko.json',
                        @endif
                    },
                });
                setTimeout(function() {
                    const $filterInput = $("#listing-table_filter input");
                    $filterInput.addClass("input input-bordered border-2 hover:input-primary mb-4").attr(
                        "placeholder",
                        "{{ __('Search ...') }}"
                    );
                    $("#listing-table_filter").removeClass("dataTables_filter").addClass("flex justify-center");
                    changeBtn();
                    $("#listing-table").removeClass("dataTable no-footer");
                }, 50);
            });
        </script>
    @endisset
</body>

</html>
