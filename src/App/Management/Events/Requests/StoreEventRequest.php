<?php

namespace App\Management\Events\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
