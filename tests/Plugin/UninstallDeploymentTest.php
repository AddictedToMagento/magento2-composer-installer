<?php

namespace AddictedToMagento\Magento2\Composer\Installer\Deployment;

use AddictedToMagento\Magento2\Composer\Installer\Plugin\UninstallDeployment;
use AddictedToMagento\Magento2\Composer\Installer\Plugin\DeploymentFactory;
use Composer\Package\Package;
use Symfony\Component\Filesystem\Filesystem;

class UninstallTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Filesystem
     */
    protected $fileSystem;

    /**
     * @var UninstallDeployment
     */
    protected $uninstallDeployment;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->fileSystem = new Filesystem();

        $this->fileSystem->mkdir('app/code/Vendor/Project');
        $this->fileSystem->touch('app/code/Vendor/Project/README.MD');

        $package = $this->getMock(Package::class, ['getName', 'getType', 'getExtra'], [], '', false);
        $package->method('getName')->willReturn('vendor/project');

        $package->method('getType')->willReturn('magento2-module');
        $package->method('getExtra')->willReturn(['map' => [['src/*', 'Vendor/Project']]]);

        $this->uninstallDeployment = DeploymentFactory::createUninstallDeployment($package);
    }

    /**
     * Test execute method of uninstall deployment
     */
    public function testExecute()
    {
        $this->uninstallDeployment->execute();
        $this->assertTrue(!$this->fileSystem->exists('app/code/Vendor/Project/README.MD'));
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->fileSystem->remove('app');
    }
}