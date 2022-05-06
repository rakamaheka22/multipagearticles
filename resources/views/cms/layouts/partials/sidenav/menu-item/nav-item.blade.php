<li class="nav-item">
    <a
        class="nav-link {{request()->is($active ?? '') ? 'active' : ''}}"
        href="{{ $href ?? '#' }}"
    >
        <i class="{{ $icon ?? 'fa fa-circle nav-icon' }} text-primary"></i>
        <span class="nav-link-text">{{ $text }}</span>
    </a>
</li>
