<?php
namespace Hydrogen\Seo\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class SeoValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [

        ],
        ValidatorInterface::RULE_UPDATE => [

        ]
    ];

}