<?php

namespace App\Http\Controllers;


use App\Http\Requests\RevolutUploadRequest;
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

        // TODO, flash user

        return redirect()->route('import.show', ['import' => $import->id]);
    }

    public function show(Import $import)
    {
        flash(__('import.file_upload_success'))->success()->important();

        return view('import.show')
            ->with([
                'import' => $import,
            ]);
    }

}
