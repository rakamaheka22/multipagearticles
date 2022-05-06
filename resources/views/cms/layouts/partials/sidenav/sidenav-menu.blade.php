@include('cms.layouts.partials.sidenav.menu-item.nav-item', [
    'text' =>  __('Article'),
    'href' => route('cms.article.list'),
    'active' => 'cms/article*',
    'icon' => 'fa fa-newspaper text-primary',
])
