<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Ingreso al Sistema');
$I->amOnPage('/users/login');
$I->amLoggedAs('Usuario'=>'danielPechan@gmail.com', );
?>