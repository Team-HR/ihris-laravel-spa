<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoresController extends Controller
{
 	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('sys_admin.cores.index');
    }
}
