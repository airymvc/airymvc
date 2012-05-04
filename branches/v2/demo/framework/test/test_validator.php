<?php

require_once '../app/coreLib/ui/form/validation/ValidatorInterface.php';
require_once '../app/coreLib/ui/form/validation/AbstractValidator.php';
require_once '../app/coreLib/ui/form/validation/StringValidator.php';
require_once '../app/coreLib/ui/form/validation/EmailValidator.php';
require_once '../app/coreLib/ui/form/validation/ValidatorFactory.php';
require_once '../app/coreLib/ui/form/validation/RuleInterface.php';
require_once '../app/coreLib/ui/form/validation/EmailRule.php';
require_once '../app/coreLib/ui/form/validation/StrMinLengthRule.php';
require_once '../app/coreLib/ui/form/validation/StrMaxLengthRule.php';
require_once '../app/coreLib/ui/form/validation/StrPatternRule.php';


$sv = new StringValidator();
$sv->setRequireValid();
$sv->setMinLengthValid(5, "number is small");

$value = "ddd";
$x = $sv->validate($value);

var_dump($x);

$value = "";
$x1 = $sv->validate($value);
var_dump($x1);

$f = new ValidatorFactory();
$ev = $f->create('EmailValidator');
$ev->setEmailValid(null, 'DFDFDFDFDFDFD');

$d = $ev->validate("erer");
var_dump($d);

?>
