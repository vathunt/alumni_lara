<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Alumni;
use Session;
use Alert;

class HomeController extends Controller
{
    public function index() {
    	// if (Auth::check()) {
            $count_alumni = Alumni::all()->count();
	    	$count_user = User::all()->count();
	    	return view('admin.index', compact('count_alumni', 'count_user'));
        // }
    	// Session::flash('error', 'Anda Belum Login');
        // return redirect()->route('form.login');
    }

    // public function form() {
    // 	return view('form');
    // }
}
