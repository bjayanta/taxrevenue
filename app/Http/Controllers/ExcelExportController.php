<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\TaxSession;
use App\Assessee;
use Auth;

class ExcelExportController extends Controller {
    private $data = [];
    private $sessions = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');

        // set sessions
        $this->sessions = TaxSession::all();

        // set data index
        $this->data[0] = [
            'sl'              => 'SL',
            'name'            => 'Assesse',
            'tin_number'      => 'TIN',
            'tin_date'        => 'TIN Date',
            'old_tin_number'  => 'Old TIN',
        ];

        foreach($this->sessions as $session) {
            $this->data[0][$session->id] = $session->title;
        }
    }

    public function allAssessee(Request $request) {
        $records = Assessee::with('taxSessions')->where('circle_id', Auth::user()->circle_id)->get();

        foreach($records as $index => $row) {
            $record = [
                'sl'                => $index + 1,
                'name'              => $row->name,
                'tin_number'        => $row->tin_number,
                'tin_date'          => date("d/m/Y",strtotime($row->tin_date)),
                'old_tin_number'    => $row->old_tin_number,
            ];

            foreach($this->sessions as $session) {
                $record[$session->id] = $row->taxSessions->find($session->id)->tax_return->amount ?? 0;
            }

            $this->data[$index + 1] = $record;
        }
        
        // export 
        $file = $this->export($this->data, 'assessees_list_' . Auth::user()->circle_id . '.xlsx');

        // download 
        return response()->download($file);
    }

    public function allSubmitedAssessee(Request $request) {
        $records = Assessee::with('taxSessions')->whereHas('taxSessions', function ($query) use ($request) {
            $query->where('tax_session_id', $request->tax_session_id);
        })->where('circle_id', Auth::user()->circle_id)->get();

        foreach($records as $index => $row) {
            $record = [
                'sl'                => $index + 1,
                'name'              => $row->name,
                'tin_number'        => $row->tin_number,
                'tin_date'          => date("d/m/Y",strtotime($row->tin_date)),
                'old_tin_number'    => $row->old_tin_number,
            ];

            foreach($this->sessions as $session) {
                $record[$session->id] = $row->taxSessions->find($session->id)->tax_return->amount ?? 0;
            }

            $this->data[$index + 1] = $record;
        }
        
        // export 
        $file = $this->export($this->data, 'assessees_submited_list_' . now()->timestamp . '_' . Auth::user()->circle_id . '.xlsx');

        // download 
        return response()->download($file);
    }

    public function allNonSubmitedAssessee(Request $request) {
        $records = Assessee::with('taxSessions')->whereDoesntHave('taxSessions', function ($query) use ($request) {
            $query->where('tax_session_id', $request->tax_session_id);
        })->where('circle_id', Auth::user()->circle_id)->get();

        foreach($records as $index => $row) {
            $record = [
                'sl'                => $index + 1,
                'name'              => $row->name,
                'tin_number'        => $row->tin_number,
                'tin_date'          => date("d/m/Y",strtotime($row->tin_date)),
                'old_tin_number'    => $row->old_tin_number,
            ];

            foreach($this->sessions as $session) {
                $record[$session->id] = $row->taxSessions->find($session->id)->tax_return->amount ?? 0;
            }

            $this->data[$index + 1] = $record;
        }
        
        // export 
        $file = $this->export($this->data, 'assessees_non_submited_list_' . now()->timestamp . '_' . Auth::user()->circle_id . '.xlsx');

        // download 
        return response()->download($file);
    }

    private function export($data, $filename) {
        // create spreadsheet object
        $spreadsheet = new Spreadsheet();

        // add dataset
        $spreadsheet->getActiveSheet()->fromArray($data);

        // create xlsx file
        $writer = new Xlsx($spreadsheet);
        $path = 'public/export/' . $filename;
        $writer->save($path);

        return $path;
    }

}
