<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
{
    // Récupérer les tickets assignés à l'utilisateur connecté
    $assignedTickets = Auth::user()->tickets;

    return view('employee.dashboard', compact('assignedTickets'));
}
}