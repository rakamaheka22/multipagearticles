<li class="nav-item">
    <a
        href="#{{ $navbarId }}"
        class="nav-link collapsed {{ request()->is($actives) ? 'active' : '' }}"
        data-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="{{ $navbarId }}"
    >
        <i class="{{ $icon ?? 'fa fa-circle nav-icon' }}"></i>
        <span class="nav-link-text">{{ $text }}</span>
    </a>
    <div class="collapse" id="{{ $navbarId }}" style="">
        <ul class="nav nav-sm flex-column">
            {{ $slot }}
        </ul>
    </div>
</li>
