<?php

namespace App\Http\Controllers;

use App\Assessee;
use Illuminate\Http\Request;
use Auth;
use App\TaxSession;

class AssesseeController extends Controller
{
    private $context = [
        'title' => 'AssesseeInput',
        'menu' => 'assessee',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $assessees = Assessee::where('circle_id', Auth::user()->circle_id)->with('taxSessions')->paginate(100);

        $sessions = TaxSession::all();
        $total = [];

        foreach($sessions as $session) {
            $total[$session->id] = 0;
        }

        if(request()->search == 1) {
            $where = [
                ['circle_id', 1],
                ['tin_number', request()->tin_number]
            ];

            $assessee = Assessee::where($where)->first();

            // view
            return redirect(route('tax_return.edit', $assessee->id));
        }

        // view
        return view('assessee.index', compact('assessees', 'sessions', 'total'))->with($this->context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('assessee.create')->with($this->context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $asseesee = new Assessee;
        $asseesee->name = $request->assesse;
        $asseesee->tin_number = $request->tin_number;
        $asseesee->tin_date = $request->tin_date;
        $asseesee->circle_id = Auth::user()->circle_id;

        if ($asseesee->save()) {
            return redirect(route('assessee.index'))->with('success', 'Assessee uploaded.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
