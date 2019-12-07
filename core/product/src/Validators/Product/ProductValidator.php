<?php
namespace Hydrogen\Product\Validators\Product;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProductValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'sku' => 'required|unique:products'
        ],
        ValidatorInterface::RULE_UPDATE => [

        ]
    ];

}