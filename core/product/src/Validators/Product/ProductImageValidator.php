<?php
namespace Hydrogen\Product\Validators\Product;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProductImageValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        ],
        ValidatorInterface::RULE_UPDATE => [
        ]
    ];

}