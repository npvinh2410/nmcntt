<?php
namespace Hydrogen\Seo\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class SeoUpdateValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'url' => 'required|unique:seo_update',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'url' => 'required|unique:seo_update',
        ]
    ];

}