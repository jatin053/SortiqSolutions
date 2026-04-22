@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@php
    $searchTerm = $searchTerm ?? '';
    $activeStatus = $activeStatus ?? null;
    $tabCounts = array_replace([
        'all' => 0,
        'unread' => 0,
        'read' => 0,
    ], $tabCounts ?? []);
@endphp

@section('content')
    @include('admin.partials.page-hero', [
        'kicker' => 'Inbox',
        'title' => 'Manage contact enquiries.',
        'description' => 'Every message sent from the website contact form is stored here and can also be emailed through SMTP.',
    ])

    @include('admin.partials.overview-grid', [
        'items' => [
            ['label' => 'Total Messages', 'value' => $stats['total']],
            ['label' => 'Unread', 'value' => $stats['unread']],
            ['label' => 'Read', 'value' => $stats['read']],
        ],
    ])

    <section class="admin-content-panel">
        @include('admin.partials.list-tools', [
            'tabs' => [
                [
                    'label' => 'All',
                    'count' => $tabCounts['all'],
                    'url' => route('admin.contact-messages.index', array_filter([
                        'search' => $searchTerm,
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === null,
                ],
                [
                    'label' => 'Unread',
                    'count' => $tabCounts['unread'],
                    'url' => route('admin.contact-messages.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'unread',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'unread',
                ],
                [
                    'label' => 'Read',
                    'count' => $tabCounts['read'],
                    'url' => route('admin.contact-messages.index', array_filter([
                        'search' => $searchTerm,
                        'status' => 'read',
                    ], fn ($value) => filled($value))),
                    'active' => $activeStatus === 'read',
                ],
            ],
            'searchAction' => route('admin.contact-messages.index'),
            'searchValue' => $searchTerm,
            'searchAriaLabel' => 'Search contact messages',
            'searchPlaceholder' => 'Search enquiries',
            'hiddenFields' => ['status' => $activeStatus],
        ])

        <div class="reviews-table-wrap">
            <table class="reviews-table">
                <thead>
                    <tr>
                        <th class="title-column">Sender</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Received</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $message)
                        <tr>
                            <td class="review-title-cell">
                                <a href="{{ route('admin.contact-messages.show', $message) }}" class="review-title">
                                    {{ $message->name }}
                                </a>
                                <div class="row-actions">
                                    <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                    <span>|</span>
                                    <span>{{ $message->phone_label }}</span>
                                </div>
                            </td>
                            <td>{{ $message->subject }}</td>
                            <td>
                                <span class="status-pill {{ $message->status === 'unread' ? 'status-pill-muted' : 'status-pill-success' }}">
                                    {{ ucfirst($message->status) }}
                                </span>
                            </td>
                            <td>{{ $message->created_at?->format('Y/m/d \a\t g:i a') }}</td>
                            <td>
                                <a href="{{ route('admin.contact-messages.show', $message) }}" class="small-btn">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state-cell">No contact messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @include('admin.partials.pagination', ['paginator' => $messages, 'label' => 'Contact messages pagination'])
    </section>
@endsection
