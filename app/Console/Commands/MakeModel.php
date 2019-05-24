<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Foundation\Console\ModelMakeCommand;
use Illuminate\Support\Str;

class MakeModel extends ModelMakeCommand
{

    public function handle()
    {
        $name = $this->argument('name');


        if(Str::contains($name, 'Internal')){
            $args = [
                'name' => Str::replaceFirst('Internal','',$name)
            ];
            $this->call('make:abstract-model', $args);
            $this->call('make:frca-model', $args);
            $this->call('make:frc-model', $args);
        }else{
            parent::handle();
        }
    }


}
