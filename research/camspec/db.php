<?php
include_once "../database.php";

// Create a new project with the given name and url for the main image
$p = new Database("Camera Spectral Sensitivity Database", "img/camspec_database.png");

// Set the description here. Enclose each paragraph in a <p> and </p>
$p->addDescription("
<p align='center'><a href='camspec_database.txt'>Database</a></p>
<p align='center'><a href='camlist&equipment.txt'>Camera Info</a></p>
<p>
Camera spectral sensitivity functions relate scene radiance with captured RGB 
triplets. They are important for many computer vision tasks that use color 
information, such as multispectral imaging, and color constancy.</p>

<p>We create a database of 28 cameras covering a variety of types. The database 
contains the spectral sensitivity functions for 28 cameras, including 
professional DSLRs, point-and-shoot, industrial and mobile phone camera. We use 
a spectrometer PR655 from Photo Research Inc., a light source and monochrometer 
combined with an integrating sphere to do the measurement. Each measurement 
starts from wavelength 400nm to 720nm in an interval of 10nm. Measured Sensitivities are normalized to 1 for RGB channels seperately. The database is in the form 
of a text file. Each entry starts with camera name and follows by measured 
spectral sensitivities in red, green and blue channel.</p>
");

// Add publications here. You can use either the publication number, or the 
// full title

$p->addPublication("<p>Jun Jiang, Dengyu Liu, Jinwei Gu and Sabine S&uumlsstrunk. 
<i><a 
    href='camspec.pdf'>What is the Space of Spectral Sensitivity Functions for 
    Digital Color Cameras?</a></i>. WACV 2013.");

$p->addPublication("<p>Jun Jiang, Dengyu Liu, Jinwei Gu and Sabine 
S&uumlsstrunk.<i><a href='supp.pdf'>Supplementary 
    Document</a></i> (with proof and other experimental details).");

// Add software and database here

$p->addSoftware("css_code.zip","Code for recovering camera spectral 
    sensitivity from a single image","This demo MATLAB code shows the recovery of camera spectral 
    sensitivity with a regular color checker from a single picture under unknown 
    daylight. An example image captured by a Canon 60D (CR2 RAW format) is 
    included. The measured camera spectral sensitivity for Canon 60D 
	and measured daylight are also included for comparison.");

// Add demos here. Args are (Full demonstration name, url, thumbnail, short 
// title, description).
// Your description should contain the system requirements as well.
/*
$p->addDemo("Interactive Face Replacement Demonstration (<b>Coming Soon</b>)", 
"", "images/demo_thumb.png", "Automatic Face Replacement - An Interactive 
Demo", "An interactive demo created by Dmitri Bitouk, Neeraj Kumar, and Lin 
Yang.");

*/

// Add images here. Args are (url to image, url to thumbnail, title, 
// description)

// Add videos here. Args are (url to video, url to thumbnail, title, 
    // description)


// Add related projects here. The only argument is the relative path to the 
// project (something like "../scene_collage/")
$p->addRelated("http://www.cis.rit.edu/jwgu/research/camspec", 
"What is the Space of Spectral Sensitivity Functions for Digital Color Cameras");

// Do not change or remove this line! It is the one responsible for writing the 
// whole page.
$p->render();

?>

