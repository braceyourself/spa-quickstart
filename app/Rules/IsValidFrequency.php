<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsValidFrequency implements Rule
{
    private $frequency;
    private const OPTIONS = [
"everyMinute",
"everyFiveMinutes",
"everyTenMinutes",
"everyFifteenMinutes",
"everyThirtyMinutes",
"hourly",
"hourlyAt",// (hour)
"daily"
//dailyAt (time)
//twiceDaily (first, second)
//weekly
//weeklyOn (day, time)
//monthly
//monthlyOn (day, time)
//quarterly
//yearly
        ];

    /**
     * Create a new rule instance.
     *
     * @param $frequency
     */
    public function __construct($frequency)
    {
        $this->frequency = $frequency;
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


    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
