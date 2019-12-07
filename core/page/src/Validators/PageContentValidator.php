<?php
namespace Hydrogen\Page\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class PageContentValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'slug' => 'required|unique:pageContent'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'slug' => 'required|unique:pageContent'
        ]
    ];

}