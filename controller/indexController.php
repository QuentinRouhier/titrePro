<?php

    $users = new users();
   if(!empty($_POST['email']) && !empty($_POST['password'])){
       $users->email = strip_tags($_POST['email']);
       $password = strip_tags($_POST['password']);
       $users->getHashByUser();
       $isOk = password_verify($password, $users->password);
       if ($isOk) {
           $_SESSION['email'] = $users->email;
           $users->getUsers();
           $_SESSION['id'] = $users->id;
           $_SESSION['lastName'] = $users->lastName;
           $_SESSION['lastName'] = $users->lastName;
           $_SESSION['firstName'] = $users->firstName;
           $_SESSION['firstPhoneNumber'] = $users->firstPhoneNumber;
           $_SESSION['secondPhoneNumber'] = $users->secondPhoneNumber;
           $_SESSION['postalCode'] = $users->postalCode;
           $_SESSION['birthDate'] = $users->birthDate;
           $_SESSION['address'] = $users->address;
           $_SESSION['city'] = $users->city;
           $_SESSION['society'] = $users->society;
           $_SESSION['id_taxi_group'] = $users->id_taxi_group;
       }
   }
   if(isset($_POST['logOut'])){
       session_unset();
       session_destroy();
   }
