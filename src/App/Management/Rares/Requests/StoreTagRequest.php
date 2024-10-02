<?php

namespace App\Management\Rares\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'sometimes|string',
            'occured_at' => 'date',
        ];
    }
}
