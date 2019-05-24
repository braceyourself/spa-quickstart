<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Console\ModelMakeCommand;

class MakeAbstractModel extends ModelMakeCommand
{
    protected $name = 'make:abstract-model';
    protected $type = 'Abstract Model';

    protected function getDefaultNamespace($rootNamespace)
    {
        return "$rootNamespace\Internal";
    }

    protected function getStub()
    {
        return storage_path('/stubs/AbstractModel.stub');
    }
}
