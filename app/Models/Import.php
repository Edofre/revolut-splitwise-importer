<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Customer
 * @property int                                                                   $id
 * @property string                                                                $name
 * @property string|null                                                           $file_name
 * @property \Carbon\Carbon|null                                                   $created_at
 * @property \Carbon\Carbon|null                                                   $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ImportRow[] $importRows
 * @mixin \Eloquent
 */
class Import extends Model
{
    /**
     * Validation rules
     * @var array
     */
    public static $validationRules = [
        'name'      => 'required|string|max:255',
        'file_name' => 'required|string|max:255',
    ];
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'file_name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function importRows()
    {
        return $this->hasMany(ImportRow::class);
    }
}
