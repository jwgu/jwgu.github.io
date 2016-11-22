<?php
include_once "../projects.php";

// Create a new project with the given name and url for the main image
$p = new Project("Recovering Spectral Reflectance under Commonly Available Lighting Conditions", "img/overall.jpg");


// Set the description here. Enclose each paragraph in a <p> and </p>
$p->addDescription('
	<p>


// Add publications here. You can use either the publication number, or the full title

$p->addPublication("<p>Jun Jiang and Jinwei Gu. <i><a 
	href='mainPaper.pdf'>Recovering Spectral Reflectance under Commonly Available Lighting Conditions</a></i>. CVPR 2012 CCD.");

$p->addPublication("<p>Jun Jiang and Jinwei Gu.<i><a href='supp.pdf'>Supplementary 
	Document</a></i> (with other experimental details).");

// Add software and database here

$p->addSoftware("./code.zip","Code (including an example)",
	'The zip file includes a set of exmaple images and code to recover the spectral reflectance under commonly available lighting conditions.');


// Add images here. Args are (url to image, url to thumbnail, title, description)
$p->addImage("img/daisy.jpg", "img/daisyThumbnail.jpg", 
	"Spectral Recovery of Fine Art Painting", "We recover the spectral reflectance of the oil painting

$p->addImage("img/fruits.png", "img/fruits.jpg", "Identification of Fruits",
 	"The spectral recovery and identification of fruits. Before the experiment, a

$p->addImage("img/outdoorMaterial.png", "img/outdoorMaterial.jpg", 
	"Classification of Outdoor Materials", "We recover the spectral reflectance of outdoor materials under daylight. Based on the recovered reflectance, classifications 

$p->addImage("img/N900.png", "img/N900.jpg", 
	"Extension to Smartphone Camera: Nokia N900", "Smartphones and other mobile platforms are gradually changing how we operate our daily life by integrating
The numbers on the top of each plot are the spectral RMS error, and color difference under CIE D65 and IllA. The patch index (\#) is shown as well. 
A close spectral and colorimetric match could be achieved generally between the ground truth and our results except for patches of reddish colors. 
(b) Noise analysis was performed by calculating $\rho$ to tell which reflectance is likely to be predicted better under the tungsten light. 
Two patches were selected with small and large $\rho$. A smaller $\rho$ means a better spectral match.


$p->addSlides("CVPR 2012 CCD Oral Presentation (to come soon)", "", "");
$p->addSlides("CVPR 2012 CCD Poster (PDF)", "CVPR2012_CCD_POSTER.pptx", "");


// Add related projects here. The only argument is the relative path to the project (something like "../scene_collage/")
$p->addRelated("http://www.cs.columbia.edu/CAVE/projects/multispectral_imaging/", "Multispectral Imaging Using Multiplexed Illumination");
$p->addRelated("http://www.art-si.org/", "Multispectral Imaging on Fine Art Reproductions");

// Do not change or remove this line! It is the one responsible for writing the whole page.
$p->render();

?>
