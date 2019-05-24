<?php


namespace App\Repositories;


use App\Jobs\CallApiEndpoint;

class Repository implements RepositoryInterface
{

    private $api;
    private $endpoint;

    public static function all()
    {
        // TODO: Implement all() method.
    }

    public static function create(array $data)
    {

    }

    public static function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    public static function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public static function show($id)
    {
        // TODO: Implement show() method.
    }

    protected static function sendRequest($uri, $data){

    }
}
