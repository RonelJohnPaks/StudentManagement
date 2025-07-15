<?php
include  'vendor/autoload.php';

use Benatero\StudentManagement\Model\StudentModel;

$student = new StudentModel;
$student->id = 202268001;
$student->fullname = "David, Dimaguiba";
$student->yearlevel = "Fourth Year";
$student->course = "BSCRIM";
$student->section = "Alpha";

$student->displayInfo();