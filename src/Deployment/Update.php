<?php
namespace AddictedToMagento\Magento2\Composer\Installer\Deployment;

use Composer\Package\Package;

class Update extends Base
{
    /**
     * @var Package $initialPackage
     */
    protected $initialPackage;

    public function __construct(
        Package $initialPackage,
        Package $package
    )
    {
        $this->initialPackage = $initialPackage;
        parent::__construct($package);
    }

    /**
     * Execute
     *
     * @return mixed
     */
    public function execute()
    {
        // TODO: Implement execute() method.
    }
}