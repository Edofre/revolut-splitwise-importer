<?php

namespace App\Http\Requests;

/**
 * Class RevolutUploadRequest
 * @package App\Http\Requests
 */
class RevolutUploadRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'revolut-export' => 'required|file',
        ];
    }
}
