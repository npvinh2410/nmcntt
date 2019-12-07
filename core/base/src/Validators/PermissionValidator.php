<?php
namespace Hydrogen\Base\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PermissionValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|unique:roles|min:3|max:255'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|unique:roles|min:3|max:255'
        ]
    ];

}