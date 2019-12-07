<?php
namespace Hydrogen\Product\Validators\Attribute;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class AttributeValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        ],
        ValidatorInterface::RULE_UPDATE => [
        ]
    ];

}