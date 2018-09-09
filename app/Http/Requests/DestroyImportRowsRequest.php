<?php

namespace App\Http\Requests;

/**
 * Class DestroyImportRowsRequest
 * @package App\Http\Requests
 */
class DestroyImportRowsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'import-rows' => 'required',
        ];
    }
}
