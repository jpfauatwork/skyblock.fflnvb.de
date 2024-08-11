<?php

namespace App\Management\Events\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventGroupRequest extends FormRequest
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
