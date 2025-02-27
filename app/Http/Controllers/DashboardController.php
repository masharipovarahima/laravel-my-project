<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
