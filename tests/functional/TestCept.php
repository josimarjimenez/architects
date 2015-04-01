<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Ingreso al Sistema');
$I->amLoggedAs('Usuario' => 'danielPechan@gmail.com', 'password' => 'admin');
$I->amOnPage('/users/login');
$I->click('Ingresar');
$I->seeCurrentEquals('/users/dashboard');
$I->see('Unesco');
?>	