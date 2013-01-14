<?php

namespace Respect\Validation\Rules;

class DigitsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidDigits
     */
    public function testValidDataWithDigitsShouldReturnTrue($validDigits, $aditional='')
    {
        $validator = new Digits($aditional);
        $this->assertTrue($validator->validate($validDigits));
    }

    /**
     * @dataProvider providerForInvalidDigits
     * @expectedException Respect\Validation\Exceptions\DigitsException
     */
    public function testInvalidDigitsShouldFailAndThrowDigitsException($invalidDigits, $aditional='')
    {
        $validator = new Digits($aditional);
        $this->assertFalse($validator->validate($invalidDigits));
        $this->assertFalse($validator->assert($invalidDigits));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Digits($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidDigits()
    {
        return array(
            array(165),
            array(1650),
            array('01650'),
            array('165'),
            array('1650'),
            array('16 50'),
            array("\n5\t"),
            array('16-50', '-'),
        );
    }

    public function providerForInvalidDigits()
    {
        return array(
            array(null),
            array('16-50'),
            array('a'),
            array(' '),
            array('Foo'),
            array(''),
            array("\n\t"),
            array('12.1'),
            array('-12'),
            array(-12),
        );
    }

}
