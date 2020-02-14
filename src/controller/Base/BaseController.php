<?php declare(strict_types=1);

namespace App\Controller\Base;

use Slim\App;

abstract class BaseController
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

     /**
     * Send json
     *
     * @param ResponseInterface $response
     * @param array             $data
     * @return ResponseInterface
     */
    protected function withJson($response,$data,$code=200)
    {
        $payload = json_encode($data);

        $response->getBody()->write($payload);
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($code);
    }
}
