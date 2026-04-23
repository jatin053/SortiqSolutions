@php
    $adminSections = [
        [
            'label' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'match' => 'admin.dashboard',
            'icon' => 'DB',
            'caption' => 'Overview and quick actions',
        ],
        [
            'label' => 'Reviews',
            'route' => route('admin.reviews.index'),
            'match' => 'admin.reviews.*',
            'icon' => 'RV',
            'caption' => 'Testimonials and ratings',
        ],
        [
            'label' => 'Blogs',
            'route' => route('admin.blogs.index'),
            'match' => 'admin.blogs.*',
            'icon' => 'BL',
            'caption' => 'Content management',
        ],
        [
            'label' => 'Portfolio',
            'route' => route('admin.portfolios.index'),
            'match' => 'admin.portfolios.*',
            'icon' => 'PF',
            'caption' => 'Projects and previews',
        ],
        [
            'label' => 'Videos',
            'route' => route('admin.videos.index'),
            'match' => 'admin.videos.*',
            'icon' => 'VD',
            'caption' => 'Media publishing',
        ],
        [
            'label' => 'Client Logos',
            'route' => route('admin.client-logos.index'),
            'match' => 'admin.client-logos.*',
            'icon' => 'CL',
            'caption' => 'Brand credibility',
        ],
        [
            'label' => 'Pages',
            'route' => route('admin.pages.edit'),
            'match' => 'admin.pages.*',
            'icon' => 'PG',
            'caption' => 'Page metadata',
        ],
        [
            'label' => 'Messages',
            'route' => route('admin.contact-messages.index'),
            'match' => 'admin.contact-messages.*',
            'icon' => 'CM',
            'caption' => 'Inbound enquiries',
        ],
        [
            'label' => 'Settings',
            'route' => route('admin.site-layout.edit'),
            'match' => 'admin.site-layout.*',
            'icon' => 'ST',
            'caption' => 'Header and footer',
        ],
    ];

    $currentSection = $currentSection ?? collect($adminSections)->first(
        fn (array $section) => request()->routeIs($section['match'])
    ) ?? $adminSections[0];
@endphp

<nav class="admin-workspace-bar" aria-label="Admin sections">
    <div class="admin-workspace-bar-head">
        <div>
            <span class="sidebar-section-label">Workspaces</span>
            <h3>Jump across the admin</h3>
        </div>

        <p>{{ $currentSection['label'] }} is open right now. Move between sections without losing the overall admin flow.</p>
    </div>

    <div class="admin-workspace-links">
        @foreach ($adminSections as $section)
            <a
                href="{{ $section['route'] }}"
                class="admin-workspace-link {{ request()->routeIs($section['match']) ? 'is-active' : '' }}"
            >
                <span class="admin-workspace-icon">{{ $section['icon'] }}</span>
                <span class="admin-workspace-copy">
                    <strong>{{ $section['label'] }}</strong>
                    <small>{{ $section['caption'] }}</small>
                </span>
            </a>
        @endforeach
    </div>
</nav>
