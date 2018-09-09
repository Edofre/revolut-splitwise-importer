<?php

namespace App\Http\Controllers;


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

    public function upload() {

    }

}
