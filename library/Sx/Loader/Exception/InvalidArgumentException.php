<?php
namespace Sx\Loader\Exception;

require_once __DIR__ . '/../Exception.php';

use Sx\Loader\Exception;

/**
 * @category   Is
 * @package    Sx\Loader
 * @subpackage Exception
 */
class InvalidArgumentException extends \InvalidArgumentException implements Exception
{
}
