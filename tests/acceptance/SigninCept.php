<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Ingreso al Sistema');
$I->amOnPage('/users/login');
$I->fillField('Usuario','danielPechan@gmail.com');
$I->fillField('password','admin');
$I->click('Ingresar');
$I->see('Unesco');
?>