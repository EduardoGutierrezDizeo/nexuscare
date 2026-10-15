<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Display a listing of the tickets.
     */
    public function index(): View
    {
        return view('tickets.index');
    }

    /**
     * Show the form for creating a new ticket.
     */
    public function create(): View
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created ticket.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'subject' => ['required', 'string', 'max:255'],
        ]);

        return Redirect::route('tickets.index');
    }

    /**
     * Display the ticket management view.
     */
    public function manage(): View
    {
        return view('tickets.manage');
    }
}
