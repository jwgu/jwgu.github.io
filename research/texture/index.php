<?php
include_once "../projects.php";

// Create a new project with the given name and url for the main image
$p = new Project("Learning Discriminative Illumination and Filters for BTF Classification", "img/overall.png");


// Set the description here. Enclose each paragraph in a <p> and </p>
$p->addDescription('
	<p>
	We present a computational imaging method for raw material 
	classification using features of Bidirectional Texture Functions 
	(BTF). Texture is an intrinsic feature for many materials, such as 
	wood, fabric, and granite. At appropriate scales, even " uniform " 
	materials will also exhibit texture features that can be helpful for 
	recognition, such as paper, metal, and ceramic. To cope with the 
	high-dimensionality of BTFs, in this project, we proposed to simultaneously learn 
	discriminative illumination patterns and texture filters, with which 
	we can directly measure optimal projections of BTFs for 
	classification. We also studied the effects of texture rotation and 
	scale variation for material classification. We built an LED-based 
	multispectral dome, with which we have acquired a BTF database of a 
	variety of materials and demonstrated the effectiveness of the 
	proposed approach for material classification.
 </p>');


// Add publications here. You can use either the publication number, or the full title

$p->addPublication("<p>Chao Liu, Gefei Yang, and Jinwei Gu. <i><a 
	href='texture.pdf'>Learning Discriminative Illumination and Filters for Raw Material 
	Classification with Optimal Projections of Bidirectional Texture Functions</a></i>. CVPR 2013.");

$p->addPublication("<p>Chao Liu, Gefei Yang, and Jinwei Gu.<i><a href='texture_supp.pdf'>Supplementary 
	Document</a></i> (with proof and other experimental details).");

// Add software and database here

/*$p->addSoftware("http://compimg1.cis.rit.edu/data/metal","Database of Spectral BRDFs of Raw 
	Materials",
	'The <a href="http://compimg1.cis.rit.edu/data/metal">database</a> 
	includes 100 sample plates covering five material catoegories. For 
	each sample plate, there are 150 HDR images captured, corresponding 
	to the 150 LEDs. ');
 */

// Add demos here. Args are (Full demonstration name, url, thumbnail, short title, description).
// Your description should contain the system requirements as well.
/*
$p->addDemo("Interactive Face Replacement Demonstration (<b>Coming Soon</b>)", "", "images/demo_thumb.png", "Automatic Face Replacement - An Interactive Demo", "An interactive demo created by Dmitri Bitouk, Neeraj Kumar, and Lin Yang.");

*/

// Add images here. Args are (url to image, url to thumbnail, title, description)
$p->addImage("img/fig_1.png", "img/fig_1_thumb.png", 
	"Texture classification with discriminative illumination and filters", 
	"Texture classification with discriminative illumination and 
	filters. (a) Classifying aluminum and stainless steel under 
	conventional lighting with regular color camera is challenging, 
	since they have similar color and gloss. (b) We proposed to capture 
	projections of BTFs for material classification with coded 
	illumination, implemented as a LED-based multispectral dome. (c) and 
	(d) show the optimal illumination. The bar graph shows the learned 
	w, where the 25 bar groups correspond to the 25 LED clusters and the 
	six bars within each group correspond to the six LEDs. This coded 
	light pattern is also shown as w_p and w_n where w = w_p-w_n. (e) 
	The optimal filters. (f)(g)(h) show the classification rates on test 
	data using the VZ texture classifier [Varma05], BRDF Projection 
	[Gu09] and our method with the same number of measurements.");

$p->addImage("img/fig_2.png", "img/fig_2_thumb.png", "The effect of 
	orientation for BTF classification",
	"The effect of orientation for BTF classification. (a) We prepared two 
	materials coated with the same blue paint for material classification 
	with texture only. The samples measured at different orientations show 
	the changes in self-shadow and specular lobe caused by surface geometry. 
	(b) By using multiple rotated samples in training, we learned 
	classifiers (i.e., illumination and filters) that are more robust to 
	orientation. (c) As expected, the accuracy of our BTF projection method 
	increases with the number of rotated samples added to the training set, 
	while the BRDF projection method [Gu09] does not vary significantly.");

$p->addImage("img/fig_3.png", "img/fig_3_thumb.png", 
	"The effect of scale for BTF classification", 
	"(a)(b) show the images of carpet and paper captured at two different 
	scales. (c)(e): the optimal illumination (w_p, w_n) and filters 
	trained with samples in one scale. (d)(f): the optimal illumination 
	(w_p, w_n) and filters trained with samples in both scales. The 
	differences in the trained illumination and filters confirm that BTF 
	is not scale-invariant. (g): classification results when only 
	samples in one scale are included in the training set. (h) 
	classification results when samples in both scales are included in 
	training set. The classification rate increases as the training sets 
	include both scales.");

$p->addImage("img/fig_4.png", "img/fig_4_thumb.png", 
	"Comparisons with other texture-based methods", 
	"The classification for aluminum and stainless steel samples. (a) 
	Images of samples when all LEDs are turned on; (b) VZ classifier ; 
	(c) 3D texton; (d) BRDF projection; (e) BRDF projection coupled with 
	optimal filters; (f) Our method. The accuracy is shown in the 
	bracket.");

$p->addImage("img/fig_5.png", "img/fig_5_thumb.png", 
	"Trained filter banks with different filter sizes",
	"From top to bottom, the filter sizes are: 3 x 3, 7 x 7,11 x 11, 19 x 
	19 and 27 x 27, with the classification rate for the task aluminum 
	vs. stainless shown to the bottom of each filter bank. The 
	corresponding filters, shown in the same column, are not necessarily 
	the scaled versions of each other due to two reasons: 1) increasing 
	the filter size does not necessarily include more informations about 
	the texture due to the repetition of patterns. 2) As the filter size 
	increases, it is more likely to include outliers, such as the 
	specular lobes, into the training set.");

$p->addImage("img/fig_6.png", "img/fig_6_thumb.png", "The filters in the 
	optimal filter banks with different number of filters", 
	"The filters in the optimal filter banks with different number of 
	filters. Shown on the left side are the number of filters in the filter 
	bank and the classification rate for the task aluminum vs. stainless 
	steel. As shown, the performance for this task increases fast with the 
	number of filters. This indicate that the classification of aluminum 
	and stainless can be performed well on a subspace of BTF with lower 
	dimensionality. The observation is similar in [Varma05] that some 
	texture classification tasks can be performed well even though the 
	sampling patch size is small (i.e., using more local feature). 
	Within each filter bank, the spatial frequency of the learned filter 
	increases with the index of filter. This indicates that the 
	difference of the projection of BTF is concentrated on the low 
	spatial frequencies.");



// Add videos here. Args are (url to video, url to thumbnail, title, description)
$p->addVideo("supp_final.mp4", "img/video_thumb.png",
	"Supplementary Video", "This video includes more experimental results. (2.3MB)");

$p->addSlides("CVPR 2013 Poster (to come soon)", "", "");
//$p->addSlides("ICCP 2012 Poster (PDF)", "iccp2012poster.pdf", "");


// Add related projects here. The only argument is the relative path to the project (something like "../scene_collage/")
$p->addRelated("http://www.cis.rit.edu/jwgu/research/fisherlight/", "Discriminative Illumination for BRDF Classification");
$p->addRelated("http://zurich.disneyresearch.com/~owang/pub/brdfseg.html", "Material Classification with BRDF Slices");
$p->addRelated("http://hci.iwr.uni-heidelberg.de/Staff/mjehle/projects.php", "Optimal Illumination for Material Classification");

// Do not change or remove this line! It is the one responsible for writing the whole page.
$p->render();

?>

