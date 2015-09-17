<?php
namespace AddictedToMagento\Magento2\Composer\Installer\Plugin;

use Composer\Package\Package;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

abstract class BaseDeployment
{
    /**
     * @var Finder
     */
    protected $finder;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var Package
     */
    protected $package;

    /**
     * @var array
     */
    protected $map;

    /**
     * @var array
     */
    protected $installPaths = [
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
    ) {
        $this->package = $package;
        $this->finder = new Finder();
        $this->filesystem = new Filesystem();
    }

    /**
     * Execute
     *
     * @return void
     */
    abstract public function execute();

    /**
     * Can execute
     *
     * @return bool
     */
    protected function canExecute()
    {
        return $this->getMapFrom() != ''
            && $this->getMapFrom() != ''
            && array_key_exists($this->package->getType(), $this->installPaths);
    }

    /**
     * Retrieve map
     *
     * @return array
     */
    protected function getMap()
    {
        if ($this->map == null) {
            $this->map = [];
            $extra = $this->package->getExtra();

            if (array_key_exists('map', $extra)) {
                $this->map = $extra['map'];
            }
        }

        return $this->map;
    }

    /**
     * Retrieve map from
     *
     * @return string
     */
    protected function getMapFrom()
    {
        $map = $this->getMap();

        if (array_key_exists(0, $map) && array_key_exists(0, $map[0])) {
            return $map[0][0];
        }

        return '';
    }

    /**
     * Retrieve map to
     *
     * @return string
     */
    protected function getMapTo()
    {
        $map = $this->getMap();

        if (array_key_exists(0, $map) && array_key_exists(1, $map[0])) {
            return $map[0][1];
        }

        return '';
    }

    /**
     * Retrieve first part of to path
     *
     * @return string
     */
    protected function getFirstPartOfToPath()
    {
        return $this->installPaths[$this->package->getType()] . DIRECTORY_SEPARATOR . $this->getMapTo();
    }

    /**
     * Retrieve first part of from path
     *
     * @return string
     */
    protected function getFirstPartOfFromPath()
    {
        $mapFrom = $this->getMapFrom();

        if ($mapFrom == '*') {
            $mapFrom = '';
        }

        if (substr($mapFrom, -2, 2) == DIRECTORY_SEPARATOR . '*') {
            $mapFrom = substr($mapFrom, 0, strlen($mapFrom) - 1);
        }

        return 'vendor/' . $this->package->getName() . '/' . $mapFrom;
    }
}