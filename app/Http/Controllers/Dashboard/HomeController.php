<?php

namespace EcommerceCourse\Http\Controllers\Dashboard;

use EcommerceCourse\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
}
