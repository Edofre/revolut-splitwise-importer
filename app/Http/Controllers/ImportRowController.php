<?php

namespace App\Http\Controllers;


use App\Http\Requests\DestroyImportRowsRequest;
use App\Http\Requests\SendImportRowsRequest;
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
            ->editColumn('check', function ($importRow) {
                return view('import-rows.columns._check');
            })
            ->editColumn('action', function ($importRow) {
                return view('import-rows.columns._action')
                    ->with([
                        'importRow' => $importRow,
                    ]);
            })
            ->rawColumns(['check', 'action']);

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

    /**
     * @param DestroyImportRowsRequest $request
     */
    public function destroyMultiple(DestroyImportRowsRequest $request)
    {
        $importRowIds = $request->get('import-rows', []);

        // Delete ImportRow models
        ImportRow::query()
            ->whereIn('id', $importRowIds)
            ->delete();
    }

    /**
     * @param Import $import
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function overview(Import $import)
    {
        return view('import-rows.overview')
            ->with([
                'import'     => $import,
                'importRows' => $import->importRows,
            ]);
    }

    /**
     * @param SendImportRowsRequest $request
     */
    public function send(SendImportRowsRequest $request)
    {
        var_dump($request->all());
        exit;
    }
}
