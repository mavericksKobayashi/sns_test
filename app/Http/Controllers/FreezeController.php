<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class FreezeController extends Controller
{


	public function index(Request $request)
	{
		Auth::logout();

		return view('freeze');
	}


}
