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

printf("\n=== FIELDS ===\n\n");
printf(FIELD_TABLE_FORMAT, "TITLE", "NAME", "TELLICO TYPE" , "SQL TYPE");
printf("%'-68s\n", "");

foreach ($tellico->collection->fields->field as $field) {
	$tellicoType = getTellicoType($field['type']);
	printf(FIELD_TABLE_FORMAT, $field['title'], $field['name'], $tellicoType , getSQLType($tellicoType));
}

printf("\n=== ENTRIES ===\n\n");

printf(ENTRY_TABLE_FORMAT, "ID", "TITLE", "AUTHOR(S)" , "CODE", "PUBLISHER", "PYEAR", "ISBN", "PAGES", "KEYWORD(S)", "SERIES", "DONATED BY", "C DATE", "M DATE", "L", "SIGNATURE");
printf("%'-217s\n", "");

foreach ($tellico->collection->entry as $entry) {
	$cdate = $entry->cdate->year . "/" . $entry->cdate->month . "/" . $entry->cdate->day;
	$mdate = $entry->mdate->year . "/" . $entry->mdate->month . "/" . $entry->mdate->day;
	
	$authors = "";
	foreach ($entry->authors->author as $author) {
		$authors .= $author . " ";
	}

	$keywords = "";
	foreach ($entry->keywords->keyword as $keyword) {
		$keywords .= " " . implode("", explode(",", $keyword));
	}

	$loaned = $entry->loaned ? "T" : "F";
	
	printf(ENTRY_TABLE_FORMAT, $entry->id, $entry->title, $authors, $entry->code, $entry->publisher, $entry->pub_year, $entry->isbn, $entry->pages, $keywords, $entry->series, $entry->donated_by, $cdate, $mdate, $loaned, $entry->signature);
}

printf("\n=== BORROWERS ===\n\n");

printf(BORROWERS_TABLE_FORMAT, "NAME", "LOAN DATE", "DUE DATE", "B ID", "COMMENTS");
printf("%'-184s\n", "");

foreach ($tellico->borrowers->borrower as $borrower) {
	foreach ($borrower->loan as $loan) {
		printf(BORROWERS_TABLE_FORMAT, $borrower['name'], $loan['loanDate'], $loan['dueDate'], $loan['entryRef'], str_replace("\n", " ", $loan));
	}
}

?>
