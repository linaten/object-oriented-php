<?php
require_once("../Classes/Author.php");
use latencio23\objectOrientedPhp\Author;

$jim=new Author("c1acea3f-2d84-458d-ad16-c70707df181d",
"0341a214d6b340c99eefc4d6cc0166af", "https://images.pexels.com/photos/617278/pexels-photo-617278.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500", "lba@cnm.edu", "a64aa4593c14435cb8b6cc59aeed2535a64aa4593c14435cb8b6cc59aeed2535a64aa4593c14435cb8b6cc59aeed25352", "Lindsey" );
echo($jim->getAuthorId());
echo($jim->getAuthorAvatarUrl());
echo($jim->getAuthorActivationToken());
echo($jim->getAuthorEmail());
echo($jim->getAuthorHash());
echo($jim->getAuthorUsername());
