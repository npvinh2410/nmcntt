<?php
namespace Hydrogen\Slider\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class SliderValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [

        ],
        ValidatorInterface::RULE_UPDATE => [
        ]
    ];

}