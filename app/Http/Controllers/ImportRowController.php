<?php

namespace App\Http\Controllers;


use App\Models\Import;
use App\Models\ImportRow;
use Yajra\DataTables\DataTables;

/**
 * Class ImportRowController
 * @package App\Http\Controllers
 */
class ImportRowController extends Controller
{
    /**
     * @param Import $import
     * @return mixed
     * @throws \Exception
     */
    public function data(Import $import)
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
     * @param ImportRow $importRow
     * @throws \Exception
     */
    public function destroy(ImportRow $importRow)
    {
        $importRow->delete();
    }
}
