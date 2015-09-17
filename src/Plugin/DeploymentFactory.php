<?php
namespace AddictedToMagento\Magento2\Composer\Installer\Plugin;

use Composer\Package\Package;

class DeploymentFactory
{
    /**
     * Create install deployment
     *
     * @param Package $package
     * @return InstallDeployment
     */
    public static function createInstallDeployment($package)
    {
        return new InstallDeployment($package);
    }

    /**
     * Create uninstall deployment
     *
     * @param Package $package
     * @return UninstallDeployment
     */
    public static function createUninstallDeployment($package)
    {
        return new UninstallDeployment($package);
    }
}