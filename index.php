<?php require 'vendor/autoload.php';

$container = new \Slim\Container([
    'http' => function () {
        return new GuzzleHttp\Client();
    }
]);

$app = new \Slim\App($container);

$app->get('/locations/{id}', function ($request, $response, $args)
{
    // Get the weather from MetaWeather
    $result = $this->http->get("https://www.metaweather.com/api/location/{$args
                                ['id']}")
                            ->getBody()
                            ->getContents();

    // Return the results as JSON
    return $response->withStatus(200)->withJson(json_decode($result));
});

$app->delete('/locations/{id}', function ($request, $response, $args)
    {
        return $response->withStatus(200)->write("Location {$args['id']} deleted.");
    });

$app->run();