<?php

namespace App\Http\Controllers;


use App\Http\Requests\RevolutUploadRequest;
use App\Jobs\ProcessImport;
use App\Models\Import;

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
                'import' => $import,
            ]);
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
