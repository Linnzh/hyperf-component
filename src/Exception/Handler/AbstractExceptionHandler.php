<?php


namespace Linnzh\HyperfComponent\Exception\Handler;


use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Logger\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected StdoutLoggerInterface $logger;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $fileLogger;

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    public function __construct(StdoutLoggerInterface $logger, RequestInterface $request, LoggerFactory $loggerFactory)
    {
        $this->logger = $logger;
        $this->request = $request;
        $this->fileLogger = $loggerFactory->get('exception', 'exception');
    }

    public function handle(\Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        $this->stopPropagation();

        $message = $this->getErrorMessage($throwable);

        $this->logger->error(sprintf('%s[%s] in %s', $message, $throwable->getLine(), $throwable->getFile()));

        $data = [
            'file' => $throwable->getFile(),
            'line' => $throwable->getLine(),
            'msg' => $message,
            'body' => $this->request->getParsedBody(),
            'url' => $this->request->getRequestUri(),
            'method' => $this->request->getMethod(),
            'code' => $throwable->getCode(),
        ];
        $this->fileLogger->error($message, $data);

        return $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'text/json; charset=utf-8')
            ->withBody(new SwooleStream(
                (new \Linnzh\HyperfComponent\Util\Response\JsonResponse())
                    ->setCode((int) $throwable->getCode())
                    ->setMessage($message)
                    ->toJson()
            ));
    }

    public function getErrorMessage(\Throwable $throwable): string
    {
        if ($throwable instanceof \Hyperf\Validation\ValidationException) {
            return $throwable->validator->errors()->first();
        }

        return $throwable->getMessage();
    }
}
