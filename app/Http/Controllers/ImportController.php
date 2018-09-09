<?php

namespace App\Http\Controllers;


use App\Http\Requests\RevolutUploadRequest;

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
     */
    public function upload(RevolutUploadRequest $request)
    {
        var_dump($request->all());
        var_dump($request->file('revolut-export'));
    }

}
