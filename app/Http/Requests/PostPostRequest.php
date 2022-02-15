<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostPostRequest extends FormRequest
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
            'title' => 'required|max:255|min:2',
            'content' => 'required|min:5',
            'cover' => 'nullable|image|max:32000'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo é obbligatorio',
            'title.max' => 'Il titolo deve contenere max :max caratteri',
            'title.min' => 'Il titolo deve contenere almeno :min caratteri',
            'content.required' => 'Il contenuto é obbligatorio',
            'content.min' => 'Inserire almeno :min caratteri',
            'cover.image' => 'Puoi inserire solo immagini',
            'cover.max' => 'L\'immagine supera i :size Kb',
        ];
    }
}
