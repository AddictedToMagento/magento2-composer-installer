<?php
namespace AddictedToMagento\Magento2\Composer\Installer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Installer\PackageEvent;
use Composer\Installer\PackageEvents;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;

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
        // TODO: Implement deployAfterInstall(PackageEvent $event) method.
    }

    /**
     * Deploy after update
     *
     * @param PackageEvent $event
     */
    public function deployAfterUpdate(PackageEvent $event)
    {
        // TODO: Implement deployAfterUpdate(PackageEvent $event) method.
    }

    public function deployAfterUninstall(PackageEvent $event)
    {
        // TODO: Implement deployAfterUninstall(PackageEvent $event) method.
    }
}