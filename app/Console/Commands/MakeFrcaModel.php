<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Console\ModelMakeCommand;

class MakeFrcaModel extends ModelMakeCommand
{
    protected $name = 'make:frca-model';
    protected $type = 'FRCA Model';

    protected function getDefaultNamespace($rootNamespace)
    {
        return "$rootNamespace\FRCA";
    }


    protected function getStub()
    {
        return storage_path('/stubs/FrcaModel.stub');
    }
}
