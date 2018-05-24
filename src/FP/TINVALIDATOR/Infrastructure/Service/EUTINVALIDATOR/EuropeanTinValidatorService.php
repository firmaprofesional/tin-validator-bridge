<?php

namespace FP\TINVALIDATOR\Infrastructure\Service\EUTINVALIDATOR;

use FP\TINVALIDATOR\Infrastructure\Exception\EuropeanServiceException;

class EuropeanTinValidatorService
{

    /**
     * @return \SoapClient
     * @throws EuropeanServiceException
     */
    private static function createClient()
    {
        $wsdl = 'https://ec.europa.eu/taxation_customs/tin/checkTinService.wsdl';

        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ],
            'http' => array(
                'user_agent' => 'PHPSoapClient'
            )
        ]);

        try {
            $client = new \SoapClient($wsdl, array(
                'soap_version' => SOAP_1_1,
                'stream_context' => $context,
                'cache_wsdl' => WSDL_CACHE_NONE
            ));
        } catch (\Exception $e) {
            throw new EuropeanServiceException();
        }

        return $client;
    }

    /**
     * @param string $document
     * @param string $country
     * @return array
     */
    public static function checkTin($document, $country)
    {

        $client = self::createClient();
        return json_decode(json_encode($client->checkTin(array(
            'countryCode' => $country,
            'tinNumber' => $document
        ))), true);
    }

    /**
     * @param string $document
     * @param string $country
     * @return bool
     */
    public static function isValidTin($document, $country)
    {

        $resultService = self::checkTin($document, $country);

        if (
            array_key_exists('validStructure', $resultService) && $resultService['validStructure']
            && array_key_exists('validSyntax', $resultService) && $resultService['validSyntax']
        ) {
            return true;
        }

        return false;
    }
}
