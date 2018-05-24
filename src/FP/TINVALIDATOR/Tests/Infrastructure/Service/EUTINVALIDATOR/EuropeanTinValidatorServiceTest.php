<?php

namespace FP\TINVALIDATOR\Tests\Infrastructure\Service\EUTINVALIDATOR;

use FP\TINVALIDATOR\Infrastructure\Service\EUTINVALIDATOR\EuropeanTinValidatorService;

class EuropeanTinValidatorServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \FP\TINVALIDATOR\Infrastructure\Service\EUTINVALIDATOR\EuropeanTinValidatorService::createClient()
     * @covers \FP\TINVALIDATOR\Infrastructure\Service\EUTINVALIDATOR\EuropeanTinValidatorService::checkTin()
     */
    public function testCheckTin() {
        $result = EuropeanTinValidatorService::checkTin('99999999R', 'ES');
        $this->assertTrue($result['validSyntax']);

        $result = EuropeanTinValidatorService::checkTin('IDCES-99999999R', 'ES');
        $this->assertFalse($result['validStructure']);

        $result = EuropeanTinValidatorService::checkTin('99999999H', 'ES');
        $this->assertTrue($result['validStructure']);
        $this->assertFalse($result['validSyntax']);

        $result = EuropeanTinValidatorService::checkTin('DMLPRY77D15H501F', 'IT');
        $this->assertTrue($result['validStructure']);
        $this->assertTrue($result['validSyntax']);

        $result = EuropeanTinValidatorService::checkTin('02070803628', 'PL');
        $this->assertTrue($result['validStructure']);
        $this->assertTrue($result['validSyntax']);
    }

    /**
     * @covers \FP\TINVALIDATOR\Infrastructure\Service\EUTINVALIDATOR\EuropeanTinValidatorService::checkTin()
     * @covers \FP\TINVALIDATOR\Infrastructure\Service\EUTINVALIDATOR\EuropeanTinValidatorService::isValidTin()
     */
    public function testIsValidTin() {
        $result = EuropeanTinValidatorService::isValidTin('99999999R', 'ES');
        $this->assertTrue($result);

        $result = EuropeanTinValidatorService::isValidTin('IDCES-99999999R', 'ES');
        $this->assertFalse($result);

        $result = EuropeanTinValidatorService::isValidTin('99999999H', 'ES');
        $this->assertFalse($result);
    }
}
