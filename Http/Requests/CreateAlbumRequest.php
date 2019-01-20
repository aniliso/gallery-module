<?php

namespace Modules\Gallery\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateAlbumRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'gallery::albums.form';

    public function rules()
    {
        return [
            'sorting'     => 'required',
            'category_id' => 'required|integer'
        ];
    }

    public function translationRules()
    {
        return [
            'title'      => 'required',
            'slug'       => "required|unique:gallery__album_translations,slug,null,album_id,locale,$this->localeKey",
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
