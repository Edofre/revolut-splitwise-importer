<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Customer
 * @property int                                                              $id
 * @property string                                                           $splitwise_id
 * @property \Carbon\Carbon                                                   $completed_date
 * @property string                                                           $reference
 * @property float                                                            $paid_out
 * @property string                                                           $category
 * @property \Carbon\Carbon|null                                              $created_at
 * @property \Carbon\Carbon|null                                              $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Import $import
 * @property-read string $splitwiseReference
 */
class ImportRow extends Model
{
    /**
     * Validation rules
     * @var array
     */
    public static $validationRules = [
        'import_id'      => 'required|integer',
        'splitwise_id'   => 'nullable|string|max:255',
        'completed_date' => 'required|date',
        'reference'      => 'required|string|max:255',
        'paid_out'       => "required|regex:/^\d*(\,\d{1,2})?$/",
        'category'       => 'required|string|max:255',
    ];
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'import_id',
        'splitwise_id',
        'completed_date',
        'reference',
        'paid_out',
        'category',
    ];
    /**
     * @var array
     */
    protected $dates = [
        'completed_date',
    ];

    /**
     * @return string
     */
    public function getSplitwiseReferenceAttribute() {
        var_dump($this->reference);
        var_dump($this->completed_date);


        exit;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function import()
    {
        return $this->hasOne(ImportRow::class);
    }
}
