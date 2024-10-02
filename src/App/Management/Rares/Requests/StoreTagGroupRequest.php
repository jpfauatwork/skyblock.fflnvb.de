<?php

namespace App\Management\Rares\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagGroupRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'sometimes|string',
            'order_column' => 'sometimes|string',
        ];
    }
}
