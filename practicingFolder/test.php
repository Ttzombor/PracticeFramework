<?php
try {
    if (!file_exists('delete.txt')) {
       throw new Exception('File not found');
    }
   unlink('delete.txt');

} catch (Throwable $t) {
   echo $t->getMessage();
}
$dbHash = '$2y$10$hIM0uIy8hdGzy2cCLjEqJOw4ZFyqEd0dDPjLlVp6YojCjuv2wr8EO';

$hash = '$2y$10$qAUNatmDtGYhLQPSp1sHUO17sAcUOxas9yqKamP8N1FSmkSLFAyKy';
$loginPassword = 'asd';
echo $hash;
$verify = password_verify($loginPassword, $hash);

if($verify){

    echo "Its a match";

}else{

    echo "nope";

}