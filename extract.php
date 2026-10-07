<?php
$data = file_get_contents('D:\Sound laravel eproject\SOUND.doc');
preg_match_all('/[\x20-\x7E]{5,}/', $data, $matches);
file_put_contents('D:\Sound laravel eproject\SOUND.txt', implode("\n", $matches[0]));
