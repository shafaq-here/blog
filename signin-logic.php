<?php

require 'config/database.php' ;

//check if the user hit the sign in button

if(isset($_POST['submit'])) {
    //move forward and get the form data
} else {
    //this page is not supposed to be accessed anyway else, head back to signin page and die()
    header('location:'.ROOT_URL.'signin.php') ;
    die() ;
}