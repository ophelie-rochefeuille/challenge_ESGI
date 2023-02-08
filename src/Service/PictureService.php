<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{
    private ParameterBagInterface $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * @throws Exception
     */
    public function add(UploadedFile $picture)
    {
        $file = md5(uniqid(rand(), true)) ;

        $picture_infos = getimagesize($picture);

        if($picture_infos === false) {
            throw new Exception('Format non pris en charge');
        }


        /*  $picture_source = match ($picture_infos['mime']) {
           'image/png' => imagecreatefrompng($picture),
           'image/jpeg' => imagecreatefromjpeg($picture),
           'image/webp' => imagecreatefromwebp($picture),
           default => throw new Exception('Format non pris en charge'),
       };*/


        $path = $this->params->get('image_directory');


        $picture->move(public_path().$path, $file);

        return $file;

    }
}