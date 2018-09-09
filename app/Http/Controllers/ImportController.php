<?php

namespace App\Http\Controllers;


use App\Http\Requests\RevolutUploadRequest;
use App\Jobs\ProcessImport;
use App\Models\Import;
use Yajra\DataTables\DataTables;

/**
 * Class ImportController
 * @package App\Http\Controllers
 */
class ImportController extends Controller
{
    /**
     * Show the import page
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('import.index');
    }

    /**
     * @param RevolutUploadRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(RevolutUploadRequest $request)
    {
        $path = $request->file('revolut-export')->storeAs(
            'exports', time() . '.csv'
        );

        $import = Import::create([
            'name'      => $request->file('revolut-export')->getClientOriginalName(),
            'file_name' => $path,

        ]);

        flash(__('import.file_upload_success'))->success();

        return redirect()->route('import.show', ['import' => $import->id]);
    }

    /**
     * @param Import $import
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Import $import)
    {
        return view('import.show')
            ->with([
                'import'     => $import,
                'importRows' => $import->importRows,
            ]);
    }


    /**
     * @param Import $import
     * @return mixed
     * @throws \Exception
     */
    public function importRowData(Import $import)
    {
        $datatables = DataTables::of($import->importRows)
            ->editColumn('action', function ($importRow) {
                return view('import-rows.columns._action')
                    ->with([
                        'importRow' => $importRow,
                    ]);
            })
            ->rawColumns(['action']);

        return $datatables->make(true);
    }

    /**
     * @param Import $import
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(Import $import)
    {
        flash(__('import.process_import_started'))->success();

        ProcessImport::dispatch($import);

        return redirect()->route('import.show', ['import' => $import->id]);
    }

}
