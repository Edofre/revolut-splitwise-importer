<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class Model
 * @package App\Models
 */
class Model extends BaseModel
{
    /**
     * @return array
     */
    public static function getValidationMessages()
    {
        return [
        ];
    }
}
