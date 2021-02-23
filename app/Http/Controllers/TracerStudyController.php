<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Alumni;

class TracerStudyController extends Controller
{
    public function index() {
    	$alumni = Alumni::where('nim', Auth::user()->nim)->first();
    	return view('admin.tracer_study', ['alumni' => $alumni]);
    }
}
