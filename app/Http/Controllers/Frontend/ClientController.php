<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use App\Support\Seo\PageMeta;
use Illuminate\View\View;
use Throwable;

class ClientController extends Controller
{
    public function index(): View
    {
        try {
            $clientLogos = ClientLogo::query()
                ->published()
                ->ordered()
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            $clientLogos = collect();
        }

        return view('frontend.clients.clients-page', [
            'clientLogos' => $clientLogos,
            'pageMeta' => PageMeta::custom(sprintf(
                'Explore %d trusted client logos from businesses that rely on Sortiq Solutions for web development, design, and digital growth services.',
                $clientLogos->count()
            )),
        ]);
    }
}
