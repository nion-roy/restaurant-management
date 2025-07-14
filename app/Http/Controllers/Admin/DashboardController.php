<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // For now, just return a simple JSON or view
        return response()->json(['message' => 'Welcome to the Admin Dashboard!']);
    }
} 