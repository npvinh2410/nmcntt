<?php
namespace Hydrogen\Widget\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class WidgetValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [

        ],
        ValidatorInterface::RULE_UPDATE => [
        ]
    ];

}