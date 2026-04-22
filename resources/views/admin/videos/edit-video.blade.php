@extends('admin.layouts.app')

@section('title', 'Edit Video')

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => 'Videos',
        'title' => 'Edit video entry.',
        'description' => 'Update YouTube details, thumbnail settings, and publishing options in the same admin pattern.',
        'actions' => [
            [
                'label' => 'View Website',
                'url' => url('videos#' . $video['slug']),
                'class' => 'btn',
                'target' => '_blank',
            ],
            [
                'label' => 'Back to Videos',
                'url' => route('admin.videos.index'),
                'class' => 'btn',
            ],
        ],
    ])

    @include('admin.partials.overview-grid', [
        'items' => [
            ['label' => 'Status', 'value' => ucfirst($video['status'] ?: 'draft')],
            ['label' => 'Published', 'value' => $video['published_label']],
            ['label' => 'Views', 'value' => $video['views']],
        ],
    ])

    @if (session('status'))
        <div class="success-box">{{ session('status') }}</div>
    @endif

    <section class="admin-content-panel admin-form-shell">
        <div class="dashboard-panel-head">
            <div>
                <span class="panel-kicker">Editor</span>
                <h2>Video details and publishing</h2>
            </div>
        </div>

        @include('admin.videos.partials.form', [
            'action' => route('admin.videos.update', $video['slug']),
            'method' => 'PUT',
            'video' => $video,
            'permalink' => $permalink,
            'submitLabel' => 'Update',
        ])
    </section>
@endsection
