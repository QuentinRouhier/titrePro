<?php

$comments = new comments();
$comments->id = intval($_SESSION['id']);
$getComment = $comments->getComment();
