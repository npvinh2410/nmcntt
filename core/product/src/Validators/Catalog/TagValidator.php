<?php
namespace Hydrogen\Product\Validators\Catalog;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class TagValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        ],
        ValidatorInterface::RULE_UPDATE => [
        ]
    ];

}