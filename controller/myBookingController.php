<?php
$users = new users();
$users->id = $_SESSION['id'];
$getbookingById = $users->getbookingById();