<?php
/**
 *this namespace stuff is really crazy
 */
namespace jsilva85\ObjectOrientedPhase1;
require_once(dirname(__DIR__) . "/vendor/autoload.php");
require_once(dirname(__DIR__) . "/Classes/autoload.php");
use Ramsey\Uuid\Uuid;
/**
 *class has to be created to be identified
 */
class Author {
    /**
     *make sure uuid has been identified to relate to the class
     */
    use ValidateUuid;
    private $authorId;
    /**
     * must be private so outside access will not be available authorAvatarUrl, authorActivationToken, authorEmail, AuthorHash, authorUsername all in the same fashion. create them within a private class for distribution per our discretion later on.
     */
    private $authorAvatarUrl;
    private $authorActivationToken;
    private $authorEmail;
    private $authorHash;
    private $authorUsername;
    /**
     *ths is the accessor method
     *
     *
     */
    public function __construct($newAuthorId, string $newAuthorAvatarUrl, string $newAuthorActivationToken,
                                string $newAuthorEmail, string $newAuthorHash, string $newAuthorUsername )
    {
        try {
            $this->setAuthorId($newAuthorId);
            $this->setAuthorAvatarUrl($newAuthorAvatarUrl);
            $this->setAuthorActivationToken($newAuthorActivationToken);
            $this->setAuthorEmail($newAuthorEmail);
            $this->setAuthorHash($newAuthorHash);
            $this->setAuthorUsername($newAuthorUsername);
        } //determine what exception type was thrown
        catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
    }

        public function getAuthorId(): Uuid{
            return ($this->authorId);
        }


    /**
     * mutator method for authorId
     *
     * @param Uuid| string $newAuthorId
     * @throws \RangeException if $newAuthorId value of new authorId
     * @throws \TypeError if the authorId is not positive
     * @thros \TypeError if the authorId is not
     */
    public function setAuthorId($newAuthorId): void {
        try {
            $uuid = self::validateUuid($newAuthorId);
        } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
        // convert and store authorId
        $this->authorId = $uuid;
    }
    /**
     * accessor method for authorAvatarUrl
     *
     * @return string value of authorAvatarUrl
     */
    public function getAuthorAvatarUrl(): string {
        return ($this->authorAvatarUrl);
    }
    /**
     * mutator method for authorAvatarUrl
     *
     * @param string $newAuthorAvatarUrl
     * @throws \InvalidArgumentException if $newAuthorAvatarUrl is not a string or insecure
     * @throws \RangeException if the Url is not < 255 characters
     * @throws \TypeError if the Url is not a string
     */
    public function setAuthorAvatarUrl($newAuthorAvatarUrl) : void {
        $newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
        $newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_VALIDATE_URL);
        if(empty($newAuthorAvatarUrl) === true) {
            throw(new \RangeException("Author Avatar URL is is empty or insecure"));
        }
        if(strlen($newAuthorAvatarUrl)>255) {
            throw(new \RangeException("Author Avatar URL is too large"));
        }
        $this->authorAvatarUrl = $newAuthorAvatarUrl;
    }

    /* accessor method for authorActivationToken
     *
     * @return string value of authorActivationToken
     */


    public function getAuthorActivationToken(): string {
        return ($this->authorActivationToken);
    }
    /**
     * mutator method for author activation token
     *
     * @param string $newauthorActivationToken
     * @throws \InvalidArgumentException if the url is not a string or insecure
     * @throws \ TypeError if the url is not a string
     */
    public function setAuthorActivationToken (string $newAuthorActivationToken): void {
        if($newAuthorActivationToken === null) {
            $this->authorActivationToken = null;
            return;
        }
        $newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
        if(ctype_xdigit($newAuthorActivationToken) === false) {
            throw(new\RangeException("user activation is not valid"));
        }
        $this->authorActivationToken = $newAuthorActivationToken;
    }
    /**
     * accessor method for authorEmail
     * @return string value of authorEmail
     */
    public function getAuthorEmail():?string {
        return $this->authorEmail;
    }
    /**
     *mutator method for authorEmail
     *
     *@param string $newAuthorEmail new email
     *@throws \ InvalidArgumentException if $newEmail is not valid email or insecure
     *@throws \RangeException if $newEmail is >128 characters
     *@throws \TypeError if $newEmail is not a string
     */
    public function setAuthorEmail( string $newAuthorEmail): void{
        $newAuthorEmail = trim($newAuthorEmail);
        $newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
        if(empty($newAuthorEmail) === true) {
            throw(new \InvalidArgumentException("authorEmail is empty or insecure"));
        }
        if(strlen($newAuthorEmail) >128) {
            throw(new \RangeException("Author Email is too large"));
        }
        $this->authorEmail = $newAuthorEmail;
    }
    /**
     *accessor method for author hash
     *
     * @return string value authorHash
     */
    public function getAuthorHash():?string {
        return $this->authorHash;
    }
    /**
     * Mutator method for author hash
     * @param string $newAuthorHash
     * @throws \InvalidArgumentException if the hash is not secure
     * @throws \RangeException if the hash is >97 characters
     */

    public function setAuthorHash(string $newAuthorHash): void {
        //enforce hash formatting
        $newAuthorHash = trim($newAuthorHash);
        if(empty($newAuthorHash) === true) {
            throw(new \InvalidArgumentException("Author hash is not a valid hash"));
        }
        //enforce that it is an argon hash
        $authorHashInfo = password_get_info($newAuthorHash);
        if($authorHashInfo["algoName"] !== "argon2i") {
            throw(new \InvalidArgumentException("author hash is not a valid hash"));
        }
        if(strlen($newAuthorHash) !== 97) {
            throw(new \RangeException("author hash must be 128 characters"));
        }
        $this->authorHash = $newAuthorHash;
    }
    /**
     * accessor method for AuthorUsername
     *
     */
    public function getAuthorUsername():?string {
        return $this->authorUsername;
    }
    public function setAuthorUsername(string $newAuthorUsername) : void {
        $newAuthorUsername = trim($newAuthorUsername);
        if(empty($newAuthorUsername) === true) {
            throw(new \InvalidArgumentException("author username is not a valid username"));
        }
        if(strlen($newAuthorUsername)>32){
            throw(new \RangeException("Author Username must be less than 32 characters"));
        }
        $this->authorUsername = $newAuthorUsername;
    }
}