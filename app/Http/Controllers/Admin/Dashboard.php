<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\ValidLoginAdmin;
use App\Http\Requests\ValidLang;
use App\Models\Lang;
use App\Models\Maincategory;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{


    public function Dashboard(){

        return view('admin.dashboard.dashboard');
    }
}
