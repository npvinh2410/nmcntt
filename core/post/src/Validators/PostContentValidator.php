<?php
namespace Hydrogen\Post\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class PostContentValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'slug' => 'required|unique:postContent'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'slug' => 'required|unique:postContent'
        ]
    ];

}