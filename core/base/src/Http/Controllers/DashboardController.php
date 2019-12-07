<?php

namespace Hydrogen\Base\Http\Controllers;


use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke() {
        return view('dashboard::index');
    }
}