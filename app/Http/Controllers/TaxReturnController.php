<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assessee;
use App\TaxSession;
use App\TaxReturn;
use Auth;

class TaxReturnController extends Controller
{
    private $context = [
        'title' => 'Tax Return',

        'menu' => 'tax_return',
    ];

    public $data = [];

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
        return view('tax_return.index')->with($this->context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tax_return.create')->with($this->context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
    public function edit($id) {
        // get tax sessions
        $tax_sessions = TaxSession::all();

        // get assessee details
        $assessee = Assessee::find($id);
        // dd($assessee);

        return view('tax_return.edit', compact('tax_sessions', 'assessee'))->with($this->context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        foreach($request->tax_session as $index => $session) {
            if($request->amount[$index] > 0) {
                $tax_return = TaxReturn::firstOrNew([
                    'assessee_id' => $request->assessee_id,
                    'tax_session_id' => $session,
                ]);

                $tax_return->circle_id = Auth::user()->circle_id;
                $tax_return->amount = $request->amount[$index];

                $tax_return->save();
            }
        }

        // view
        return redirect(route('assessee.index'))->with('success', 'Return registration successfully update.');
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
