<div class="page-header">
    <h3 class="fw-bold mb-3">{{ $title }}</h3>
    <ul class="breadcrumbs mb-3">
        <li class="nav-home">
            <a href="{{ route('admin.dashboard') }}">
                <i class="icon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>

        @foreach ($menus as $i => $menu)
            <li class="nav-item">
                <a @isset($menu['route']) href="{{ $menu['route'] }}" @endisset>{{ $menu['title'] }}</a>
            </li>
            @if ($i != count($menus) - 1)
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
            @endif
        @endforeach
    </ul>
</div>
