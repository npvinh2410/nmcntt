<?php

use Hydrogen\Product\Models\Attribute\Attribute;
use Hydrogen\Product\Models\Attribute\AttributeValue;

if (!function_exists('get_attribute_value')) {
    function get_attribute_value($attributes, $flag = false)
    {

        $rs = [];



        foreach ($attributes as $attribute)
        {

            $attribute_obj = Attribute::where('id', $attribute->id)->first();

            $values = json_decode($attribute->value);

            foreach ($values as $value)
            {
                if($flag == false)
                {
                    $value_obj[] = AttributeValue::where('id', $value)->first();
                }
                else
                {
                    $value_obj[] = $value;
                }

            }

            $tmp['attribute'] = $attribute_obj;
            $tmp['attributeValue'] = $value_obj;
            $rs[] = $tmp;
            $value_obj = [];
        }

        return $rs;

    }
}