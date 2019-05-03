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
/**insert function method
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/

public function insert(\PDO $pdo) : void {

    // making a query template
    $query = "INSERT INTO author(authorId, authorAvatarUrl, authorActivationToken, authorEmail,authorUsername) VALUES(:authorId, :authorAvatarUrl, :authorActivationToken, :authorEmail, :authorUsername)";
    $statement = $pdo->prepare($query);

    $parameters = ["authorId" => $this->authorId->getBytes()];
    $statement->execute($parameters);
}
    /** 	 * updates this author in mySQL
     *
     * @param \PDO $pdo PDO connection object
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     **/

    public function update (\PDO $pdo) : void {
        $query ="UPDATE author Set authorAvatarUrl = :authorAvatarUrl, authorActivationToken = :authorActivationToken, authorEmail = :authorEmail, authorUsername = :authorUsername where authorId = :authorId";
        $statement = $pdo -> prepare ($query);

        $parameters = ["tweetId" => $this->authorId->getBytes(),"authorAvatarUrl" => $this->authorAvatarUrl, "authorActivationToken" => $this->authorAvatarUrl, "authorEmail" => $this->authorEmail, "authorUsername" => $this->authorUsername];
        $statement->execute($parameters);

    }

    /**
     * deletes this Author from mySQL
     *
     * @param \PDO $pdo PDO connection object
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     **/
    public function delete (\PDO $pdo) : void {
        $query = "DELETE from author Where authorId = :authorId";
        $statement = $pdo->prepare ($query);
        //query is showing what function and where to delete
        //statement prepares a query
        $parameters = ["authorId" => $this -> authorId ->getBytes ()];
        $statement ->execute ($parameters);
    }
    /**
     * gets the Tweet by tweetId
     *
     * @param \PDO $pdo PDO connection object
     * @param Uuid| $authorId author id to search for
     * @return Author|null author found or null if not found
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError when a variable are not the correct data type
     **/
    public static function getAuthorByAuthorId (\PDO $pdo, $authorId) : ?Author {
        //sanitize the authorId before searching
        try {
            $authorId = self :: validateUuid ($authorId);
        } catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception){
            throw (new \PDOException ($exception->getMessage (), 0, $exception));
    }
//create a query template
        $query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorUsername FROM author Where authorId = :authorId";
        $statement = $pdo ->prepare($query);
        //created template and have to bind the place holder
        $parameters = ["authorId" => $authorId->getBytes ()];
        $statement -> execute ($parameters);
        //stated the parameters and executing
        try {
            $author = null;
            //if no tweet will be null
            $statement ->setFetchMode(\PDO::FETCH_ASSOC);
            $row = $statement->fetch();
            if($row !== false) {
                $author = new Author($row["authorId"], $row["authorAvatarUrl"], $row ["authorAvatarUrl"], $row ["authorEmail"], $row ["authorUsername"]);
            }
        } catch(\Exception $exception){
                throw(new \PDOException($exception->getMessage(), 0, $exception));
            }
        return($author);
    }
/**
 * gets the Author by content
 *
 * @param \PDO $pdo PDO connection object
 * @param string $tweetContent tweet content to search for
 * @return \SplFixedArray SplFixedArray of Tweets found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 */
public static function getAuthorByAuthorActivationToken (\PDO $pdo, string $authorActivationToken) : \SplFixedArray {
    // sanitize the description before searching
    $authorActivationToken = trim($authorActivationToken);
    $authorActivationToken = filter_var($authorActivationToken,FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    if(empty($authorActivationToken) === true){
        throw(new\PDOException("author activation if invalid"));
    }
    // escape any mySQL wild cards
    $authorActivationToken = str_replace("_","\\",str_replace("%","\\%", $authorActivationToken));
    // create query template
    $query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername From author WHERE authorActivationToken Like :authorActivationToken";
    $statement = $pdo->prepare($query);
    // bind the authorActivation Tweet content to the place holder in the template
    $authorActivationToken = "%$authorActivationToken";
    $statement->execute($parameters);
    // build an array of authorActivationToken
    $authorActivationToken = new\SplFixedArray($statement->rowCount());
    $statement->setFectchMode(\PDO::FETCH_ASSOC);
    while ((ROW = $statement->fetch()) !== false) {
        try {
            $authorActivationToken = new Author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
            $authorActivationToken[$authorActivationToken->key()] = $authorActivationToken;
            $authorActivationToken->next();
        } catch(\Exception $exception) {
            // if the row couldn't be converted, rethrow it
            throw(new \PDOException(($exception->getMessage(), 0, $exception));
}
    }
    return($authorActivationToken);

}


}//closing record
