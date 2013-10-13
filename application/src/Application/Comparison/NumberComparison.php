<?php
namespace Application\Comparison;
use Iterator;

/**
 * A class to compare numbers.
 */
class NumberComparison implements ComparisonInterface
{
    /***
     * greater than, or equal constant
     */
    const GTE = 'gte';

    /**
     * @var string operator Operator of comparison
     */
    protected $operator;

    /**
     * @param string $operator Operator of comparison
     */
    function __construct($operator) {
        $this->operator = $operator;
    }

    /**
     * @param mixed $left Left side of the comparison expression
     * @param mixed $right Right side of the comparison expression
     * @return bool|mixed
     * @throws \RuntimeException If the operator not supported
     */
    public function process($left, $right)
    {
        $operator = $this->operator;

        switch ($operator) {
            case 'gte':
                if ($left <= $right) {
                    return true;
                }
                break;
            default:
                throw new \RuntimeException(sprintf('The "%s" operator is not supported', $operator));
                break;
        }

        return false;
    }
}