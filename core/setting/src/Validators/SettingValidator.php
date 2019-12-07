<?php
namespace Hydrogen\Setting\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class SettingValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'key' => 'required|unique:settings',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'key' => 'required|unique:settings',
        ]
    ];

}