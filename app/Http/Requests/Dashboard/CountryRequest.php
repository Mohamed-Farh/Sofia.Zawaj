<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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

    // "name" => "required|string",
    // "email" => "required|unique:patients,email",
    // "phone" => "required|unique:patients,phone",
    // "password" => "required|confirmed|min:8",
    // "image" => "required|file|mimes:png,jpg,svg",
    // "gender" => "required|in:0,1",
    // "d_o_b" => 'required|date',
    // "city_id" => 'required|exists:cities,id',
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (session("statusEdit") == 0) :
            return [
                'name'    => 'required|unique:countries,name',
                'image'      => 'required|mimes:png,jpg,jpeg,svg'

            ];


        else :
            return [
                'name'    => 'required|unique:countries,name,' . session("idEdit"),
                'image'      => 'required|mimes:png,jpg,jpeg,svg'



            ];
        endif;
    }


    public function messages()
    {
        return [
            "name_ar.required" => "The Name in Arabic is Required",
            "name_en.required" => "The Name in English is Required",
            "name_ro.required" => "The Name in Română is Required",
            "name_ar.unique" => "This Name is already exists",
            "name_en.unique" => "This Name is already exists",
            "name_ro.unique" => "This Name is already exists",

        ];
    }
}
