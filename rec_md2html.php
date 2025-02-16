<?php require 'lib/parsedown/Parsedown.php';

function rec_md2html($src, $dst)
{
	$src = rtrim($src, '/');
	$dst = rtrim($dst, '/');
	$srclen = strlen($src);
	if (is_dir($dst) == false) mkdir($dst, 0755, true);

	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($src,
		RecursiveDirectoryIterator::SKIP_DOTS),
		RecursiveIteratorIterator::SELF_FIRST
	);

	foreach ($iterator as $item) {
		if ($item->isFile() and strcmp(strtolower($item->getExtension()), 'md') == false) {
			$srcpath = $item->getPath();
			#$srcpath = rtrim($item->getPath(), '/');
			$subpath = substr($srcpath, $srclen, strlen($srcpath) - $srclen);
			$dstpath = $dst . $subpath;
			if (is_dir($dstpath) == false and mkdir($dstpath, 0755, true) == false) {
				die("Error: could not make dir: " . $dstpath);
			}

			$srcpathname = $item->getPathname();
			$subpathname = substr($srcpathname, $srclen, strlen($srcpathname) - $srclen - 2);
			$dstpathname = $dst . $subpathname . 'html';
			$srcfile = fopen($srcpathname, "r") or
				die("Error: couldn't open file for reading: '" . $srcpathname . "'\n");
			$dstfile = fopen($dstpathname, "w") or fclose($srcfile) and
				die("Error: couldn't open file for writing: '" . $dstpathname . "'\n");
			$mdcontent = fread($srcfile, filesize($srcpathname)) or fclose($srcfile) and fclose($dstfile) and
				die("Error: couldn't read file: '" . $srcpathname . "'\n");
			$parsedown = new Parsedown ();
			fwrite($dstfile, $parsedown->text($mdcontent)) or
				die("Error: couldn't write to file: '" . $dstpathname . "'\n");
			fclose($srcfile);
			fclose($dstfile);
		}
   }
}

if ($argc < 3) die("Usage: php ". $argv[0] ." <inputdir> <outputdir>\n");

if (is_dir($argv[1]) == false) {
	die("input needs to be an existing directory\n");
} else {
	print_r(rec_md2html($argv[1], $argv[2]));
}

?>
