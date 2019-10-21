<?php
require_once("../Classes/Author.php");
use latencio23\objectOrientedPhp\Author;
$jim=new Author("c1acea3f-2d84-458d-ad16-c70707df181d",
"");
echo($jim->getAuthorId());
