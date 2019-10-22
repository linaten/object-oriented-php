<?php
namespace latencio23\objectOrientedPhp;
require_once("autoload.php");
require_once(dirname(__DIR__, 1) . "/lib/vendor/autoload.php");
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
	private $exception;
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
	Public function getAuthorActivationToken() {
		return($this->authorActivationToken);
	}
	public function setAuthorActivationToken($newAuthorActivationToken): void {
		$newAuthorActivationToken=trim($newAuthorActivationToken);
		if (empty ($newAuthorActivationToken) === true){
			throw(new \InvalidArgumentException("empty or invalid"));
		}
		if(strlen($newAuthorActivationToken)!==32) {
			throw(new \RangeException("authorActivationToken has too many characters"));
		}
		$this->authorActivationToken = $newAuthorActivationToken;
	}

	public function getAuthorAvatarUrl() {
		return($this->authorAvatarUrl);
	}
	public function setAuthorAvatarUrl($newAuthorAvatarUrl): void {
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_VALIDATE_URL);
		if ($newAuthorAvatarUrl === false){
			throw(new \InvalidArgumentException("URL is empty or invalid"));
		}
		if(strlen($newAuthorAvatarUrl)>255) {
			throw(new \RangeException("avatarUrl has too many characters"));
		}
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}
	public function getAuthorEmail(){
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
	public function getAuthorHash() {
		return($this->authorHash);
	}
	public function setAuthorHash($newAuthorHash): void {
		$newAuthorHash=trim($newAuthorHash);
		if (empty ($newAuthorHash) === true){
			throw(new \InvalidArgumentException("Hash is empty or invalid"));
		}
		if(strlen($newAuthorHash)!==97) {
			throw(new \RangeException("authorHash has too many characters"));
		}
		$this->authorHash = $newAuthorHash;
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

/**
 * inserts this Author into mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function insert(\PDO $pdo) : void {

	// create query template
	$query = "INSERT INTO author(authorId,authorAvatarUrl, authorEmail, authorUsername) VALUES(:AuthorId, :authorAvatarUrl, :authorEmail, :AuthorUsername)";
	$statement = $pdo->prepare($query);

	// bind the member variables to the place holders in the template
	$parameters = ["authorId" => $this->authorId->getBytes(), "authorAvatarUrl" => $this->authorAvatarUrl->getBytes(), "authorEmail" => $this->authorEmail, "authorUsername"->getBytes() ;
	$statement->execute($parameters);
}
/**
 * deletes this Author from mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function delete(\PDO $pdo) : void {

	// create query template
	$query = "DELETE FROM author WHERE authorId = :authorId";
	$statement = $pdo->prepare($query);

	// bind the member variables to the place holder in the template
	$parameters = ["authorId" => $this->authorId->getBytes()];
	$statement->execute($parameters);
}

/**
 * updates this Author in mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function update(\PDO $pdo) : void {

	// create query template
	$query = "UPDATE author SET authorId = :authorId, authorAvatarUrl = :authorAvatarUrl, authorEmail = :authorEmail authorUsername = :authorUsername WHERE authorId = :authorId";
	$statement = $pdo->prepare($query);

	$parameters = ["authorId" => $this->authorId->getBytes(), "authorAvatarUrl" => $this->authorAvatarUrl->getBytes(), "authorEmail" => $this->authorEmail, "authorUsername"->getBytes() ;
	$statement->execute($parameters);
}
/**
 * gets the Tweet by profile id
 *
 * @param \PDO $pdo PDO connection object
 * @param Uuid|string $tweetProfileId profile id to search by
 * @return \SplFixedArray SplFixedArray of Tweets found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 **/
public static function getTweetByTweetProfileId(\PDO $pdo, $tweetProfileId) : \SplFixedArray {

	try {
		$tweetProfileId = self::validateUuid($tweetProfileId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}

	// create query template
	$query = "SELECT authorId, authorAvatarUrl, authorEmail, authorUsername From: authorId WHERE authorId = :authorId";
	$statement = $pdo->prepare($query);
	// bind the author profile id to the place holder in the template
	$parameters = ["authorId" => $authorId->getBytes()];
	$statement->execute($parameters);
	// build an array of author
	$author = new \SplFixedArray($statement->rowCount());
	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	while(($row = $statement->fetch()) !== false) {
		try {
			$author = new Author($row["authorId"], $row["authorAvatarUrl"], $row["authorEmail"], $row["authorUsername"]);
			$authors[$authors->key()] = $author;
			$author->next();
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(invalid), 0, $exception));
		}
	}
	return($author);
}
/**
 * gets all Authors
 *
 * @param \PDO $pdo PDO connection object
 * @return \SplFixedArray SplFixedArray of Authors found or null if not found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 **/
public static function getAllAuthors(\PDO $pdo) : \SPLFixedArray {
	// create query template
	$query = "SELECT authorId, authorAvatarUrl, authorEmail, authorUsername FROM author";
	$statement = $pdo->prepare($query);
	$statement->execute();

	// build an array of authors
	$author = new \SplFixedArray($statement->rowCount());
	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	while(($row = $statement->fetch()) !== false) {
		try {
			$author = new Author($row["authorId"], $row["authorAvatarUrl"], $row["authorEmail"], $row["authorUsername"]);
			$authors[$authors->key()] = $author;
			$author->next();
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
	}
	return ($authors);
}