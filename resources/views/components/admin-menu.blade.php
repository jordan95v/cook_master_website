@props(['direction'])


<li><a href="{{ route('user.index') }}"><i class="fa-solid fa-user"></i>Liste des utilisateurs</a></li>

{{-- Shop --}}
<li tabindex="0">
    <a><i class="fa-brands fa-shopify"></i>Magasin<i class="fa-solid fa-chevron-{{ $direction }}"></i></a>
    <ul class="p-2 z-10 bg-white border-2 hover:border-primary">
        <li><a>Ajouter un produit</a></li>
        <li><a>Liste des produits</a></li>
    </ul>
</li>

{{-- Events --}}
<li tabindex="0">
    <a><i class="fa-solid fa-calendar-days"></i>Evènement<i class="fa-solid fa-chevron-{{ $direction }}"></i></a>
    <ul class="p-2 z-10 bg-white border-2 hover:border-primary">
        <li><a>Ajouter un evènement</a></li>
        <li><a>Liste des évenements</a></li>
    </ul>
</li>

<li tabindex="0">
    <a><i class="fa-solid fa-kitchen-set"></i></i>Atelier<i class="fa-solid fa-chevron-{{ $direction }}"></i></a>
    <ul class="p-2 z-10 bg-white border-2 hover:border-primary">
        <li><a>Ajouter un atelier</a></li>
        <li><a>Liste des ateliers</a></li>
    </ul>
</li>

{{-- Courses --}}
<li tabindex="0">
    <a><i class="fa-solid fa-chalkboard-user"></i></i>Cours<i class="fa-solid fa-chevron-{{ $direction }}"></i></a>
    <ul class="p-2 z-10 bg-white border-2 hover:border-primary">
        <li><a>Ajouter un cours</a></li>
        <li><a>Liste des cours</a></li>
    </ul>
</li>
