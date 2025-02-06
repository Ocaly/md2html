<?php require './lib/parsedown/Parsedown.php';
if ($argc != 3) die("Usage: php ". $argv[0] ." <inputfile> <outputfile>\n");
if (pathinfo($argv[1])['extension'] !== 'md') {
	die("input needs to be Markdown(.md)\n");
}
if (pathinfo($argv[2])['extension'] !== 'html') {
	die("output needs to be HTML(.html)\n");
}

$inputf = fopen($argv[1], "r") 
	or die("Error: couldn't open file: '" . $argv[1] . "'.\n");
$input  = fread($inputf, filesize($argv[1]));

$output = fopen($argv[2], "w")
	or fclose($input)
	and die("Error: couldn't open file: '" . $argv[2] . "'.\n");

$Parsedown = new Parsedown();
fwrite($output, $Parsedown->text($input));
fclose($output);
?>
