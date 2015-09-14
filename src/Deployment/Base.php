<?php
namespace AddictedToMagento\Magento2\Composer\Installer\Deployment;

use Composer\Package\Package;

abstract class Base
{
    /**
     * @var Package $package
     */
    protected $package;

    /**
     * @var $map
     */
    protected $map;

    /**
     * @var array $availableType
     */
    protected $availableType = [
        'magento2-module'       => 'app/code',
        'magento2-theme'        => 'app/design',
        'magento2-language'     => 'app/i18n',
        'magento2-library'      => 'lib/internal',
        'magento2-component'    => '.'
    ];

    /**
     * Construct
     *
     * @param Package $package
     */
    public function __construct(
        Package $package
    )
    {
        $this->package = $package;
    }

    /**
     * Execute
     *
     * @return mixed
     */
    abstract public function execute();

    /**
     * Retrieve map
     *
     * @return array
     */
    protected function getMap()
    {
        if($this->map == null) {
            $this->map = [];
            $extra = $this->package->getExtra();

            if(array_key_exists('map', $extra)) {
                $this->map = $extra['map'];
            }
        }

        return $this->map;
    }

    /**
     * Retrieve from
     *
     * @return string
     */
    protected function getFrom()
    {
        $map = $this->getMap();

        if(array_key_exists(0, $map) && array_key_exists(0, $map[0])) {
            return $map[0][0];
        }

        return '';
    }

    /**
     * Retrieve to
     *
     * @return string
     */
    protected function getTo()
    {
        $map = $this->getMap();

        if(array_key_exists(0, $map) && array_key_exists(1, $map[0])) {
            return $map[0][1];
        }

        return '';
    }
}