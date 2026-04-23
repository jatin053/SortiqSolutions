@php
    $pageFilterGroups = collect(\App\Support\Seo\SeoPageCatalog::pages())
        ->groupBy('section')
        ->map(
            fn ($pages, $section) => [
                'section' => $section,
                'pages' => collect($pages)
                    ->map(
                        fn ($pageOption) => [
                            'label' => $pageOption['label'],
                            'route_name' => $pageOption['route_name'],
                        ]
                    )
                    ->values()
                    ->all(),
            ]
        )
        ->values()
        ->all();

    $selectedSidebarPage = request()->routeIs('admin.pages.*')
        ? trim((string) request()->query('page'))
        : '';

    $navigationItems = [
        [
            'label' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'match' => 'admin.dashboard',
            'icon' => 'DB',
            'caption' => 'Overview, shortcuts, and admin pulse.',
        ],
        [
            'label' => 'Reviews',
            'route' => route('admin.reviews.index'),
            'match' => 'admin.reviews.*',
            'icon' => 'RV',
            'caption' => 'Testimonials, ratings, and social proof.',
        ],
        [
            'label' => 'Blogs',
            'route' => route('admin.blogs.index'),
            'match' => 'admin.blogs.*',
            'icon' => 'BL',
            'caption' => 'Editorial content and publishing flow.',
        ],
        [
            'label' => 'Portfolio',
            'route' => route('admin.portfolios.index'),
            'match' => 'admin.portfolios.*',
            'icon' => 'PF',
            'caption' => 'Projects, previews, and showcase order.',
        ],
        [
            'label' => 'Videos',
            'route' => route('admin.videos.index'),
            'match' => 'admin.videos.*',
            'icon' => 'VD',
            'caption' => 'Media entries and YouTube details.',
        ],
        [
            'label' => 'Client Logos',
            'route' => route('admin.client-logos.index'),
            'match' => 'admin.client-logos.*',
            'icon' => 'CL',
            'caption' => 'Brand assets and credibility blocks.',
        ],
        [
            'label' => 'Pages',
            'match' => 'admin.pages.*',
            'icon' => 'PG',
            'caption' => 'Meta titles and descriptions for public pages.',
            'page_filter_groups' => $pageFilterGroups,
        ],
        [
            'label' => 'Messages',
            'route' => route('admin.contact-messages.index'),
            'match' => 'admin.contact-messages.*',
            'icon' => 'CM',
            'caption' => 'Inbound contact requests and follow-up.',
        ],
        [
            'label' => 'Settings',
            'route' => route('admin.site-layout.edit'),
            'match' => 'admin.site-layout.*',
            'icon' => 'ST',
            'caption' => 'Header, footer, and site-wide content.',
        ],
    ];

    $currentSection = collect($navigationItems)->first(
        fn (array $item) => request()->routeIs($item['match'])
    ) ?? $navigationItems[0];

    $userName = auth()->user()->name ?? 'Admin';
    $userEmail = auth()->user()->email ?? 'admin@sortiq.local';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trim($__env->yieldContent('title')) ? trim($__env->yieldContent('title')) . ' | ' : '' }}Sortiq Solutions Admin</title>
    @include('admin.partials.favicon-links')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>

