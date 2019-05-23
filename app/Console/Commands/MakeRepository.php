<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Console\ModelMakeCommand;

class MakeRepository extends ModelMakeCommand
{
    protected $name = 'make:repo';
    protected $type = 'Repository';

    protected function getDefaultNamespace($rootNamespace)
    {
        return "$rootNamespace\Repositories";
    }


    protected function getStub()
    {
        return storage_path('/stubs/Repository.stub');
    }
}
