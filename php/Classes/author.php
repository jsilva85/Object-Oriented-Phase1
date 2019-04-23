<?php
/**author Jesus Silva <thebestjesse76@gmail.com>**/

class author {
    protected $authorId;
    protected $authorEmail;
    protected $authorUsername;
/** this has three variables classes */

    private function _contruct($authorId, $authorEmail, $authorUsername){
        try {
            $this ->authorEmail($authorEmail);
            $this ->authorId($authorId);
            $this ->authorUsername($authorUsername);
        } catch (InvalidArgumentExceptionn $invalidArgument){
            throw (new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
        }catch ($LengthException $length){
            throw (new $LengthException ($length->getMessage (), 0, $length));
        }catch(UnexpectedValueException $unexpectedValue){
            throw(new UnexpectedValueException($unexpectedValue->getMessage(), 0, $unexpectedValue));
        }catch (Exception $exception){
            throw (new Exception($exception->getMessage(), 0, $exception));
        }
}
/** accessor method for authorEmail, authorId, authorUsername
 @return string value of authorEmail, authorId, authorUsername.*/

    public function getauthorEmail () {
        return ($this->authorEmail);
    }
}
    public function getauthorId () {
    return ($this->authorId);
}
    public function getauthorUsername () {
    return ($this->authorUsername);
    }
}
/** mutator method for authorEmail, authorId, authorUsername

 */
public function setauthorEmail ($newauthorEmail){
    $newauthorEmail = trim($newauthorEmail);
    $newauthorEmail = filter_var($newauthorEmail,filter_sanitize_string);
    if(empty($newauthorEmail) === true){
        throw(new InvalidArgumentException("thebestjose@gmail.com"));
    }
    $this->authorId = $newauthorId;
    public function setauthorId ($newauthorId){
        $newauthorId = trim($newauthorId);
        $newauthorId = filter_var($newauthorId,filter_sanitize_string);
        if(empty($newauthorId) === true){
            throw(new InvalidArgumentException("d0365e00-c6e2-4eb7-a79d-4ac68e847860"));
        }
        $this->authorUsername = $newauthorUsername;
        public function setauthorUsername ($newauthorUsername){
            $newauthorUsername = trim($newauthorUsername);
            $newauthorUsername = filter_var($newauthorUsername,filter_sanitize_string);
            if(empty($newauthorUsername) === true){
                throw(new InvalidArgumentException("alottafunjose"));
            }
            $this->authorUsername = $newauthorUsername;

}

