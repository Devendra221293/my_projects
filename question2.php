$count = array();
$string="we test coders.give us a try?";
$pieces = preg_split('/ (?!.* )/',$string);

$part=sizeof($pieces);

for($i=0;$i<$part;$i++)
{
 array_push($count,str_word_count($pieces[$i]));
}

$value = max($count);

echo $value;
