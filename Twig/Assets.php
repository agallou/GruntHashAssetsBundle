<?php

namespace Agallou\GruntHashAssetsBundle\Twig;

use Symfony\Component\Finder\Finder;

class Assets extends \Twig_Extension
{
  const HASH_PATTERN = '\.[0-9a-f]{16}';

    /**
     * @var string
     */
    protected $assetsDir;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @param string $assetsDir
     * @param string $basePath
     */
    public function __construct($assetsDir, $basePath)
    {
        $this->assetsDir = $assetsDir;
        $this->basePath = $basePath;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('grunt_asset', array($this, 'gruntAsset')),
        );
    }

    /**
     * @param string $filename
     *
     * @return string
     */
    public function gruntAsset($filename)
    {
        $pattern = vsprintf('/%s%s.%s/i', array(
            pathinfo($filename, PATHINFO_FILENAME),
            self::HASH_PATTERN,
            pathinfo($filename, PATHINFO_EXTENSION),
        ));

        $subdir = pathinfo($filename, PATHINFO_DIRNAME);

        return $this->getCompiledFile($pattern, $subdir);
    }

    /**
     * @param string $pattern
     * @param string $subDir
     *
     * @throws \Exception
     *
     * @return string
     */
    protected function getCompiledFile($pattern, $subDir)
    {
        $finder = new Finder();
        $files = $finder->files()->name($pattern)->in($this->assetsDir . '/' . $subDir);

        if (0 === count($files)) {
            throw new \Exception(sprintf("Asset file not found $pattern", $pattern));
        }

        if (count($files) > 1) {
            throw new \Exception(sprintf("There should not have more than one file in the assets dir $pattern", $pattern));
        }

        $compiledFile = null;
        foreach ($files as $file) {
            $compiledFile = $file->getBasename();
        }

        return sprintf('%s/%s/%s', $this->basePath, $subDir, $compiledFile);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'grunt_hash_assets_twig';
    }
}
