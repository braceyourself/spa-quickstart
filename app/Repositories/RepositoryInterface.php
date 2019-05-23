<?php

namespace App\Repositories;


interface RepositoryInterface
{

    public static function all();

    public static function create(array $data);

    public static function update($id, array $data);

    public static function delete($id);

    public static function show($id);
}
