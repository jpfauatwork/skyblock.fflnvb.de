<?php

namespace App\Management\Rares\Requests;

use Domain\Rares\Enums\CollectibleTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCollectibleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type' => ['required', Rule::enum(CollectibleTypeEnum::class)],
            'name' => 'required|string',
            'amount' => 'required|numeric',
        ];
    }
}
