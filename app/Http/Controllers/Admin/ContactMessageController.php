<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $searchTerm = trim($request->query('search', ''));
        $status = $request->query('status');

        // Validate status
        if ($status !== 'read' && $status !== 'unread') {
            $status = null;
        }

        // Base query
        $query = ContactMessage::query();

        // Search filter
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%")
                    ->orWhere('email', 'like', "%$searchTerm%")
                    ->orWhere('subject', 'like', "%$searchTerm%")
                    ->orWhere('message', 'like', "%$searchTerm%");
            });
        }

        // Clone for tab counts
        $tabQuery = clone $query;

        // Status filter
        if ($status) {
            $query->where('status', $status);
        }

        // Get messages
        $messages = $query->latestFirst()->paginate(10)->withQueryString();

        // Stats (overall)
        $stats = [
            'total' => ContactMessage::count(),
            'unread' => ContactMessage::where('status', 'unread')->count(),
            'read' => ContactMessage::where('status', 'read')->count(),
        ];

        // Tab counts (filtered)
        $tabCounts = [
            'all' => $tabQuery->count(),
            'unread' => (clone $tabQuery)->where('status', 'unread')->count(),
            'read' => (clone $tabQuery)->where('status', 'read')->count(),
        ];

        return view('admin.contact-messages.message-list', [
            'messages' => $messages,
            'searchTerm' => $searchTerm,
            'activeStatus' => $status,
            'stats' => $stats,
            'tabCounts' => $tabCounts,
        ]);
    }

    public function show(ContactMessage $contactMessage): View
    {
        // Mark message as read
        if ($contactMessage->status === 'unread') {
            $contactMessage->markAsRead();
        }

        return view('admin.contact-messages.show', [
            'contactMessage' => $contactMessage->fresh(),
        ]);
    }
}
