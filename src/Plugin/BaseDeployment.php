<?php
namespace AddictedToMagento\Magento2\Composer\Installer\Plugin;

use Composer\Package\PackageInterface;
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
     * @var PackageInterface
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
        'magento2-module' => 'app/code',
        'magento2-theme' => 'app/design',
        'magento2-language' => 'app/i18n',
        'magento2-library' => 'lib/internal',
        'magento2-component' => '.'
    ];

    /**
     * Construct
     *
     * @param PackageInterface $package
     */
    public function __construct(
        PackageInterface $package
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
        return $this->getMapItem(0);
    }

    /**
     * Retrieve map to
     *
     * @return string
     */
    protected function getMapTo()
    {
        return $this->getMapItem(1);
    }

    /**
     * @param $index
     *
     * @return string
     */
    protected function getMapItem($index)
    {
        $map = $this->getMap();

        if (array_key_exists(0, $map) && array_key_exists($index, $map[0])) {
            return $map[0][$index];
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