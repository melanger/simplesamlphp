<?php

declare(strict_types=1);

namespace SimpleSAML\Auth;

use SimpleSAML\Configuration;
use SimpleSAML\Error;
use SimpleSAML\Logger;
use SimpleSAML\Session;
use SimpleSAML\Utils;
use Webmozart\Assert\Assert;

/**
 * Class for representing an authentication token (e.g. a password, a specific hardware token etc.)
 *
 * @author Pavel Brousek <brousek@ics.muni.cz>
 * @package SimpleSAMLphp
 */

abstract class Token
{
    /**
     * The type of this token.
     * @var TokenType
     */
    private $type;

    /**
     * A nickname for distinguishing tokens of the same type.
     * @var string
     */
    private $nickname;

    /**
     * Authentication token data needed for authentication.
     * @var object
     */
    private $data;

    public function __construct($params)
    {
        foreach ($params as $name => $value) {
            if (property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
    }
}
