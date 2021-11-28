<?php

namespace App;

use App\EventSubscriber\ApiExceptionSubscriber;
use App\Exception\FatalThrowableError;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function handle(Request $request, int $type = HttpKernelInterface::MAIN_REQUEST, bool $catch = true)
    {
        try {
            return parent::handle($request, $type, $catch);
        } catch (\Exception $exception) {
            throw new \Exception('There was an issue booting the framework');
        } catch (\Throwable $throwable) {
            $exception = new FatalThrowableError($throwable);
            $event = new ExceptionEvent($this, $request, $type, $exception);
            /** @var ApiExceptionSubscriber $exceptionSubscriber */
            $exceptionSubscriber = $this->container->get(ApiExceptionSubscriber::class);
            $exceptionSubscriber->onKernelException($event);
            /** @var Response $response */
            $response = $event->getResponse();

            return $response;
        }
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/services.yaml')) {
            $container->import('../config/services.yaml');
            $container->import('../config/{services}_'.$this->environment.'.yaml');
        } else {
            $container->import('../config/{services}.php');
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import('../config/{routes}/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/routes.yaml')) {
            $routes->import('../config/routes.yaml');
        } else {
            $routes->import('../config/{routes}.php');
        }
    }
}
