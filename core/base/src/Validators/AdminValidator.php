<?php
namespace Hydrogen\Base\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AdminValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
        ]
    ];

}