<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
        if (session("statusEdit") == 0) :
            return [
                'name_ar'    => 'required|unique:cities,name_ar',
                'name_en'    => 'required|unique:cities,name_en',
                'name_ro'    => 'required|unique:cities,name_ro',
                'country_id'      => 'required|exists:countries,id'

            ];


        else :
            return [
                'name_ar'    => 'required|unique:cities,name_ar,' . session("idEdit"),
                'name_ro'    => 'required|unique:cities,name_ro,' . session("idEdit"),
                'name_en'    => 'required|unique:cities,name_en,' . session("idEdit"),
                'country_id'      => 'required|exists:countries,id'



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
            "country_id.exists" => "invalided Country",
            "country_id.required" => "Country Name is Required ",

        ];
    }
}
