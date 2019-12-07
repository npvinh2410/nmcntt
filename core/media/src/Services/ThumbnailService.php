<?php

namespace Hydrogen\Media\Services;

use Exception;
use Intervention\Image\ImageManager;
use Log;

class ThumbnailService
{
    protected $imageManager;
    protected $imagePath;
    protected $thumbRate;
    protected $thumbWidth;
    protected $thumbHeight;
    protected $destPath;
    protected $xCoordinate;
    protected $yCoordinate;
    protected $fitPosition;
    protected $fileName;
    public function __construct()
    {
        if (extension_loaded('imagick')) {
            $this->imageManager = new ImageManager([
                'driver' => 'imagick'
            ]);
        } else {
            $this->imageManager = new ImageManager([
                'driver' => 'gd'
            ]);
        }

        $this->thumbRate = 0.75;
        $this->xCoordinate = null;
        $this->yCoordinate = null;
        $this->fitPosition = 'center';
    }

    public function setImage($imagePath)
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getImage()
    {
        return $this->imagePath;
    }

    public function setRate($rate)
    {
        $this->thumbRate = $rate;

        return $this;
    }

    public function getRate()
    {
        return $this->thumbRate;
    }

    public function setSize($width, $height = null)
    {
        $this->thumbWidth = $width;
        $this->thumbHeight = $height;

        if (empty($height)) {
            $this->thumbHeight = ($this->thumbWidth * $this->thumbRate);
        }

        return $this;
    }

    public function getSize()
    {
        return [$this->thumbWidth, $this->thumbHeight];
    }

    public function setDestPath($destPath)
    {
        $this->destPath = $destPath;

        return $this;
    }

    public function getDestPath()
    {
        return $this->destPath;
    }

    public function setCoordinates($xCoord, $yCoord)
    {
        $this->xCoordinate = $xCoord;
        $this->yCoordinate = $yCoord;

        return $this;
    }

    public function getCoordinates()
    {
        return [$this->xCoordinate, $this->yCoordinate];
    }

    public function setFitPosition($position)
    {
        $this->fitPosition = $position;

        return $this;
    }

    public function getFitPosition()
    {
        return $this->fitPosition;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function save($type = 'fit', $quality = 80)
    {
        $fileName = pathinfo($this->imagePath, PATHINFO_BASENAME);

        if ($this->fileName) {
            $fileName = $this->fileName;
        }

        $destPath = sprintf('%s/%s', trim($this->destPath, '/'), $fileName);

        $thumbImage = $this->imageManager->make($this->imagePath);

        switch ($type) {
            case 'resize':
                $thumbImage->resize($this->thumbWidth, $this->thumbHeight);
                break;
            case 'crop':
                $thumbImage->crop($this->thumbWidth, $this->thumbHeight, $this->xCoordinate, $this->yCoordinate);
                break;
            case 'fit':
                $thumbImage->fit($this->thumbWidth, $this->thumbHeight, null, $this->fitPosition);
        }

        try {
            $thumbImage->save($destPath, $quality);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }

        return $destPath;
    }
}