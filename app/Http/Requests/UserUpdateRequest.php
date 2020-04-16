<?php

namespace App\Http\Requests;

use App\Traits\Obfuscate\Optimuss;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    use Optimuss;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'unique:users,email,' . $this->removeStringDecode($this->get('id')),
        ];
    }
}