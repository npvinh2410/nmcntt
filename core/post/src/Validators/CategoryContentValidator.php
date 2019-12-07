<?php
namespace Hydrogen\Post\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class CategoryContentValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'slug' => 'required|unique:categoryContent'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'slug' => 'required|unique:categoryContent'
        ]
    ];

}