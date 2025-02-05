<html>
<body>

<h1>Welcome to my home page!</h1>
<?php require 'Parsedown.php';
echo 'PHP version: ' . phpversion();

$inputname    = 'index.md';
$inputnamelen = strlen($inputname);
if ($inputnamelen < 4 or str_ends_with($inputname, ".md") == false)
	die("Error: invalid input name: '" . $inputname . "'.\n");

$inputfd = fopen($inputname, "r") 
	or die("Error: couldn't open file: '".$inputname."'.\n");
$input   = fread($inputfd, filesize($inputname));

$outputname = substr($inputname, 0, $inputnamelen - 2) . "html";
$output     = fopen($outputname, "w")
	or die("Error: couldn't open file: '".$outputname."'.\n");
$Parsedown = new Parsedown();
fwrite($output, $Parsedown->text($input));
fclose($output);
?>
</body>
</html>
