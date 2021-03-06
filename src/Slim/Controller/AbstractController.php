<?php
namespace Serato\SwsApp\Slim\Controller;

use Serato\SwsApp\Slim\Handlers\Error as ErrorHandler;
use Slim\Http\Response as SlimResponse;
use Serato\SwsApp\Http\Rest\Exception\AbstractException as ClientException;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Abstract Controller
 *
 * Base controller class from which all controllers should extend.
 */
abstract class AbstractController
{
    /**
     * PSR-3 Logger interface
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Construct the controller
     *
     * @param LoggerInterface   $logger   A PSR-3 logger interface
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Get the logger interface
     *
     * @return LoggerInterface
     */
    public function getLogger() : LoggerInterface
    {
        return $this->logger;
    }

    /**
     * Callable implementation. Controllers are registered to routes as
     * callables which dictates the method signature.
     *
     * @param  Request     $request            Request interface
     * @param  Response    $response           Response interface
     * @param  array       $args               Request args
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args) : Response
    {
        return $this->execute($request, $response, $args);
    }

    /**
     * Simulate a controller invocation. For testing purposes only.
     *
     * @param Request       $request            Request interface
     * @param array         $uriArgs            Name/value pairs of dynamic URI parameters
     * @param bool          $catchClientErrors  When true catch client errors and invoke the error handler
     *
     * @return Response
     */
    public function mockInvoke(
        Request $request,
        array $uriArgs = [],
        bool $catchClientErrors = false
    ) : Response {
        $response = new SlimResponse();

        if ($catchClientErrors) {
            try {
                return $this->__invoke($request, $response, $uriArgs);
            } catch (ClientException $e) {
                $error = new ErrorHandler('Controller MockInvoke', false, $this->getLogger());
                // Returns a Response object
                return $error($request, $response, $e);
            }
        } else {
            return $this->__invoke($request, $response, $uriArgs);
        }
    }

    /**
     * Execute the endpoint action
     *
     * @todo Specify void return type in PHP 7.1
     *
     * @param  Request     $request            Request interface
     * @param  Response    $response           Response interface
     * @param  array       $args               Request URI args
     *
     * @return Response
     */
    abstract protected function execute(
        Request $request,
        Response $response,
        array $args
    ) : Response;
}
