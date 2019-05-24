<?php

namespace App;

use Illuminate\Console\Scheduling\ManagesFrequencies;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class EndpointCallSchedule extends Model
{
    use ManagesFrequencies;
    public $expression = '* * * * *';

    protected $fillable = [
        'cron', 'endpoint_id'
    ];

    /**
     * @throws \BadMethodCallException
     */
    public static function withFrequency($frequency)
    {
        $i = new self();

        if ($frequency !== '* * * * *') {
            $frequency = $i->$frequency()->expression;
        }

        return new EndpointCallSchedule([
            'cron' => $frequency
        ]);
    }

    public function endpoint()
    {
        return $this->belongsTo(ApiEndpoint::class, 'endpoint_id');
    }

}
