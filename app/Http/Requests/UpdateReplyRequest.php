<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateReplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return true;
        return Auth::user() !== null ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'reply_prompt' => 'required|string|max:255',
        ];
    }
    function messages()
    {
        return [
            'reply_prompt.required' => 'The message prompt is required.',
            'reply_prompt.string' => 'The message prompt must be a string.',
            'reply_prompt.max' => 'The message prompt may not be greater than 255 characters.',
        ];
    }
}
