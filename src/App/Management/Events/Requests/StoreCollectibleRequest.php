<?php

namespace App\Management\Events\Requests;

use Domain\Event\Enums\CollectibleTypeEnum;
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
