<?php

namespace jsilva85/Object-Oriented-Phase1;

require_once(dirname(Object-Oriented-Phase1, 2) . "/vendor/autoload.php");

use author\Uuid\Uuid;
/**
 * Cross Section of a Twitter Profile
 *
 * This is a cross section of what is probably stored about a Twitter user. This entity is a top level entity that
 * holds the keys to the other entities in this example (i.e., Favorite and Profile).
 *
 * @author Jesus Silva <thebestjesse76@gmail.com>
 * @version 5.0.0
 **/
class author  {
    use ValidateUuid;
    /**
     * id for this Profile; this is the primary key
     * @var Uuid $profileId
     **/
    private $authorId;
    /**
     * at handle for this Profile; this is a unique index
     * @var string $profileAtHandle
     **/
    private $authorAvatarUrl;
    /**
     * token handed out to verify that the profile is valid and not malicious.
     *v@var $profileActivationToken
     **/
    private $authorActivationToken;
    /**
     * email for this Profile; this is a unique index
     * @var string $profileEmail
     **/
    private $authorEmail;
    /**
     * hash for profile Email
     * @var $thebestjose@gmail.com
     **/
    private $authorHash;
    /**
     * Hash for this Profile
     * @var string $#Hash
     **/
    private $authorUsername;


    /**
     * accessor method for profile id
     *
     * @return Uuid value of profile id (or null if new Profile)
     **/
    public function getauthorId(): Uuid {
        return ($this->authorId);
    }
    /**
     * mutator method for profile id
     *
     * @param  Uuid| string $newProfileId value of new profile id
     * @throws \RangeException if $newProfileId is not positive
     * @throws \TypeError if the profile Id is not
     **/
    public function setauthorId($newauthorId): void {
        try {
            $uuid = self::validateUuid($newauthorId);
        } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
        // convert and store the profile id
        $this->authorId = $uuid;
    }
    /**
     * accessor method for account activation token
     *
     * @return string value of the activation token
     */
    public function getauthorActivationToken() : ?string {
        return ($this->authorActivationToken);
    }
    /**
     * mutator method for account activation token
     *
     * @param string $newauthorActivationToken
     * @throws \InvalidArgumentException  if the token is not a string or insecure
     * @throws \RangeException if the token is not exactly 32 characters
     * @throws \TypeError if the activation token is not a string
     */
    public function setauthorActivationToken(?string $authorActivationToken): void {
        if($newauthorActivationToken === null) {
            $this->authorActivationToken = null;
            return;
        }
        $newauthorActivationToken = strtolower(trim($newauthorActivationToken));
        if(ctype_xdigit($newauthorActivationToken) === false) {
            throw(new\RangeException("user activation is not valid"));
        }
        //make sure user activation token is only 32 characters
        if(strlen($newauthorActivationToken) !== 32) {
            throw(new\RangeException("user activation token has to be 32"));
        }
        $this->authorActivationToken = $newauthorActivationToken;
    }
    /**
     * accessor method for at handle
     *
     * @return string value of at handle
     **/
    public function getauthorAvatarUrl(): string {
        return ($this->authorAvatarUrl);
    }
    /**
     * mutator method for at handle
     *
     * @param string $newauthorAtHandle new value of at handle
     * @throws \InvalidArgumentException if $newAtHandle is not a string or insecure
     * @throws \RangeException if $newAtHandle is > 32 characters
     * @throws \TypeError if $newAtHandle is not a string
     **/
    public function setauthroHash(string $newauthorAvatarUrl) : void {
        // verify the at handle is secure
        $newauthorAvatarUrl = trim($newauthorAvatarUrl);
        $newauthorAvatarUrl = filter_var($newauthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if(empty($newauthorAvatarUrl) === true) {
            throw(new \InvalidArgumentException("profile at handle is empty or insecure"));
        }
        // verify the at handle will fit in the database
        if(strlen($newauthorAvatarUrl) > 32) {
            throw(new \RangeException("profile at handle is too large"));
        }
        // store the at handle
        $this->authorAvatarUrl = $newauthorAvatarUrl;
    }
    /**
     * accessor method for email
     *
     * @return string value of email
     **/
    public function getauthorEmail(): string {
        return $this->authorEmail;
    }
    /**
     * mutator method for email
     *
     * @param string $newauthorEmail new value of email
     * @throws \InvalidArgumentException if $newEmail is not a valid email or insecure
     * @throws \RangeException if $newEmail is > 128 characters
     * @throws \TypeError if $newEmail is not a string
     **/
    public function setauthorEmail(string $newauthorEmail): void {
        // verify the email is secure
        $newauthorEmail = trim($newauthorEmail);
        $newauthorEmail = filter_var($newProfileEmail, FILTER_VALIDATE_EMAIL);
        if(empty($newauthorEmail) === true) {
            throw(new \InvalidArgumentException("profile email is empty or insecure"));
        }
        // verify the email will fit in the database
        if(strlen($newauthorEmail) > 128) {
            throw(new \RangeException("profile email is too large"));
        }
        // store the email
        $this->authorEmail = $newauthorEmail;
    }
    /**
     * accessor method for profileHash
     *
     * @return string value of hash
     */
    public function getauthorHash(): string {
        return $this->authorHash;
    }

    /**
     * mutator method for profile hash password
     *
     * @param string $newProfileHash
     * @throws \InvalidArgumentException if the hash is not secure
     * @throws \RangeException if the hash is not 128 characters
     * @throws \TypeError if profile hash is not a string
     */
    public function setauthorHash(string $newauthorHash): void {
        //enforce that the hash is properly formatted
        $newauthorHash = trim($newauthorHash);
        if(empty($newProfileHash) === true) {
            throw(new \InvalidArgumentException("profile password hash empty or insecure"));
        }
        //enforce the hash is really an Argon hash
        $authorHashInfo = password_get_info($newauthorHash);
        if($profileHashInfo["algoName"] !== "argon2i") {
            throw(new \InvalidArgumentException("profile hash is not a valid hash"));
        }
        //enforce that the hash is exactly 97 characters.
        if(strlen($newauthorHash) !== 97) {
            throw(new \RangeException("profile hash must be 97 characters"));
        }
        //store the hash
        $this->authorHash = $newauthorHash;
    }
    /**
     * accessor method for phone
     *
     * @return string value of phone or null
     **/
    public function getUsernamePhone(): ?string {
        return ($this->authorUsername);
    }
    /**
     * mutator method for Username
     *
     * @param string $newProfilePhone new value of phone
     * @throws \InvalidArgumentException if $newPhone is not a string or insecure
     * @throws \RangeException if $newPhone is > 32 characters
     * @throws \TypeError if $newPhone is not a string
     **/
    public function setauthorUsername(?string $newauthorUsername): void {
        //if $profilePhone is null return it right away
        if($newauthorUsername === null) {
            $this->authorUsername = null;
            return;
        }
        // verify the phone is secure
        $newauthorUsername = trim($newauthorUsername);
        $newauthorUsername = filter_var($newauthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if(empty($newauthorUsername) === true) {
            throw(new \InvalidArgumentException("profile phone is empty or insecure"));
        }
        // verify the phone will fit in the database
        if(strlen($newauthorUsername) > 128) {
            throw(new \RangeException("author Username is too large"));
        }
        // store the phone
        $this->authorUsername = $newauthorUsername;
    }
}