<?php

namespace App\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class ClubRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */

    public function rules(): array
    {
        return [
            'club_name' => ['required', 'string', 'min:4','max:80',\Illuminate\Validation\Rule::unique('clubs')->ignore($this->club)],
            'club_slug' => ['required', 'string', 'min:3','max:5',\Illuminate\Validation\Rule::unique('clubs')->ignore($this->club)],
            'club_content' => ['required', 'string','min:4'],
            'club_department' => ['required', 'string', 'min:3', 'max:60'],
            'club_manager' => 'nullable',
            'file' => ['nullable','max:10000']
        ];
    }
}
