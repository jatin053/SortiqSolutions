<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use Illuminate\View\View;
use Throwable;

class ClientController extends Controller
{
    public function index(): View
    {
        return view('frontend.clients.clients-page', [
            'clientLogos' => $this->clientLogos(),
        ]);
    }

    private function clientLogos()
    {
        try {
            return ClientLogo::query()
                ->published()
                ->ordered()
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            return collect();
        }
    }
}
