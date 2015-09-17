<?php

namespace AddictedToMagento\Magento2\Composer\Installer\Deployment;

use Composer\Package\Package;
use Symfony\Component\Filesystem\Filesystem;

class UninstallTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Filesystem
     */
    protected $fileSystem;
    protected $installDeployment;

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

    public function testExecute()
    {
        $this->uninstallDeployment->execute();
        $this->assertTrue(!$this->fileSystem->exists('app/code/Vendor/Project/README.MD'));
    }
}