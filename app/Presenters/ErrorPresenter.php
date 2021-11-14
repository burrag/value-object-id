<?php declare(strict_types = 1);

namespace App\Presenters;

use Nette;
use Nette\Application\BadRequestException;
use Nette\Application\Helpers;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses;
use Nette\Application\Responses\CallbackResponse;
use Nette\Http\IRequest;
use Nette\Http\IResponse;
use Tracy\ILogger;

final class ErrorPresenter implements Nette\Application\IPresenter
{
    use Nette\SmartObject;

    private ILogger $logger;

    public function __construct(ILogger $logger)
    {
        $this->logger = $logger;
    }

    public function run(Request $request): Response
    {
        $exception = $request->getParameter('exception');

        if ($exception instanceof BadRequestException) {
            [$module, , $sep] = Helpers::splitName($request->getPresenterName());

            return new Responses\ForwardResponse($request->setPresenterName($module . $sep . 'Error4xx'));
        }

        $this->logger->log($exception, ILogger::EXCEPTION);

        return new CallbackResponse(static function(IRequest $httpRequest, IResponse $httpResponse): void {
            if (\preg_match('#^text/html(?:;|$)#', (string) $httpResponse->getHeader('Content-Type'))) {
                require __DIR__ . '/templates/Error/500.phtml';
            }
        });
    }
}
