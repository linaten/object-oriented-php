<?php
namespace latencio23\objectOrientedPhp;
require_once("autoload.php");
require_once(dirname(__DIR__, 1) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/**
 *Creating an author profile
 */
class Author {
	use ValidateUuid;
	/**
	 * This is the author Id.
	 * This is the primary key
	 * @var Uuid $authorId
	 **/
	private $authorId;
	/**This is the author activation token.
	 * @var $authorActivationToken
	 **/
	private $authorActivationToken;
	/**This is the author avatar **/
	private $authorAvatarUrl;
	/** This is the author email **/
	private $authorEmail;
	/** @var String is the author hash **/
	private $authorHash;
	/**This is the author user name **/
	private $authorUsername;

	public function __construct($newAuthorId, $newAuthorActivationToken, $newAuthorAvatarUrl, $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

	}

	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}


	public function setAuthorId($newAuthorId): void {
		try {
			$uuid = self::validateUuid($newAuthorId);
			//determine what exception type was thrown
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	$this->authorId = $uuid;
		}

public function getAuthorEmail(): void {
	return($this->authorEmail);
}
public function setAuthorEmail($newAuthorEmail): void {
	$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
	if (empty($newAuthorEmail) === true) {
		throw(new \InvalidArgumentException("Invalid Email"));}
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("Email has too many characters"));
		}
	$this->authorEmail = $newAuthorEmail;
	}
	public function getAuthorAvatarUrl(): void {
		return($this->authorAvatarUrl);
	}
	public function setAuthorAvatarUrl($newAuthorAvatarUrl): void {
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_VALIDATE_URL);
		if(empty($newAuthorAvatarUrl) === false){
			throw(new \InvalidArgumentException("URL is empty or invalid"));
		}
			if(strlen($newAuthorAvatarUrl)>255) {
				throw(new \RangeException("avatarUrl has too many characters"));
			}
			$this->authorAvatarUrl = $newAuthorAvatarUrl;
		}
	public function getAuthorHash(): void {
		return($this->authorHash);
	}

	public function setAuthorHash($newAuthorHash): void {


		//determine what exception type was thrown
	if(strlen($newAuthorHash)>97) {
		throw(new \RangeException("authorHash has too many characters"));
	}
	$this->authorHash = $uuid;
	}

public function getAuthorUsername(): Uuid {
	return ($this->authorUsername);
}
public function setAuthorUsername($newAuthorUsername): void {
	try {
		$uuid = self::validateUuid($newAuthorUsername);
	} //determine what exception type was thrown
	catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	if(strlen($newAuthorUsername) > 32) {
		throw(new \RangeException("authorUsername has too many characters"));
	}
	$this->authorUsername = $uuid;
}
}
