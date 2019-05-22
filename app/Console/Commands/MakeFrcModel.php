<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Console\ModelMakeCommand;

class MakeFrcModel extends ModelMakeCommand
{
    protected $name = 'make:frc-model';
    protected $type = 'FRC Model';

    protected function getDefaultNamespace($rootNamespace)
    {
        return "$rootNamespace\FRC";
    }


    protected function getStub()
    {
        return storage_path('/stubs/FrcModel.stub');
    }
}
