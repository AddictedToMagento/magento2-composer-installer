<?php
namespace AddictedToMagento\Magento2\Composer\Installer\Plugin;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\Glob;
use Symfony\Component\Finder\SplFileInfo;

class InstallDeployment extends BaseDeployment
{
    /**
     * Execute
     *
     * @return void
     */
    public function execute()
    {
        if(!$this->canExecute()) {
            return;
        }

        $this->copy();
    }

    /**
     * Copy files and directories
     */
    protected function copy()
    {
        $firstPartOfFromPath = $this->getFirstPartOfFromPath();
        $firstPartOfToPath = $this->getFirstPartOfToPath();

        foreach ($this->finder->in($firstPartOfFromPath) as $value) {
            $fromPath = $value->getPathName();
            $toPath = $firstPartOfToPath . DIRECTORY_SEPARATOR . str_replace($firstPartOfFromPath, '', $fromPath);

            if ($value->isFile()) {
                $this->filesystem->copy($value->getPathName(), $toPath);
            } elseif ($value->isDir()) {
                $this->filesystem->mkdir($toPath);
            }
        }
    }
}