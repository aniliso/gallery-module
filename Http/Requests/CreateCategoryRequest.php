<?php

namespace Modules\Gallery\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateCategoryRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'gallery::categories.form';

    public function rules()
    {
        return [
            'sorting' => 'required'
        ];
    }

    public function translationRules()
    {
        return [
            'title' => 'required',
            'slug'  => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
