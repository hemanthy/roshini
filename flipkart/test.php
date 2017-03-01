<?php

$redirectUrl = 'https://www.flipkart.com/?affid=affname&affExtParam1=userreferencecode';
$redirectUrl = str_replace("affname","allgadget",$redirectUrl,$i);
$redirectUrl = str_replace("userreferencecode",'8932',$redirectUrl,$i);
echo $redirectUrl;

$arr = 'red';
print_r(str_replace("red","pink",$arr,$i));
echo "Replacements: $i";

echo $arr;
?>