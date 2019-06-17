<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class User extends FormRequest
{
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
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($this->id),
            ],
            'phone_number'  => 'required|max:16',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
