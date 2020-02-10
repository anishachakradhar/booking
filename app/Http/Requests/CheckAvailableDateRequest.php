<?php

namespace App\Http\Requests;

use App\Rules\CheckHasAvailableSeatRule;
use Illuminate\Foundation\Http\FormRequest;

class CheckAvailableDateRequest extends FormRequest
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
            'available_date_id' => [
                'required',
                'exists:available_dates,available_date_id',
                new CheckHasAvailableSeatRule()
            ],
        ];
    }
}
