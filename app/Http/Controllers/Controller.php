<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
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
        $client = new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
        ]);
        $bucket = config('filesystems.disks.s3.bucket');

        $formInputs = ['key' => fake()->name];

        $options = [
            ['bucket' => $bucket],
            ['starts-with', '$key', 'all/'],
        ];

        $expires = '+2 hours';

        $postObject = new \Aws\S3\PostObjectV4(
            $client,
            $bucket,
            $formInputs,
            $options,
            $expires
        );

        $formAttributes = $postObject->getFormAttributes();

        $formInputs = $postObject->getFormInputs();

        return response()->view('form', [
            'url' => $formAttributes['action'],
            'formAttr' => $formInputs
        ], 200);
    }

    public function getList(): \Illuminate\Http\JsonResponse
    {
        $response = Http::get(config('app.url_app_db') . '/picture');

        return response()->json(json_decode($response->body() ));
    }
}
