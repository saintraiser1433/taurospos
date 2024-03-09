<?php

include 'mysqldump.php';
$date = date('Y-m-d') . time();
$dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=borrows', 'root', '');
$dump->start('backupdatabase/borrows' . $date . '.sql');
header('Content-type: sql');
header('Content-Disposition: attachment; filename="borrows' . $date . '.sql"');
readfile('backupdatabase/borrows' . $date . '.sql');
