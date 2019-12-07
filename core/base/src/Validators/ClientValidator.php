<?php
namespace Hydrogen\Base\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'phone' => 'required|unique:clients',
            'name' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'phone' => 'required|unique:clients',
            'name' => 'required',
        ]
    ];

}