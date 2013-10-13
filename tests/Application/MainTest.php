<?php

namespace Application\Tests;

use Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    protected static $assignmentData;

    public static function setUpBeforeClass()
    {
        self::$assignmentData = $GLOBALS['ASSIGNMENT_DATA'];
    }

    public function testFindPeople()
    {
        $expectedPeople = array(
            array(
                'lastName' => 'Doe',
                'firstName' => 'Jane',
                'gender' => 'female',
            ),
            array(
                'lastName' => 'Doe',
                'firstName' => 'John',
                'gender' => 'male',
            ),
            array(
                'lastName' => 'Doe',
                'firstName' => 'Markus',
                'gender' => 'male',
            )
        );

        $assignmentData = self::$assignmentData;
        $application = new Application\Main($assignmentData);
        $people = $application->findPeople();
        $this->assertEquals($expectedPeople, $people);
    }

    public function testFindCarModels()
    {
        $expectedModels = array(
            '5 Series (F10)',
            '5 Series Gran Turismo',
            'X5',
            '205',
            '305'
        );

        $assignmentData = self::$assignmentData;
        $application = new Application\Main($assignmentData);
        $models = $application->findCarModels();
        $this->assertEquals($expectedModels, $models);
    }

    public function testFindPhoneNumbers()
    {
        $expectedPhoneNumbers = array(
            '555-5115',
            '555-2315',
            '555-2115'
        );

        $assignmentData = self::$assignmentData;
        $application = new Application\Main($assignmentData);
        $phoneNumbers = $application->findPhoneNumbers();
        $this->assertEquals($expectedPhoneNumbers, $phoneNumbers);
    }

    public function testFindNumbers()
    {
        $expectedNumbers = array(
            7277,
            9112,
            8988,
            4894,
            4846,
            7428,
            6196,
            4542,
            8794,
            8261,
            8320
        );

        $assignmentData = self::$assignmentData;
        $application = new Application\Main($assignmentData);
        $numbers = $application->findNumbers();
        $this->assertEquals($expectedNumbers, $numbers);
    }

}