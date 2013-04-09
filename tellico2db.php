<?php

if ($argc != 2) {
  printf("Usage: php %s tellicoFile.xml\n", $argv[0]);
  exit(-1);
}

$fileName = $argv[1];

if (!file_exists($fileName)) {
	exit("Error: Unable to open file $fileName\n");
}

require 'includes/constants.inc.php';
require 'includes/functions.inc.php';

$tellico = simplexml_load_file($fileName);

printf(TABLE_FORMAT, "TITLE", "NAME", "TELLICO TYPE" , "SQL TYPE");
printf("%'-60s\n", "");

foreach ($tellico->collection->fields->field as $field) {
	$tellicoType = getTellicoType($field['type']);
	printf(TABLE_FORMAT, $field['title'], $field['name'], $tellicoType , getSQLType($tellicoType));
}

?>
