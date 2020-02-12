<?php

namespace App\Http\Controllers;

use App\Assessee;
use App\TaxSession;
use App\TaxReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

class HomeController extends Controller
{
    private $context = [
        'title' => 'Home',
        'menu' => 'home',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $circle_id = Auth::user()->circle_id;
        $assessees = Assessee::where('circle_id', $circle_id)->count();
        $sessions = TaxSession::all();
        $tax_returns = TaxReturn::where('circle_id', $circle_id)->get();

        return view('home', compact('assessees', 'tax_returns', 'sessions'))->with($this->context);
    }
}
