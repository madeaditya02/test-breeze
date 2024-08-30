<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home');
    }
    public function stories()
    {
        return Inertia::render('Stories');
    }
    public function story()
    {
        return Inertia::render('Story');
    }
}
