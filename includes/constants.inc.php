<?php

# Tellico type definition according to http://docs.kde.org/stable/en/extragear-office/tellico/field-type-values.html
define('1', 'SIMPLE_TEXT');
define('2', 'PARAGRAPH');
define('3', 'CHOICE');
define('4', 'CHECKBOX');
define('6', 'NUMBER');
define('7', 'URL');
define('8', 'SINGLE-COLUMN TABLE');
define('10', 'IMAGE');
define('12', 'DATE');
define('14', 'RATING');

# SQL type equivalent
define('SIMPLE_TEXT', 'VARCHAR(255)');
define('PARAGRAPH', 'TEXT');
define('CHOICE', 'INT(10)'); # to be used like a relation
define('CHECKBOX', 'TINYINT(1)');
define('NUMBER', 'INT(10)');
define('URL', 'VARCHAR(255)');
define('SINGLE-COLUMN TABLE', 'TEXT');
define('IMAGE', 'VARCHAR(255)');
define('DATE', 'DATE()');
define('RATING', 'INT(10)');

# Utils
define("TABLE_FORMAT", "%-15.15s\t%-15.15s\t%-15.15s\t%-15.15s\n");

?>
