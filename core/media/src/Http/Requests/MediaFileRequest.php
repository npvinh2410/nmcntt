<?php

namespace Hydrogen\Media\Http\Requests;

class MediaFileRequest extends Request
{
    public function rules()
    {
        $rules = [];
        $files = $this->file('file', []);

        if (!empty($files)) {
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $key => $file) {
                $rules['file.' . $key] = 'required|mimes:' . config('media.allowed_mime_types');
            }
        }

        return $rules;
    }

    public function attributes()
    {
        $files = $this->file('file', []);
        $attributes = [];
        if (!empty($files)) {
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $key => $file) {
                $attributes['file.' . $key] = 'file';
            }
        }

        return $attributes;
    }
}