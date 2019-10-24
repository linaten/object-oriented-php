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
	/** @var String is the author hash * */
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
	/**
	 * accessor method for profile id
	 *
	 * @return Uuid value of profile id (or null if new Profile)
	 **/
	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}
	/**
	 * mutator method for author id
	 *
	 * @param  Uuid| string $newAuthorId value of new author id
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if the profile Id is not
	 **/
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
	/**
	 * accessor method for account activation token
	 *
	 * @return string value of the activation token
	 */
	Public function getAuthorActivationToken() {
		return ($this->authorActivationToken);
	}
	/**
	 * mutator method for author activation token
	 *
	 * @param string $newAuthorActivationToken
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 */
	public function setAuthorActivationToken($newAuthorActivationToken): void {
		$newAuthorActivationToken = trim($newAuthorActivationToken);
		if(empty ($newAuthorActivationToken) === true) {
			throw(new \InvalidArgumentException("empty or invalid"));
		}
		if(strlen($newAuthorActivationToken) !== 32) {
			throw(new \RangeException("authorActivationToken has too many characters"));
		}
		$this->authorActivationToken = $newAuthorActivationToken;
	}
	/**
	 * accessor method for author avatar url
	 *
	 * @return url value of the activation token
	 */
	public function getAuthorAvatarUrl() {
		return ($this->authorAvatarUrl);
	}
	/**
	 * mutator method for author avatar url
	 *
	 * @param url $newAuthorAvatarUrl
	 * @throws \InvalidArgumentException  if the avatar is not a url
	 * @throws \RangeException if the token is more than 255 characters
	 * @throws \TypeError if the activation token is not a url
	 */
	public function setAuthorAvatarUrl($newAuthorAvatarUrl): void {
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_VALIDATE_URL);
		if($newAuthorAvatarUrl === false) {
			throw(new \InvalidArgumentException("URL is empty or invalid"));
		}
		if(strlen($newAuthorAvatarUrl) > 255) {
			throw(new \RangeException("avatarUrl has too many characters"));
		}
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}
	/**
	 * accessor method for author email
	 *
	 * @return string value of author email
	 **/
	public function getAuthorEmail() {
		return ($this->authorEmail);
	}
	/**
	 * mutator method for email
	 *
	 * @param string $newAuthorEmail new value of email
	 * @throws \InvalidArgumentException if $newEmail is not a valid email or insecure
	 * @throws \RangeException if $newEmail is > 128 characters
	 * @throws \TypeError if $newEmail is not a string
	 **/
	public function setAuthorEmail($newAuthorEmail): void {
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("Invalid Email"));
		}
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("Email has too many characters"));
		}
		$this->authorEmail = $newAuthorEmail;
	}
	/**
	 * accessor method for authorHash
	 *
	 * @return string value of hash
	 */
	public function getAuthorHash() {
		return ($this->authorHash);
	}
	/**
	 * mutator method for author hash password
	 *
	 * @param string $newAuthorHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 97 characters
	 * @throws \TypeError if profile ha
	 * sh is not a string
	 */
	public function setAuthorHash($newAuthorHash): string {
		$newAuthorHash = trim($newAuthorHash);
		if(empty ($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("Hash is empty or invalid"));
		}
		if(strlen($newAuthorHash) !== 97) {
			throw(new \RangeException("authorHash has too many characters"));
		}
		$this->authorHash = $newAuthorHash;
	}
	/**
	 * accessor method for author username
	 *
	 * @return string value of author username
	 **/
	public function getAuthorUsername():string {
		return ($this->authorUsername);
	}
	/**
	 * mutator method for author username
	 *
	 * @param string $newAuthorUsername new value of author username
	 * @throws \InvalidArgumentException if $authorUsername is not a string or insecure
	 * @throws \RangeException if $newAuthorUsername is > 32 characters
	 * @throws \TypeError if $newAuthorUsername is not a string
	 **/
	public function setAuthorUsername(string $newAuthorUsername) : void {
		// verify the that authorUsername is secure
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorUsername) === true) {
			throw(new \InvalidArgumentException("author username is empty or insecure"));
		}
		// verify the at handle will fit in the database
		if(strlen($newAuthorUsername) > 32) {
			throw(new \RangeException("profile at handle is too large"));
		}
		// store the at userName
		$this->authorUsername = $newAuthorUsername;
	}

	/**
	 * inserts this Author into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {

		// create query template
		$query = "INSERT INTO author(authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername) VALUES(:AuthorId, :authorActivationToken, :authorAvatarUrl, :authorEmail, :authorHash, :AuthorUsername)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["authorId" => $this->authorId->getBytes(), "authorAvatarUrl" => $this->authorAvatarUrl, "authorEmail" => $this->authorEmail, "authorHash" => $this->authorHash, "authorUsername" => $this->authorUsername];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Author from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {

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
	public function update(\PDO $pdo): void {

		// create query template
		$query = "UPDATE author SET authorId = :authorId, authorAvatarUrl = :authorAvatarUrl, authorEmail = :authorEmail, authorHash = :authorHash, authorUsername = :authorUsername WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		$parameters = ["authorId" => $this->authorId->getBytes(), "authorAvatarUrl" => $this->authorAvatarUrl->getBytes(), "authorEmail" => $this->authorEmail, "authorUsername"];
		$statement->execute($parameters);
	}

	/**
	 * gets the Author by author id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $authorId profile id to search by
	 * @return \SplFixedArray SplFixedArray of Authors found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAuthorByAuthorId(\PDO $pdo, $authorId): \SplFixedArray {

		try {
			$authorId = self::validateUuid($authorId);
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
				$author = new Author($row["authorId"], $row[authorActivationtoken], $row["authorAvatarUrl"], $row["authorEmail"], $row[authorHash], $row["authorUsername"]);
				$authors[$authors->key()] = $author;
				$author->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(invalid), 0, $exception));
			}
		}
		return ($author);
	}

	/**
	 * gets all Authors
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Authors found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllAuthors(\PDO $pdo): \SPLFixedArray {
		// create query template
		$query = "SELECT authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername  FROM author";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of authors
		$author = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$author = new Author($row["authorId"], $row[authorActivationToken], $row["authorAvatarUrl"], $row["authorEmail"], $row[authorHash], $row["authorUsername"]);
				$authors[$authors->key()] = $author;
				$author->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($authors);
	}
}
