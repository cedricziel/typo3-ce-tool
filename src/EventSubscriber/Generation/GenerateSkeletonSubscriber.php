<?php

namespace CedricZiel\T3CETool\EventSubscriber\Generation;

use CedricZiel\T3CETool\Event\GeneratePrepareEvent;
use League\Flysystem\MountManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig_Environment;

/**
 * @package CedricZiel\T3CETool\EventSubscriber\Generation
 */
class GenerateSkeletonSubscriber implements EventSubscriberInterface
{
    /**
     * @var MountManager
     */
    private $filesystemManager;

    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @param MountManager     $filesystemManager
     * @param Twig_Environment $twig
     */
    public function __construct(MountManager $filesystemManager, Twig_Environment $twig)
    {
        $this->filesystemManager = $filesystemManager;
        $this->twig = $twig;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     * The array keys are event names and the value can be:
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     * For instance:
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            't3ce:project:generate:pre' => ['generateSkeleton'],
        ];
    }

    /**
     * Generates the skeleton
     *
     * @param GeneratePrepareEvent $generatePrepareEvent
     */
    public function generateSkeleton(GeneratePrepareEvent $generatePrepareEvent)
    {
        $skeletonBaseDir = 'Resources/skeletons/extension';
        $skeletonFiles = $this->filesystemManager->listContents('system://'.$skeletonBaseDir.'', true);

        foreach ($skeletonFiles as $skeletonObject) {
            // No need to copy directories around
            if ($this->isDir($skeletonObject)) {
                continue;
            }

            if ($this->isTemplatable($skeletonObject)) {
                echo 'Templatable: '.PHP_EOL;
                print_r($skeletonObject);
                $this->transpileFromSkeletonToExtension(
                    $skeletonObject,
                    $skeletonBaseDir,
                    [
                        'project' => $generatePrepareEvent->getProject(),
                    ]
                );
            } else {
                echo 'NOT Templatable: '.PHP_EOL;
                print_r($skeletonObject);
                $this->copyFromSkeletonToExtension($skeletonObject, $skeletonBaseDir);
            }
        }
    }

    /**
     * @param array $skeletonObject
     *
     * @return bool
     */
    protected function isDir($skeletonObject)
    {
        return $skeletonObject['type'] === 'dir';
    }

    /**
     * @param array  $skeletonObject
     * @param string $base
     *
     * @return bool
     */
    protected function copyFromSkeletonToExtension($skeletonObject, $base)
    {
        $trimmedPath = substr($skeletonObject['path'], strlen($base));

        if ($this->filesystemManager->has('ext://'.$trimmedPath)) {
            echo 'Cannot copy'.PHP_EOL;

            return false;
        }

        return $this->filesystemManager->copy(
            'system://'.$skeletonObject['path'],
            'ext://'.$trimmedPath
        );
    }

    /**
     * @param array  $skeletonObject
     * @param string $base
     *
     * @return bool
     */
    protected function transpileFromSkeletonToExtension($skeletonObject, $base)
    {

        $template = $this->twig->createTemplate($this->filesystemManager->read('system://'.$skeletonObject['path']));
    }

    /**
     * @param string $filename
     *
     * @return bool
     */
    private function isTemplatable($filename)
    {
        return $filename['extension'] === 'twig';
    }
}
