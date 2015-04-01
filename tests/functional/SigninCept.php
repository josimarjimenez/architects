<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Ingreso al Sistema');
$I->amOnPage('/users/login');
$I->fillField('Usuario', 'danielPechan@gmail.com');
$I->fillField('Clave', 'admin');
$I->click('Ingresar');
$I->seeCurrentUrlEquals('/'):
$I->see('Unesco');
?>