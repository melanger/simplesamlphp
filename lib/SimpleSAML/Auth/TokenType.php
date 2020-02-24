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
 * Class for representing an authentication token type (e.g. password, TOTP, webauthn)
 *
 * @author Pavel Brousek <brousek@ics.muni.cz>
 * @package SimpleSAMLphp
 */

abstract class TokenType
{
    /**
     * The name of this authentication token type.
     * @var string
     */
    public $name;

    /**
     * Description of this authentication token type.
     * @var string
     */
    public $description;

    /**
     * Allow this as the first (or only) factor.
     * @var boolean
     */
    public $allowFirstFactor;

    /**
     * Allow this as a second factor.
     * @var boolean
     */
    public $allowMultiFactor;

    /**
     * The user ID of the user who registered the token.
     * @var string
     */
    public $author;

    /**
     * The user ID of the owner of the token.
     * @var string
     */
    public $owner;

    public function __construct($params)
    {
        foreach ($params as $name => $value) {
            if (property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
    }

    /**
     * Authenticate the user using this method.
     * @return boolean true on success or false on failure
     */
    abstract public function authenticate($tokens);

    /**
     * Get all tokens of this type belonging to a user.
     * @return Token[]
     */
    abstract public function getTokens($userid);
}
