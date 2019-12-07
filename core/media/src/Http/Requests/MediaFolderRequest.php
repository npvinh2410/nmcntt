<?php

namespace Hydrogen\Media\Http\Requests;


class MediaFolderRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[\pL\s\ \_\-0-9]+$/u'
        ];
    }
}