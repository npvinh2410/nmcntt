<?php
namespace Hydrogen\Product\Validators\Product;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProductTransValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'slug' => 'required|unique:productTrans'
        ],
        ValidatorInterface::RULE_UPDATE => [

        ]
    ];

}