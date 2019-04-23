<?php

class author {
    protected $authorId;
    protected $authorEmail;
    protected $authorUsername;


    public function _contruct($authorId, $authorEmail, $authorUsername){
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

public function