<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SelectedDates implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = array_count_values($value);
        $value = array_values($value);
        
        $iterate = count($value);
        $odd = false;
        for( $i=0 ; $i<$iterate ; $i++ ){
            if($value[$i] % 2 == 0 ){
                continue;
            }
            else{
                $odd = true;
            }
        }

        if($odd == false){
            $fail('Please Select a Mock Date');
        }
    }
}
