<?php

namespace CaptchaGenerator;


class CaptchaGenerator
{
    private $solution = "";
    private $canvas = "";
    private $difficulty = "";

    public function __construct($length = 8, $difficulty = 10)
    {
        try {
            if (is_numeric((int)$difficulty)){
                if ((int)$difficulty > 10 || (int)$difficulty < 1) {
                    throw new \InvalidArgumentException('Difficulty parameter must be between 0 and 10');
                }
                    $this->difficulty = (int)$difficulty;
            } else {
                throw new \InvalidArgumentException('Difficulty parameter must be integer!');
            }
        } catch (\InvalidArgumentException $f){
            exit($f->getMessage());
        }

        try {
            if (is_int($length)){
                $randomChar = $this->getRandomCharacters($length);
                $this->solution = $randomChar;
                $this->canvas = $this->getCanvas($randomChar);
            } else {
                throw new \InvalidArgumentException('Parameter Must Be An Integer or Null!');
            }
        } catch (\InvalidArgumentException $e) {
            exit($e->getMessage());
        }
    }

    public function saveCanvas()
    {
        ob_start();
        imagepng($this->canvas);
        $data = ob_get_clean();
        file_put_contents('/tmp/captcha.png', $data);
    }

    private function getRandomCharacters($length = 4)
    {
        if ($length > 8 || $length < 1){
            $length = 8;
        }

        $random = "";
        for ($i = 0; $length > $i; $i++){
            $random .= rand(0,9);
        }
        return $random;
    }

    private function getCanvas($randomChar)
    {
        $font = __DIR__ . '/HelveCursive.ttf';
        $fontSize = 25;
        $angle = rand(0, 10);
        $imageHeight = ImageFontHeight($fontSize);
        $imageWidth = ImageFontWidth($fontSize) * strlen($randomChar);
        $canvas = imagecreate($imageWidth*2, $imageHeight*2);
        $backColour = imagecolorallocate($canvas, 255,255,255);
        $fontColour = imagecolorallocate($canvas, 0,0,0);

        imagettftext($canvas, $fontSize, $angle, 0, $imageHeight*2, $fontColour,
            $font, $randomChar);

        return $this->obfuscateCanvas($canvas, $imageWidth, $imageHeight, $fontColour);
    }

    private function obfuscateCanvas($canvas, $imageHeight, $imageWidth, $fontColour)
    {
        $lines = $this->difficulty*2;
        for ($i = 0; $lines > $i; $i++){
            $x1 = rand(0,$imageWidth*6);
            $x2 = rand(0,$imageWidth*6);
            $y1 = rand(0,$imageHeight);
            $y2 = rand(0,$imageHeight);
            imageline($canvas,$x1, $y1, $x2, $y2, $fontColour);
        }
        return $canvas;
    }

    public function getSolution()
    {
        return $this->solution;
    }
}