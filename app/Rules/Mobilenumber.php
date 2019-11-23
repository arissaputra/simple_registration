<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Mobilenumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // return false;
        // remove all unnecessary character
        $value = str_replace(" ","",$value);
        $value = str_replace("(","",$value);
        $value = str_replace(")","",$value);
        $value = str_replace(".","",$value);
        
        // check if the number is Indonesian phone number
        if(substr(trim($value), 0, 3)=='+62'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please enter valid Indonesian phone number (e.g., +6282133022918)';
    }
}
