<?php
include_once "../projects.php";

// Create a new project with the given name and url for the main image
$p = new Project("Recovering Spectral Reflectance under Commonly Available Lighting Conditions", "img/overall.jpg");


// Set the description here. Enclose each paragraph in a <p> and </p>
$p->addDescription('
	<p>Recovering the spectral reflectance of a scene is important for sceneunderstanding. Previous approaches use either specialized filters orcontrolled illumination where the extra hardware prevents many practicalapplications.  In this paper, we propose a method that accuratelyrecovers spectral reflectance from two images taken with conventionalconsumer cameras under commonly available lighting conditions, such asdaylight at different times over a day, camera flash and ambient light,and fluorescent and tungsten light. Our approach does not require cameraspectral sensitivities or the spectra of the illumination, which makesit easy to implement for a variety of practical applications. Based onnoise analysis, we also derive theoretical predictors that answer: (1)which two lighting conditions lead to the most accurate spectralrecovery overall, and (2) for two given lighting conditions, whichspectral reflectance is more likely to be estimated accurately.  Weimplement the method on a variety of cameras from high-end DSLRs tocellphone cameras, and apply the recovered spectral reflectance forseveral applications such as fine art reproduction, fruitidentification, and material classification. Both simulation andexperimental results demonstrate the effectiveness of the proposedmethod.</p>');


// Add publications here. You can use either the publication number, or the full title

$p->addPublication("<p>Jun Jiang and Jinwei Gu. <i><a 
	href='mainPaper.pdf'>Recovering Spectral Reflectance under Commonly Available Lighting Conditions</a></i>. CVPR 2012 CCD.");

$p->addPublication("<p>Jun Jiang and Jinwei Gu.<i><a href='supp.pdf'>Supplementary 
	Document</a></i> (with other experimental details).");

// Add software and database here

$p->addSoftware("./code.zip","Code (including an example)",//
	'The zip file includes a set of exmaple images and code to recover the spectral reflectance under commonly available lighting conditions.');


// Add images here. Args are (url to image, url to thumbnail, title, description)
$p->addImage("img/daisy.jpg", "img/daisyThumbnail.jpg", 
	"Spectral Recovery of Fine Art Painting", "We recover the spectral reflectance of the oil painting	‘Daisy’. (a) and (b) The captured images under the fluorescent light	and the tungsten light. (c), (d) and (e) The reflectance estimated	and measured at selected areas (P, Q and R) on the painting. (f) and	(g) The rendered image under CIE D65 and IllA.");

$p->addImage("img/fruits.png", "img/fruits.jpg", "Identification of Fruits",
 	"The spectral recovery and identification of fruits. Before the experiment, adatabase was created by including measured reflectance of ten differentkinds of fruits. Next, we captured fruit underthe fluorescent light (a) and the tungsten light (b) by Canon 60D.(c) The measured and estimated reflectance of each fruit. (d) The rendering of fruits under CIE IllA. The artifacts in green	were due to the shadows in the captured images. (e) All fruits were identified correctly except the pumpkin (P2) and	mango (P3), due to the very similarity of their	reflectance. On the other hand, while being similar in color	in (a) and (b), the squash (P5) was able to be	distinguished from the pumpkin (P2) and mango (P3).	The identification of fruits by the spectral information is robust tothe scene illuminant and to the distortion of the food shape during theprocessing of food. In addition, if the spectral images of the fruitsat different times (\eg when they were ripe or rotten) are available, theidentification results can be useful as a quality control measure.");

$p->addImage("img/outdoorMaterial.png", "img/outdoorMaterial.jpg", 
	"Classification of Outdoor Materials", "We recover the spectral reflectance of outdoor materials under daylight. Based on the recovered reflectance, classifications of materials are made. (a) and (b) The captured pictures under daylight	at 7:41 a.m. and 10:05 a.m. (c) The daylight spectra (normalized to be 1 at 560 nm). (d) The measured and	estimated reflectance of the aloe, ceramic (the specular side),	copper, ceramic (the diffuse side), gray plastic, soil, green	plastic, and aluminum. (e) The rendering of the scene under CIE	IllA. (f) All materials were classified (indicated by different colors). The ColorChecker Passport (CCP) was included to	characterize the lighting.");

$p->addImage("img/N900.png", "img/N900.jpg", 
	"Extension to Smartphone Camera: Nokia N900", "Smartphones and other mobile platforms are gradually changing how we operate our daily life by integratingboth the eyes (the camera) and brain (the computing unit) on a cell phone.While a handheld spectrophotometer can be used to measure the spectral reflectance of materials, the use of cell phone cameras has the benefit of lower costand acquisition of the scene reflectance rather than of a small uniform area on a surface.We did an experiment to evaluate the spectral recovery performance of smartphones, Nokia N900, by validating CCDC. Moreover, the picture under one (rather than two) lighting condition was used to recover the scene reflectance.The validation of CCDC using the camera phone, Nokia N900, under the tungsten light only. (a) The estimated and measured reflectance of certain patches in CCDC. 
The numbers on the top of each plot are the spectral RMS error, and color difference under CIE D65 and IllA. The patch index (\#) is shown as well. 
A close spectral and colorimetric match could be achieved generally between the ground truth and our results except for patches of reddish colors. 
(b) Noise analysis was performed by calculating $\rho$ to tell which reflectance is likely to be predicted better under the tungsten light. 
Two patches were selected with small and large $\rho$. A smaller $\rho$ means a better spectral match.");


$p->addSlides("CVPR 2012 CCD Oral Presentation (to come soon)", "", "");
$p->addSlides("CVPR 2012 CCD Poster (PDF)", "CVPR2012_CCD_POSTER.pptx", "");


// Add related projects here. The only argument is the relative path to the project (something like "../scene_collage/")
$p->addRelated("http://www.cs.columbia.edu/CAVE/projects/multispectral_imaging/", "Multispectral Imaging Using Multiplexed Illumination");
$p->addRelated("http://www.art-si.org/", "Multispectral Imaging on Fine Art Reproductions");

// Do not change or remove this line! It is the one responsible for writing the whole page.
$p->render();

?>

