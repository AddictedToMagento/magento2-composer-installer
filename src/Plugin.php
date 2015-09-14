<?php
namespace AddictedToMagento\Magento2\Composer\Installer;

use Composer\Composer;
use Composer\DependencyResolver\Operation\InstallOperation;
use Composer\DependencyResolver\Operation\UninstallOperation;
use Composer\DependencyResolver\Operation\UpdateOperation;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Installer\PackageEvent;
use Composer\Installer\PackageEvents;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface, EventSubscriberInterface
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     * * The method name to call (priority defaults to 0)
     * * An array composed of the method name to call and the priority
     * * An array of arrays composed of the method names to call and respective
     *   priorities, or 0 if unset
     *
     * For instance:
     *
     * * array('eventName' => 'methodName')
     * * array('eventName' => array('methodName', $priority))
     * * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array(
            PackageEvents::POST_PACKAGE_INSTALL => 'deployAfterInstall',
            PackageEvents::POST_PACKAGE_UNINSTALL => 'deployAfterUninstall',
            PackageEvents::POST_PACKAGE_UPDATE => 'deployAfterUpdate'
        );
    }

    /**
     * Apply plugin modifications to composer
     *
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        // TODO: Implement activate() method.
    }

    /**
     * Deploy after install
     *
     * @param PackageEvent $event
     */
    public function deployAfterInstall(PackageEvent $event)
    {
        /** @var  $operation InstallOperation */
        $operation = $event->getOperation();

        $package = $operation->getPackage();
    }

    /**
     * Deploy after update
     *
     * @param PackageEvent $event
     */
    public function deployAfterUpdate(PackageEvent $event)
    {
        /** @var  $operation UpdateOperation */
        $operation = $event->getOperation();

        $initialPackage = $operation->getInitialPackage();
        $targetPackage = $operation->getTargetPackage();
    }

    public function deployAfterUninstall(PackageEvent $event)
    {
        /** @var  $operation UninstallOperation */
        $operation = $event->getOperation();

        $package = $operation->getPackage();

    }
}