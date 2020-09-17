<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'first_name'     => ucfirst(trim(preg_replace('/[^-A-Za-zÀ-ÿ ]/', '', filter_var($this->first_name, FILTER_SANITIZE_STRING)))),
            'last_name'      => ucfirst(trim(preg_replace('/[^-A-Za-zÀ-ÿ ]/', '', filter_var($this->last_name, FILTER_SANITIZE_STRING)))),
            'address'        => trim(stripslashes(filter_var($this->address, FILTER_SANITIZE_STRING))),
            'city'           => trim(preg_replace('/[^-A-Za-zÀ-ÿ0-9 ]/', '', filter_var($this->city, FILTER_SANITIZE_STRING))),
            'state'          => trim(preg_replace('/[^-A-Za-zÀ-ÿ0-9 ]/', '', filter_var($this->state, FILTER_SANITIZE_STRING))),
            'postal_code'    => trim(preg_replace('/[^-A-Za-zÀ-ÿ0-9 ]/', '', filter_var($this->postal_code, FILTER_SANITIZE_STRING)))
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'    => 'bail|required|string|min:2',
            'last_name'     => 'bail|required|string|min:2',
            'address'       => 'bail|required|string',
            'city'          => 'bail|required|string',
            'state'         => 'bail|required|string',
            'postal_code'   => 'bail|required|string',
        ];
    }
}
