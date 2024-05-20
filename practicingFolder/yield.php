<?php

require 'vendor/autoload.php';

function convert($size)
{
    $unit= array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

/** @var \PDO $databaseConnection */
$connection = new \App\Database\Connection();
$databaseConnection = $connection->setup();
function getPosts($databaseConnection)
{
    $index = 0;
    $batchSize = 10000;
    $data = [];
    while(true) {
        $begin = microtime(true);
        $currentBatch = $batchSize * $index;
        $query = $databaseConnection->query(sprintf("SELECT * FROM post LIMIT %s OFFSET %d", $batchSize, $currentBatch));
        if ($index && $query->rowCount() === 0) {
            break;
        }
        while ($row = $query->fetchAll()) {
            yield $row;
            break;
        }
        $index++;
//        if ($result = $query->fetchAll()) {
//            $end = microtime(true);
//            echo intval($end - $begin). ' seconds ' . PHP_EOL;
//            yield $result;
//        }
    }
}
foreach (getPosts($databaseConnection) as $posts) {
    echo convert(memory_get_usage()) . PHP_EOL;
    echo count($posts);
}
?>