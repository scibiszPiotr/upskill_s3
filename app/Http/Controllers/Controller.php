<?php

namespace App\Http\Controllers;

use Aws\Sdk;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function form()
    {
        $sdk = new Sdk([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest'
        ]);
        $client = $sdk->createS3();

        $expiry = "+10 minutes";

        $cmd = $client->getCommand('PutObject', [
            'Bucket' => config('filesystems.disks.s3.bucket'),
            'Key' => fake()->firstName,
            'ACL' => 'public-read',
        ]);

        $request = $client->createPresignedRequest($cmd, $expiry);

        return response()->view('form', ['url' => (string)$request->getUri()], 201);
    }

    public function getList(): \Illuminate\Http\JsonResponse
    {
        $response = Http::get(config('app.url_app_db') . '/picture');

        return response()->json(json_decode($response->body() ));
    }
}