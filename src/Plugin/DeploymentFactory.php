<?php
namespace AddictedToMagento\Magento2\Composer\Installer\Plugin;

use Composer\Package\PackageInterface;

class DeploymentFactory
{
    /**
     * Create install deployment
     *
     * @param PackageInterface $package
     * @return InstallDeployment
     */
    public static function createInstallDeployment($package)
    {
        return new InstallDeployment($package);
    }

    /**
     * Create uninstall deployment
     *
     * @param PackageInterface $package
     * @return UninstallDeployment
     */
    public static function createUninstallDeployment($package)
    {
        return new UninstallDeployment($package);
    }
}