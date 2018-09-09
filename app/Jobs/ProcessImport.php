<?php

namespace App\Jobs;

use App\Models\Import;
use App\Models\ImportRow;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class ProcessImport
 * @package App\Jobs
 */
class ProcessImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var int */
    const ROW_COMPLETED_DATE = 0;
    const ROW_REFERENCE = 1;
    const ROW_PAID_OUT = 2;
    const ROW_PAID_IN = 3;
    const ROW_EXCHANGE_OUT = 4;
    const ROW_EXCHANGE_IN = 5;
    const ROW_BALANCE = 6;
    const ROW_CATEGORY = 7;
    /** @var Import */
    private $import;

    /**
     * Create a new job instance.
     * @param Import $import
     */
    public function __construct(Import $import)
    {
        $this->import = $import;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        $lineCounter = 0;

        $file = fopen(storage_path("app/{$this->import->file_name}"), 'r');
        while (($line = fgetcsv($file, 0, ';')) !== false) {
            $lineCounter++;

            // Skip first line
            if ($lineCounter === 1 || empty($line[self::ROW_PAID_OUT])) {
                continue;
            }

            // Create a carbon date from date field
            $date = new Carbon($line[self::ROW_COMPLETED_DATE]);
            // Turn our comma into a dot
            $paidOut = str_replace(',', '.', $line[self::ROW_PAID_OUT]);

            // Create a new ImportRow model
            ImportRow::create([
                'import_id'      => $this->import->id,
                'completed_date' => $date->format('Y-m-d'),
                'reference'      => $line[self::ROW_REFERENCE],
                'paid_out'       => $paidOut,
                'category'       => $line[self::ROW_CATEGORY],
            ]);

        }
        fclose($file);
    }
}
