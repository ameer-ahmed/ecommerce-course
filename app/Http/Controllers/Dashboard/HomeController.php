<?php

namespace EcommerceCourse\Http\Controllers\Dashboard;

use EcommerceCourse\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.index', compact('request'));
    }
}
