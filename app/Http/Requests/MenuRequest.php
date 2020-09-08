<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            
            'fontsize' => 'required|string|max:255|min:1',
            'fontcolor' => 'required|string|max:255|min:3',
            'background' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
