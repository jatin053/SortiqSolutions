@php
    $tabs = $tabs ?? [];
    $hiddenFields = $hiddenFields ?? [];
    $searchAction = $searchAction ?? url()->current();
    $searchValue = $searchValue ?? '';
    $searchAriaLabel = $searchAriaLabel ?? 'Search records';
    $searchPlaceholder = $searchPlaceholder ?? 'Search';
@endphp

<div class="list-tools list-tools-elevated">
    @if (! empty($tabs))
        <div class="list-tabs">
            @foreach ($tabs as $tab)
                <a href="{{ $tab['url'] ?? '#' }}" class="{{ ! empty($tab['active']) ? 'is-active' : '' }}">
                    {{ $tab['label'] }}
                    @if (array_key_exists('count', $tab))
                        <span>({{ $tab['count'] }})</span>
                    @endif
                </a>
            @endforeach
        </div>
    @endif

    <form class="search-box" action="{{ $searchAction }}" method="get">
        <span class="search-box-label">Find records</span>

        @foreach ($hiddenFields as $name => $value)
            @if (filled($value))
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endif
        @endforeach

        <input
            type="search"
            name="search"
            value="{{ $searchValue }}"
            aria-label="{{ $searchAriaLabel }}"
            placeholder="{{ $searchPlaceholder }}"
        >
        <button type="submit" class="primary-btn">Search</button>
    </form>
</div>
