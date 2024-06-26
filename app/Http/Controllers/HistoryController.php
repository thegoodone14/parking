<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::with(['reservation', 'reservation.user', 'reservation.place'])->get();
        return view('admin.history', compact('histories'));
    }
}

