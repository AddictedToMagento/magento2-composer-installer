<?php

namespace AddictedToMagento\Magento2\Composer\Installer\Plugin;

use Composer\Package\Package;
use Symfony\Component\Filesystem\Filesystem;

class InstallDeploymentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Filesystem
     */
    protected $fileSystem;
    protected $installDeployment;

    protected function setUp()
    {
        $this->fileSystem = new Filesystem();

        $this->fileSystem->mkdir('vendor/vendor/project/src');
        $this->fileSystem->touch('vendor/vendor/project/src/README.MD');

        $package = $this->getMock(Package::class, ['getName', 'getType', 'getExtra'], [], '', false);
        $package->method('getName')->willReturn('vendor/project');

        $package->method('getType')->willReturn('magento2-module');
        $package->method('getExtra')->willReturn(['map' => [['src/*', 'Vendor/Project']]]);

        $this->installDeployment = DeploymentFactory::createInstallDeployment($package);
    }

    public function testExecute()
    {
        $this->installDeployment->execute();
        $this->assertTrue($this->fileSystem->exists('app/code/Vendor/Project/README.MD'));
    }

    protected function tearDown()
    {
        $this->fileSystem->remove('vendor');
        $this->fileSystem->remove('app');
    }
}