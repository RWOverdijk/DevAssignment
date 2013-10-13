<?php
namespace Application\Comparison;
use Iterator;

/**
 * A class to compare with regexp.
 */
class RegExpComparison implements ComparisonInterface
{
    /**
     * @param string $left Left side of the comparison expression. It is a regexp.
     * @param string $right Right side of the comparison expression
     * @return bool|mixed
     */
    public function process($left, $right)
    {
        if (preg_match($left, $right)) {
            return true;
        }
        else {
            return false;
        }
    }
}