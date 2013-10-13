<?php
namespace Application\Comparison;

/**
 * Common interface to all Comparison class.
 */
interface ComparisonInterface
{
    /**
     * @param mixed $left Left side of the comparison expression
     * @param mixed $right Right side of the comparison expression
     * @return mixed
     */
    public function process($left, $right);
}