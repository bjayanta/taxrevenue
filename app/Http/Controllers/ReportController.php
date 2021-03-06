<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assessee;
use App\TaxSession;
use Auth;

class ReportController extends Controller {
    private $context = [
        'title' => 'Report',
        'menu' => 'report',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function submited(Request $request) {
        $total = [];
        $sessions = TaxSession::all();
        $assessees = [];

        foreach($sessions as $session) {
            $total[$session->id] = 0;
        }

        if(request()->search == 1) {
            $assessees = Assessee::with('taxSessions')
                ->whereHas('taxSessions', function ($query) use ($request) {
                $query->where('tax_session_id', $request->tax_session_id);
            })->where('circle_id', Auth::user()->circle_id)->paginate(100);
        }

        // view
        return view('report.submited', compact('total', 'sessions', 'assessees'))
            ->with($this->context);
    }

    public function nonSubmited(Request $request) {
        $total = [];
        $sessions = TaxSession::all();
        $assessees = [];

        foreach($sessions as $session) {
            $total[$session->id] = 0;
        }

        if(request()->search == 1) {
            $assessees = Assessee::with('taxSessions')
                ->whereDoesntHave('taxSessions', function ($query) use ($request){
                    $query->where('tax_session_id', $request->tax_session_id);
                })->where('circle_id', Auth::user()->circle_id)->paginate(100);
        }

        // view
        return view('report.non-submited', compact('total', 'sessions', 'assessees'))
            ->with($this->context);
    }
}
