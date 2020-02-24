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
 * Class with methods common to all authentication methods.
 *
 * @author Pavel Brousek <brousek@ics.muni.cz>
 * @package SimpleSAMLphp
 */

public static class TokenManagement
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Revoke a token.
     * @param Token token
     * @return boolean True on success, false on failure.
     */
    public function revoke($token)
    {
        $db->write('DELETE FROM authentication_tokens WHERE id=:token_id', ['token_id' => $token->id]);
    }

    public function hasPermission($userId, $token)
    {
        return $token->owner === $userId;
    }

    public function temporaryRevoke($token, $notBefore = null, $notAfter = null)
    {
        // TODO
    }

    /**
     * Register a new token.
     * @return Token the registered token
     */
    abstract public function register();
}
