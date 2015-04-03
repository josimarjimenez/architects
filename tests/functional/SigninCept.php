<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Ingresar al Sistema');
$I->amOnPage('/');
$I->click('login');
$I->fillField('Usuario', 'danielPechan@gmail.com');
$I->fillField('Clave', 'admin');
$I->click('Ingresar');
$I->see('Unesco', 'Ha iniciado sesión');
$I->see('Ha iniciado sesión');
?>