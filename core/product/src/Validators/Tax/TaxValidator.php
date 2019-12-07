<?php
namespace Hydrogen\Product\Validators\Tax;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class TaxValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|unique:taxes'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|unique:taxes'
        ]
    ];

}