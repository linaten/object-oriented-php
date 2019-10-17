<?php
namespace latencio23\Author;
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
use ValidateUuid;
class Author{
private $authorId;
private $authorActivationToken;
primary key
	public function getAuthorId(): Uuid {
		return ($this->authorId);
		public function setProfileId( $newProfileId): void {
			try {
				$uuid = self::validateUuid($newProfileId);
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
			$this->authorId = $uuid;
			public function getAuthorActivationToken() : ?string {
				return ($this->authorActivationToken);
				public function setAuthorActivationToken(?string $newAuthorActivationToken): void {
					if($newAuthorActivationToken === null) {
						$this->profileActivationToken = null;
						return;
}
?>