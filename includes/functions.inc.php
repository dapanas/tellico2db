<?php

function getTellicoType($id) {
	return constant("$id");
}

function getSQLType($tellicoType) {
	return constant($tellicoType);
}

?>
