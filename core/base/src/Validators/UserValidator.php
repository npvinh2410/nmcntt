<?php
namespace Hydrogen\Base\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'email' => 'required|unique:users|min:3|max:255',
            'password' => 'required|confirmed|min:8|max:255'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'email' => 'required|unique:users|min:3|max:255',
            'password' => 'confirmed|min:8|max:255'
        ]
    ];

}