<?php

namespace App\Http\Requests\Petstore;

use App\Enums\PetStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'photos' => ['nullable','array'],
            'photos.*' => ['string'],
            'category' => ['nullable', 'string'],
            'status' => ['nullable', new Enum(PetStatusEnum::class)],
            'photo' => ['nullable', 'file'],
            'tag' => ['nullable', 'array'],
            'tag.*' => ['string'],
            'additional_metadata' => ['nullable', 'string']
        ];
    }
}
