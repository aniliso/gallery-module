<?php

namespace Modules\Gallery\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateAlbumRequest extends BaseFormRequest
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
        $id = $this->route()->parameter('album')->id;
        return [
            'title'      => 'required',
            'slug'       => "required|unique:gallery__album_translations,slug,$id,album_id,locale,$this->localeKey",
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
