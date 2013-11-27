<?php
    namespace CaptchaGeneratorTest;
    use CaptchaGenerator\CaptchaGenerator;

    require_once __DIR__ . '/../../CaptchaGenerator/CaptchaGenerator.php';

    class CaptchaGeneratorTest extends \PHPUnit_Framework_TestCase
    {
        private function getCap()
        {
            return new CaptchaGenerator();
        }

        //testing encapsulated functions
        private function invokeMethod($methodName, array $parameters = array())
        {
            $object = $this->getCap();
            $reflection = new \ReflectionClass(get_class($object));
            $method = $reflection->getMethod($methodName);
            $method->setAccessible(true);

            return $method->invokeArgs($object, $parameters);
        }

        public function testCaptchaGeneratorReturnsFourRandomCharacters()
        {
            $random = $this->invokeMethod('getRandomCharacters');
            $result = strlen($random);

            $this->assertEquals(4,$result);
        }

        public function testCaptchaGeneratorReturnsEightRandomCharacters($in = 8)
        {
            $random = $this->invokeMethod('getRandomCharacters', array($in));
            $result = strlen($random);

            $this->assertEquals(8,$result, $random);
        }


    }