@props([
    'name',
    'title',
    'icon',
    'route',
    'canCreate'=>false,
    'model'=>''
])
@php
$isActive = request()->routeIs($route . '.index') || request()->routeIs($route . '.create');
@endphp
<a class="nav-link collapsed  {{ $isActive ? 'active' : '' }}" href="" data-bs-toggle="collapse" data-bs-target="#collapse{{ $name }}" aria-expanded="false" aria-controls="collapse{{ $name }}">
    <div class="sb-nav-link-icon"><i class="fas fa-{{ $icon }}"></i></div>
    {{ $title ?? 'no title' }}
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>

<div class="collapse" id="collapse{{ $name }}" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="{{ route($route.'.index') }}">
            <i class="fas fa-eye"></i>&emsp;View</a>


        @if ($canCreate && $model)
        @can('create',$model)
            
        <a class="nav-link" href="{{ route($route.'.create') }}">
            <i class="fas fa-plus"></i>&emsp;Add</a>
        @endcan
            
        @endif

    </nav>
</div>