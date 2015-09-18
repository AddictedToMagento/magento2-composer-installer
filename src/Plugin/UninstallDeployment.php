<?php
namespace AddictedToMagento\Magento2\Composer\Installer\Plugin;

class UninstallDeployment extends BaseDeployment
{
    /**
     * Execute
     *
     * @return void
     */
    public function execute()
    {
        if (!$this->canExecute()) {
            return;
        }

        $this->remove();
    }

    /**
     * Remove files and directories
     */
    protected function remove()
    {
        $firstPartOfToPath = $this->getFirstPartOfToPath();
        $this->filesystem->remove($firstPartOfToPath);
    }
}