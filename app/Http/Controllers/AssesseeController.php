<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Assessee;
use Auth;
use App\TaxSession;

class AssesseeController extends Controller {
    private $context = [
        'title' => 'Assessee',
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
        $assessees = Assessee::with('taxSessions')->where('circle_id', Auth::user()->circle_id)->paginate(100);
        $sessions = TaxSession::all();
        $total = [];

        foreach ($sessions as $session) {
            $total[$session->id] = 0;
        }

        if (request()->search == 1) {
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

    public function preview(Request $request) {
        $path = $request->file('file')->store('public');

        $file_type = "Xlsx";
        $file_name = "storage/app/" . $path;
        $reader = IOFactory::createReader($file_type);
        $reader->setLoadAllSheets();
        $spreadsheet = $reader->load($file_name);
        $worksheet = $spreadsheet->getActiveSheet(); //Selecting The Active Sheet
        //$highest_row = $worksheet->getHighestRow();
        $highest_row = $worksheet->getHighestRow();
        $highest_col = "D";

        $highest_cell = $highest_col . $highest_row;
        $rang = "A2:" . $highest_cell; // Selecting The Cell Range

        $dataToArray = $spreadsheet->getActiveSheet()
            ->rangeToArray(
                $rang,     // The worksheet range that we want to retrieve
                NULL,        // Value that should be returned for empty cells
                TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
                TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
                TRUE         // Should the array be indexed by cell row and cell column
            );

        Storage::delete($path);
        $fields = ["name", "tin_number", "old_tin_number", "tin_date", "circle_id"];
        $data = array_map(function ($row) use ($fields) {
            $row[] = Auth::user()->circle_id;
            return array_combine($fields, $row);
        }, $dataToArray);

        return view('assessee.upload_preview', compact('data'))->with($this->context);
    }

    public function confirm_upload(Request $request) {
        $data = json_decode($request->data, true);
        
        if (Assessee::insert($data)) {
            return redirect("assessee")->with("success", "Data Successfully Imported");
        }
    }
}
