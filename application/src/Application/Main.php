<?php

namespace Application;

use Application\Comparison\NumberComparison;
use Application\Comparison\RegExpComparison;
use Application\Filter\AssociativeArrayFilter;
use Application\Filter\ComparisonFilter;
use ArrayObject;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class Main
{

    /**
     * @var array
     */
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data);
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Print people
     */
    public function showPeople()
    {
        $people = $this->findPeople();
        $this->renderData('List of all people with a last name of "Doe"', $people);
    }

    /**
     * Print car models
     */
    public function showCars()
    {
        $cars = $this->findCarModels();
        $this->renderData('List of all car models containing a "5"', $cars);
    }

    /**
     * Print phone numbers
     */
    public function showPhoneNumbers()
    {
        $phoneNumbers = $this->findPhoneNumbers();
        $this->renderData('List of all phone numbers ending with "15"', $phoneNumbers);
    }

    /**
     * Print numbers
     */
    public function showNumbers()
    {
        $numbers = $this->findNumbers();
        $this->renderData('List of all numbers containing greater than, or equal to "4000"', $numbers);
    }

    /**
     * Return all people with a last name of "Doe".
     *
     * @return array People
     */
    public function findPeople()
    {
        $people = new ArrayObject($this->data['people']);
        $comparison = new RegExpComparison();
        $filteredPeople = new AssociativeArrayFilter($people->getIterator(), 'lastName', $comparison, '/^Doe/');

        return array_values(iterator_to_array($filteredPeople));
    }

    /**
     * Return all car models containing a "5"
     *
     * @return array Car models
     */
    public function findCarModels()
    {
        $models = new RecursiveIteratorIterator(new RecursiveArrayIterator($this->data['cars']));
        $comparison = new RegExpComparison();
        $filteredModels = new ComparisonFilter($models, $comparison, '/^.*5.*/');

        return array_values(iterator_to_array($filteredModels));
    }

    /**
     * Return all phone numbers ending with "15"
     *
     * @return array Phone numbers
     */
    public function findPhoneNumbers()
    {
        $phoneNumbers = new ArrayObject($this->data['phoneNumbers']);
        $comparison = new RegExpComparison();
        $filteredPhoneNumbers = new ComparisonFilter($phoneNumbers->getIterator(), $comparison, '/15$/');

        return array_values(iterator_to_array($filteredPhoneNumbers));
    }

    /**
     * Return all numbers containing greater than, or equal to "4000"
     *
     * @return array Numbers
     */
    public function findNumbers()
    {
        $numbers = new ArrayObject($this->data['numbers']);
        $comparison = new NumberComparison(NumberComparison::GTE);
        $filteredNumbers = new ComparisonFilter($numbers->getIterator(), $comparison, 4000);

        return array_values(iterator_to_array($filteredNumbers));
    }

    /**
     * This function prints data in a human-readable format
     *
     * @param string $title Title of rendered data
     * @param mixed $data Rendered data
     */
    public function renderData($title, array $data)
    {
        printf('<h1>%s</h1>', $title);

        print('<ul>');

        foreach ($data as $item) {
            $item = is_array($item) ? print_r($item, true) : $item;
            printf('<li>%s</li>', $item);
        }

        print('</ul>');
    }
}