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
            'label' => 'Sitemap Manager',
            'route' => route('admin.pages.edit', ['view' => 'xml_urls']),
            'match' => 'admin.pages.*',
            'icon' => 'SM',
            'caption' => 'Sitemap visibility & URLs',
        ],
        [
            'label' => 'Inquiries',
            'route' => route('admin.contact-messages.index', ['filter' => 'inquiry']),
            'match' => 'admin.contact-messages.*',
            'filter' => 'inquiry',
            'icon' => 'IQ',
            'caption' => 'General messages',
        ],
        [
            'label' => 'Applications',
            'route' => route('admin.contact-messages.index', ['filter' => 'application']),
            'match' => 'admin.contact-messages.*',
            'filter' => 'application',
            'icon' => 'AP',
            'caption' => 'Resumes & Careers',
        ],
        [
            'label' => 'Internships',
            'route' => route('admin.internship-applications.index'),
            'match' => 'admin.internship-applications.*',
            'icon' => 'IN',
            'caption' => 'Intern submissions',
        ],
        [
            'label' => 'Fresher Connect',
            'route' => route('admin.fresher-hirings.index'),
            'match' => 'admin.fresher-hirings.*',
            'icon' => 'FH',
            'caption' => 'Fresher submissions',
        ],
        [
            'label' => 'Settings',
            'route' => route('admin.site-layout.edit'),
            'match' => 'admin.site-layout.*',
            'icon' => 'ST',
            'caption' => 'Header and footer',
        ],
    ];

    $currentSection = $currentSection ?? collect($adminSections)->first(function (array $section) {
        if (request()->routeIs($section['match'])) {
            if (isset($section['filter'])) {
                return request()->query('filter', 'inquiry') === $section['filter'];
            }
            if ($section['label'] === 'Sitemap Manager') {
                return request()->query('view') === 'xml_urls';
            }
            if ($section['label'] === 'Pages') {
                return request()->query('view') !== 'xml_urls';
            }
            return true;
        }
        return false;
    }) ?? $adminSections[0];
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
            @php
                $isActive = false;
                if (request()->routeIs($section['match'])) {
                    if (isset($section['filter'])) {
                        $isActive = request()->query('filter', 'inquiry') === $section['filter'];
                    } elseif ($section['label'] === 'Sitemap Manager') {
                        $isActive = request()->query('view') === 'xml_urls';
                    } elseif ($section['label'] === 'Pages') {
                        $isActive = request()->query('view') !== 'xml_urls';
                    } else {
                        $isActive = true;
                    }
                }
            @endphp
            <a
                href="{{ $section['route'] }}"
                class="admin-workspace-link {{ $isActive ? 'is-active' : '' }}"
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
