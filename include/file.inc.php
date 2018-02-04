<?php

function checkImageFile($fileName)
{
	return ((exif_imagetype($fileName) == IMAGETYPE_JPEG)
	        || (exif_imagetype($fileName) == IMAGETYPE_PNG)
	        || (exif_imagetype($fileName) == IMAGETYPE_BMP));
}

function getExtension($fileName)
{
	$info = pathinfo($fileName);
	return $info['extension'];
}

function checkImageSize($fileName)
{
	return (filesize($fileName) <= 2097152);
}

function getLinkString($path, $querys)
{
	$query = "?";
	$index = 0;
	foreach ($querys as $key => $value) {
		if ($key != 'page') {
			$index++;
			$query .= $key . "=" . $value . "&";
		}
	}
	$dir = "/library/" . basename($path) . $query . "page=";
    return  array('name' => $dir);
}