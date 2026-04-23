@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')
    @php
        $pageHeroActions = $selectedPageDetails
            ? [[
                'type' => 'button',
                'label' => 'Save Changes',
                'class' => 'primary-btn',
                'button_type' => 'submit',
                'form' => 'page-meta-form',
            ]]
            : [];
    @endphp

    @include('admin.partials.page-hero', [
        'kicker' => 'Page SEO',
        'title' => $selectedPageDetails ? 'Manage page titles and descriptions.' : 'Choose one page to manage SEO.',
        'description' => $selectedPageDetails
            ? 'Update the current SEO title and meta description for the selected public page.'
            : 'Pick one page from the dropdown to manage its current SEO title and meta description without loading a long list.',
        'actions' => $pageHeroActions,
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    <form id="page-meta-filter-form" action="{{ route('admin.pages.edit') }}" method="get" class="site-settings-form" novalidate>
        <section class="settings-panel">
            <div class="settings-panel-title">
                <span>Page Filter</span>
                <strong>{{ $selectedPageDetails ? 'Editing one selected page' : 'Pick a page to edit' }}</strong>
            </div>

            <div class="settings-panel-body">
                <div class="page-meta-filter-bar">
                    <div class="page-meta-filter-copy">
                        <p class="page-meta-help">
                            @if ($selectedPageDetails)
                                You are editing the current SEO details for <strong>{{ $selectedPageDetails['label'] }}</strong>. Use the dropdown to switch to another page any time.
                            @else
                                Choose one page from the dropdown to open its SEO title and meta description. The editor stays focused on one page so this screen does not get too long.
                            @endif
                        </p>
                    </div>

                    <div class="page-meta-filter-actions">
                        <label class="settings-field">
                            Select Page
                            <select name="page" class="page-meta-select">
                                <option value="">Select one page</option>
                                @foreach ($pageOptions as $pageOption)
                                    <option value="{{ $pageOption['route_name'] }}" @selected($selectedPage === $pageOption['route_name'])>
                                        {{ $pageOption['section'] }} - {{ $pageOption['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        </label>

                        <div class="page-meta-filter-buttons">
                            <button type="submit" class="btn">{{ $selectedPageDetails ? 'Open Another Page' : 'Open Page' }}</button>

                            @if ($selectedPage)
                                <a href="{{ route('admin.pages.edit') }}" class="btn">Back to Picker</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    @if ($selectedPageDetails)
        <form id="page-meta-form" action="{{ route('admin.pages.update') }}" method="post" class="site-settings-form" novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" name="selected_page" value="{{ $selectedPage }}">

            <div class="page-meta-groups">
                @foreach ($pageSections as $section => $sectionPages)
                    <section class="settings-panel">
                        <div class="settings-panel-title">
                            <span>{{ $section }}</span>
                            <strong>Current SEO for {{ $selectedPageDetails['label'] }}</strong>
                        </div>

                        <div class="settings-panel-body">
                            <div class="page-meta-grid">
                                @foreach ($sectionPages as $page)
                                    <div class="settings-row page-meta-row">
                                        <div class="page-meta-row-head">
                                            <div>
                                                <strong>{{ $page['label'] }}</strong>
                                                <span class="page-meta-path">{{ $page['path'] }}</span>
                                            </div>

                                            <span class="page-meta-route">{{ $page['route_name'] }}</span>
                                        </div>

                                        <input type="hidden" name="pages[{{ $page['input_index'] }}][route_name]" value="{{ $page['route_name'] }}">

                                        <div class="page-meta-fields">
                                            <label class="settings-field">
                                                SEO Title
                                                <input
                                                    type="text"
                                                    name="pages[{{ $page['input_index'] }}][title]"
                                                    value="{{ old("pages.{$page['input_index']}.title", $page['title']) }}"
                                                    class="page-meta-title-input @error("pages.{$page['input_index']}.title") is-invalid @enderror"
                                                >
                                                @error("pages.{$page['input_index']}.title")
                                                    <span class="field-error">{{ $message }}</span>
                                                @enderror
                                            </label>

                                            <label class="settings-field">
                                                Meta Description
                                                <textarea
                                                    name="pages[{{ $page['input_index'] }}][description]"
                                                    class="page-meta-description @error("pages.{$page['input_index']}.description") is-invalid @enderror"
                                                >{{ old("pages.{$page['input_index']}.description", $page['description']) }}</textarea>
                                                @error("pages.{$page['input_index']}.description")
                                                    <span class="field-error">{{ $message }}</span>
                                                @enderror
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endforeach
            </div>

            <div class="settings-save-bar">
                <button type="submit" class="primary-btn">Save Page Metadata</button>
            </div>
        </form>
    @else
        <section class="settings-panel">
            <div class="settings-panel-title">
                <span>Current SEO</span>
                <strong>Choose a page to manage</strong>
            </div>

            <div class="settings-panel-body">
                <div class="page-meta-empty-state">
                    <strong>Pick one page from the dropdown above.</strong>
                    <p>After you select a page, this screen will show only that page&apos;s current SEO title and meta description so the workflow stays short and focused.</p>
                </div>
            </div>
        </section>
    @endif
@endsection
