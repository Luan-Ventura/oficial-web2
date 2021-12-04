<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'modelo' => [
                'required',
                'min:1',
                'max:32',
            ],
            'potencia' => [
                'required',
                'min:1',
                'max:32',
            ],
            'ano' => [
                'required',
                'min:1',
                'max:4',
            ],
            'torque' => [
                'required',
                'min:1',
                'max:32',
            ],
            'combustivel' => [
                'required',
                'min:1',
                'max:32',
            ],
        ];
    }
}
