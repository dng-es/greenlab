<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:2',
            'last_name' => 'required|string|max:255|min:2',
/*            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
            'born_at' => 'required|date|before_or_equal:'.(Carbon::now()->addYears(-18)->format('Y-m-d')),
        ];
    }
}