<div class="admin-shell" data-admin-shell>
    <div class="admin-sidebar-overlay" data-admin-sidebar-close></div>

    <aside class="sidebar" id="admin-sidebar">
        <div class="admin-sidebar-mobile-head">
            <span class="sidebar-section-label">Navigation</span>
            <button type="button" class="admin-sidebar-close" data-admin-sidebar-close aria-label="Close admin sidebar">
                Close
            </button>
        </div>

        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand-link" aria-label="Sortiq Solutions Admin Panel">
                <img
                    src="{{ asset('frontend-assets/media/admin-use.png') }}"
                    alt="Sortiq Solutions"
                    width="185"
                    height="77"
                    class="sidebar-brand-logo"
                >
            </a>

            <div class="sidebar-brand-copy">
                <span class="sidebar-brand-pill">Admin Workspace</span>
                <strong>Sortiq Control Room</strong>
                <p>Publishing, trust signals, and site settings in one polished workflow.</p>
            </div>
        </div>

        <div class="sidebar-section-head">
            <span class="sidebar-section-label">Main Menu</span>
            <span class="sidebar-section-count">{{ count($navigationItems) }} sections</span>
        </div>

        <ul class="sidebar-nav">
            @foreach ($navigationItems as $item)
                @if (! empty($item['page_filter_groups']))
                    <li
                        class="{{ request()->routeIs($item['match']) ? 'active is-submenu-open' : '' }}"
                        data-sidebar-dropdown-item
                    >
                        <div class="sidebar-dropdown-row">
                            <a
                                href="{{ route('admin.pages.edit') }}"
                                class="sidebar-dropdown-link {{ request()->routeIs('admin.pages.*') && $selectedSidebarPage === '' ? 'is-current' : '' }}"
                            >
                                <span class="sidebar-link-main">
                                    <span class="nav-icon">{{ $item['icon'] }}</span>
                                    <span class="sidebar-link-copy">
                                        <strong>{{ $item['label'] }}</strong>
                                        <small>{{ $item['caption'] }}</small>
                                    </span>
                                </span>
                            </a>

                            <button
                                type="button"
                                class="sidebar-dropdown-toggle"
                                data-sidebar-dropdown-toggle
                                aria-expanded="{{ request()->routeIs($item['match']) ? 'true' : 'false' }}"
                                aria-label="Toggle page list"
                            >
                                <span class="screen-reader-text">Toggle page list</span>
                                <span class="sidebar-link-arrow" aria-hidden="true">&#9662;</span>
                            </button>
                        </div>

                        <div class="sidebar-submenu">
                            <div class="sidebar-page-groups">
                                @foreach ($item['page_filter_groups'] as $pageGroup)
                                    <div class="sidebar-page-group">
                                        <span class="sidebar-submenu-label">{{ $pageGroup['section'] }}</span>

                                        <div class="sidebar-page-links">
                                            @foreach ($pageGroup['pages'] as $pageOption)
                                                <a
                                                    href="{{ route('admin.pages.edit', ['page' => $pageOption['route_name']]) }}"
                                                    class="sidebar-submenu-link sidebar-submenu-link--page {{ $selectedSidebarPage === $pageOption['route_name'] ? 'is-current' : '' }}"
                                                >
                                                    {{ $pageOption['label'] }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                @else
                    <li class="{{ request()->routeIs($item['match']) ? 'active' : '' }}">
                        <a href="{{ $item['route'] }}">
                            <span class="nav-icon">{{ $item['icon'] }}</span>
                            <span class="sidebar-link-copy">
                                <strong>{{ $item['label'] }}</strong>
                                <small>{{ $item['caption'] }}</small>
                            </span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>

        <div class="sidebar-panel">
            <span class="sidebar-panel-label">Active Workspace</span>
            <strong>{{ $currentSection['label'] }}</strong>
            <p>{{ $currentSection['caption'] }}</p>

            <div class="sidebar-user">
                <span class="sidebar-user-avatar">
                    <img
                        src="{{ asset('frontend-assets/media/admin-user-mark.png') }}"
                        alt="Sortiq Solutions"
                        class="user-avatar-icon"
                        width="28"
                        height="28"
                    >
                </span>
                <div class="sidebar-user-copy">
                    <strong>{{ $userName }}</strong>
                    <span>{{ $userEmail }}</span>
                </div>
            </div>

            <div class="sidebar-panel-actions">
                <a href="{{ route('frontend.home') }}" class="btn sidebar-view-site" target="_blank" rel="noopener">
                    Open Website
                </a>

                <form method="post" action="{{ route('admin.logout') }}" class="sidebar-logout-form">
                    @csrf
                    <button type="submit" class="topbar-logout sidebar-logout">Logout</button>
                </form>
            </div>
        </div>
    </aside>

    <div class="admin-main">
        <div class="admin-mobile-bar">
            <div class="admin-mobile-brand-wrap">
                <a href="{{ route('admin.dashboard') }}" class="admin-mobile-brand" aria-label="Sortiq Solutions Admin Panel">
                    <img
                        src="{{ asset('frontend-assets/media/admin-use.png') }}"
                        alt="Sortiq Solutions"
                        width="185"
                        height="77"
                        class="admin-mobile-logo"
                    >
                </a>

                <div class="admin-mobile-copy">
                    <span>{{ $currentSection['label'] }}</span>
                    <strong>{{ $currentSection['caption'] }}</strong>
                </div>
            </div>

            <button
                type="button"
                class="admin-mobile-toggle"
                data-admin-sidebar-open
                aria-controls="admin-sidebar"
                aria-expanded="false"
            >
                Menu
            </button>
        </div>

        <main class="content">
            <x-admin.page-structure :current-section="$currentSection">
                @yield('content')
            </x-admin.page-structure>
        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const shell = document.querySelector('[data-admin-shell]');
        const openButton = document.querySelector('[data-admin-sidebar-open]');
        const closeButtons = document.querySelectorAll('[data-admin-sidebar-close]');
        const navLinks = document.querySelectorAll('.sidebar a');
        const dropdownItems = document.querySelectorAll('[data-sidebar-dropdown-item]');
        const dropdownButtons = document.querySelectorAll('[data-sidebar-dropdown-toggle]');

        if (!shell || !openButton) {
            return;
        }

        const closeDropdown = (item) => {
            const button = item.querySelector('[data-sidebar-dropdown-toggle]');

            item.classList.remove('is-submenu-open');

            if (button) {
                button.setAttribute('aria-expanded', 'false');
            }
        };

        const openDropdown = (item) => {
            const button = item.querySelector('[data-sidebar-dropdown-toggle]');

            item.classList.add('is-submenu-open');

            if (button) {
                button.setAttribute('aria-expanded', 'true');
            }
        };

        const closeOtherDropdowns = (currentItem = null) => {
            dropdownItems.forEach((item) => {
                if (item === currentItem) {
                    return;
                }

                closeDropdown(item);
            });
        };

        const closeSidebar = () => {
            shell.classList.remove('is-sidebar-open');
            document.body.classList.remove('admin-sidebar-open');
            openButton.setAttribute('aria-expanded', 'false');
        };

        const openSidebar = () => {
            shell.classList.add('is-sidebar-open');
            document.body.classList.add('admin-sidebar-open');
            openButton.setAttribute('aria-expanded', 'true');
        };

        openButton.addEventListener('click', () => {
            if (shell.classList.contains('is-sidebar-open')) {
                closeSidebar();
                return;
            }

            openSidebar();
        });

        closeButtons.forEach((button) => {
            button.addEventListener('click', closeSidebar);
        });

        dropdownButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const item = button.closest('[data-sidebar-dropdown-item]');

                if (!item) {
                    return;
                }

                const isOpen = item.classList.contains('is-submenu-open');

                closeOtherDropdowns(isOpen ? null : item);

                if (isOpen) {
                    closeDropdown(item);
                    return;
                }

                openDropdown(item);
            });
        });

        navLinks.forEach((link) => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 980) {
                    closeSidebar();
                }
            });
        });

        window.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeOtherDropdowns();
                closeSidebar();
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 980) {
                closeSidebar();
            }
        });
    });
</script>

</body>
</html>
