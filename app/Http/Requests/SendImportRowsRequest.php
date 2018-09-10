<?php

namespace App\Http\Requests;

/**
 * Class SendImportRowsRequest
 * @package App\Http\Requests
 */
class SendImportRowsRequest extends Request
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
