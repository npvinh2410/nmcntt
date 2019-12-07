<?php
namespace Hydrogen\Product\Validators\Attribute;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class AttributeTransValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|unique:attributesTrans'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|unique:attributesTrans'
        ]
    ];

}