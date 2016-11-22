<?php
include_once "/proj/cave/backup/html/pubadmin/db_connect.php";
/* Generic functions to use for all projects
   Created by Neeraj Kumar, December 5, 2007.
*/

// A function to read all files in a directory
function readFilesInDir($dir, $exts=array()){
	$images = array();
	if ($handle = opendir($dir)) {
		while (false !== ($file = readdir($handle))) {
			$valid = true;
			if (count($exts) > 0){
				$valid = false;
				foreach($exts as $ext){
					if (strpos($file, $ext) !== false){ 
						$valid = true;
						break;
					}
				}
			}
			if ($valid){
				$images[] = $file;
			}
		}
		closedir($handle);
	}
	return $images;
}

class Project {
	var $title;
	var $titleimg;
	var $titleimg_alt;
	var $ptype;
	var $desc;
	var $pubs;
	var $sections;
	var $demos;
	var $images;
	var $imgnote;
	var $gallery;
	var $videos;
	var $vidfmt;
	var $slides;
	var $softwares;
	var $dbs;
	var $extgals;
	var $extsoftwares;
	var $extdbs;
	var $articles;
	var $related;
	var $others;
	var $order;

	// Defines a new project with the given title and title image url. 
	// Sets everything else to blank/empty arrays
	function Project($title, $titleimg="", $titleimg_alt="", $ptype="project"){
		$this->title = $title;
		$this->titleimg = $titleimg;
		$this->titleimg_alt = $titleimg_alt;
		$this->ptype = $ptype;
		// empty description
		$this->desc = "";
		$this->imgnote = "";
		// empty arrays for everything else
		$this->pubs = array();
		$this->sections = array();
		$this->demos = array();
		$this->images = array();
		$this->videos = array();
		$this->vidfmt = "";
		$this->slides = array();
		$this->softwares = array();
		$this->dbs = array();
		$this->extgals = array();
		$this->extsoftwares = array();
		$this->extdbs = array();
		$this->articles = array();
		$this->related = array();
		$this->others = array();
		$this->order = array();
	}

	// Few-paragraph description of project
	function addDescription($desc){
		$this->desc = $desc;
	}

	// Publication (by publication number)
	function addPublication($pub){
		$this->pubs[] = $pub;
	}

	// Generic Section (heading + raw html of what to put in it)
	function addSection($name, $data){
		$cur = array($name, $data);
		$this->sections[] = $cur;
	}

	// We do it this way to allow variadic arguments
	//function addDemo($demoname, $url, $thumb, $title, $desc){
	function addDemo(){
		// get a list and count of all the arguments
		$args = func_get_args();
		$numargs = func_num_args();
		// the first argument is the overall demo name
		$toadd = array();
		$demoname = $args[0];
		// now take sets of 4 arguments at a time to get individual demos
		for ($i = 1; $i < $numargs; $i+=4){
			$url = $args[$i];
			$thumb = $args[$i+1];
			$title = $args[$i+2];
			$desc = $args[$i+3];
			$cur = array($url, $thumb, $title, $desc);
			$toadd[] = $cur;
		}
		$this->demos[] = array($demoname, $toadd);
	}

	function addImageNote($note){
		$this->imgnote = $note;
	}

	function addImage($url, $thumb, $title, $desc){
		$im = array($url, $thumb, $title, $desc);
		$this->images[] = $im;
	}

	function addGallery($url, $thumb, $newline){
		$im = array($url, $thumb, $newline);
		$this->gallery[] = $im;
	}

	function addVideo($url, $thumb, $title, $desc){
		$vid = array($url, $thumb, $title, $desc);
		$this->videos[] = $vid;
		$this->vidfmt = substr($url, strlen($url)-4);
		if ($this->vidfmt[0] != '.'){
			$this->vidfmt = "";
		}
	}

	function addSlides($name, $urlNoVids, $urlWithVids=""){
		$sl = array($name, $urlNoVids, $urlWithVids);
		$this->slides[] = $sl;
	}

	function addSoftware($url, $name, $desc=""){
		$sw = array($url, $name, $desc);
		$this->softwares[] = $sw;
	}

	function addDatabase($url, $name, $desc=""){
		$database = array($url, $name, $desc);
		$this->dbs[] = $database;
	}

	function addExtGallery($url, $thumb, $title, $desc){
		$gal = array($url, $thumb, $title, $desc);
		$this->extgals[] = $gal;
	}

	function addExtSoftware($url, $thumb, $title, $desc){
		$sw = array($url, $thumb, $title, $desc);
		$this->extsoftwares[] = $sw;
	}

	function addExtDatabase($url, $thumb, $title, $desc){
		$database = array($url, $thumb, $title, $desc);
		$this->extdbs[] = $database;
	}

	function addOther($url, $thumb, $title, $desc){
		$other = array($url, $thumb, $title, $desc);
		$this->others[] = $other;
	}

	// This is for linking to press about the project
	function addArticles($url, $name){
		$article = array($url, $name);
		$this->articles[] = $article;
	}

	// The url can either be a relative link to another CAVE project
	// (like ../facesearch/) or a full http link.
	// If it's a relative link, you don't need to give it a name.
	function addRelated($url, $name=""){
		$rel = array($url);
		if ($name == ""){
			// find the right name
			// open the file
			$els = explode('/', $url);
			$n = count($els)-1;
			$url = $els[$n];
			while ($url == ""){
				$n -= 1;
				$url = $els[$n];
			}
			$url1 = '../' . $url . '/' . $url . '.php';
			$url2 = '../' . $url . '/' . 'index.php';
			//print("URL is $url2");
			$urls = array($url1, $url2);
			foreach($urls as $u){
				$f = @fopen($u, "r");
				if (!$f) continue;
				while (!feof($f)){
					$line = fgets($f);
					// test for old-style titles
					$cur = strchr($line, '$base_title = "');
					if ($cur != ""){
						$els = explode('"', $cur);
						$name = $els[1];
					}
					// test for new-style titles
					$cur = strchr($line, 'new Project(');
					if ($cur != ""){
						$els = explode('"', $cur);
						$name = $els[1];
					}
				}
				fclose($f);
			}
		}
		$rel[] = $name;
		$this->related[] = $rel;
	}

	function getVidFmtNote($fmt){
		return "If you are having trouble viewing these <b>$fmt</b> videos in your browser, please save them to your computer first (by right-clicking and choosing \"Save Target As...\"), and then open them.";
	}

	// Renders the page. You must call this function to display the page.
	// The rendering order is fixed. It's a little tricky to change this.
	function render(){
		if ($_GET['download'] == '1'){
			#print("HELLO");
			return;
		}
		$this->printHeader();
		$this->printBasic();
		$this->printMedia("Project", $this->others);
		$this->printPublications();
		$this->printSections();
		$this->printDemos();
		$this->printGallery("Gallery", $this->gallery);
		$this->printMedia("Gallery", $this->extgals);
		$this->printMedia("Image", $this->images, $this->imgnote);
		$this->printMedia("Video", $this->videos, $this->getVidFmtNote($this->vidfmt));
		$this->printSlides();
		$this->printMedia("Software", $this->extsoftwares);
		$this->printLinks("Software", $this->softwares);
		$this->printMedia("Database", $this->extdbs);
		$this->printLinks("Database", $this->dbs);
		$this->printLinks("News Article", $this->articles);
		$this->printLinks("Related Project", $this->related);
//		$this->printFooter();
	}


	// PRIVATE FUNCTIONS
	// Pluralizes the word, if needed. The optional $plural is used if given for the plural form.
	function pluralize($arr, $title, $plural=""){
		$l = strlen($title);
		if (count($arr) > 1){
			if ($plural == ""){
				if ($title{$l-1} == "y"){
					$plural = substr($title, 0, $l-1) . "ies";
				} elseif ($title == "Software") {
					$plural = $title;
				} else {
					$plural = $title . "s";
				}
			}
			return $plural;
		}
		return $title;
	}

	// Prints text links under the given heading.
	// Each element of the array should be an array with [URL, Name].
	// This is for related projects, news articles, and software/databases.
	// If it detects that a given array has 4 elements, then it goes to printMedia() instead for that entry
	function printLinks($title, $arr){
		if (count($arr) == 0) return;
		$title = $this->pluralize($arr, $title);
		print ("
				<tr>
					<td align=\"left\">
						<h3 id=\"$title\">$title</h3>
						<blockquote>
				");
		foreach($arr as $val){
			$url = $val[0];
			$name = $val[1];
			$desc = $val[2];
			if ($desc != ""){
				$name = "<b>$name</b>";
			}
			if ($url != ""){
				$name = "<a href=\"$url\">$name</a>";
			}
			print ("<p>$name</p>$desc\n");
		}
		print ("
						</blockquote>
					</td>
				</tr>
				");
	}

	// Prints thumbnailed links with descriptions.
	// Each element of the array should be [url to item, path to thumbnail img, title of item, description of item]
	function printMedia($typename, $list, $note=""){
		if (count($list) == 0) return;
		$typename = $this->pluralize($list, $typename);
		print("
				<tr>
					<td align=\"left\">
						<h3 id=\"$typename\">$typename</h3>
				");
		if ($note != ""){
			print("
						<em>$note</em><br><br>
					");
		}
		print("
						<table border=\"0\" cellpadding=\"0\" cellspacing=\"6\">
				");
		foreach($list as $obj){
			$url = $obj[0];
			$thumb = $obj[1];
			$title = $obj[2];
			$desc = $obj[3];
			// initially, the url string is just the image
			$imgstring = "<img class=\"imgthumb\" src=\"$thumb\" border=\"1\" />";
			if ($url != ""){
				// if we have a valid url, then wrap the img string with it
				$imgstring = "<a href=\"$url\">$imgstring</a>";
			}
			print ("
						<tr>
							<td align=\"left\" valign=\"middle\" width=\"171\">$imgstring</td>
							<td align=\"left\" valign=\"middle\" width=\"10\">&nbsp;</td>
							<td align=\"left\" valign=\"middle\" width=\"512\">
								<strong>$title:</strong>
								<p class=\"mediadescription\">$desc</p>
							</td>
						</tr>
					");
		}
		print ("
						</table>
					</td>
				</tr>
				");
	}


	// Prints thumbnailed links without descriptions.
	// Each element of the array should be [url to item, path to thumbnail img, whether it is the new line]
	function printGallery($typename, $list){
		if (count($list) == 0) return;
		print("
				<tr>
					<td align=\"left\">
						<h3 id=\"$typename\">$typename</h3>
				");

      print("
		         <em>Some interactive gallery pages may require <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash</a> in order to view the images.</em><br>
            ");
		
		print("
						<table border=\"0\" cellpadding=\"0\" cellspacing=\"6\">
				");
			
		print("
		            <tr>
		      ");
		foreach($list as $obj){
			$url = $obj[0];
			$thumb = $obj[1];
			$nl = $obj[2];
			// initially, the url string is just the image
			$imgstring = "<img style=\"border:none\" src=\"$thumb\">";
			if ($url != ""){
				// if we have a valid url, then wrap the img string with it
				$imgstring = "<a href=\"$url\">$imgstring</a>";
			}
			
			if($nl ==1){
			   print("
			         </tr>
			         <tr>
			         ");
			}
			print ("
							<td align=\"left\" valign=\"middle\" width=\"10\">$imgstring</td>
					");
		}
		print("
		         </tr>
		      ");
		print ("
						</table>
					</td>
				</tr>
				");
	}


	// Prints a demo, using printMedia as the base function
	function printDemos(){
		foreach($this->demos as $demo){
			$demoname = $demo[0];
			$demoels = $demo[1];
			$this->printMedia($demoname, $demoels);
		}
	}

	// Prints the slides section.
	function printSlides(){
		if (count($this->slides) == 0) return;
		print("
				<tr>
					<td align=\"left\"><h3 id=\"Slides\">Slides</h3>
						<blockquote>
				");
		foreach($this->slides as $sl){
			$name = $sl[0];
			$novid = $sl[1];
			$withvid = $sl[2];
			print("<p><a href=\"$novid\">$name</a>");
			if ($withvid != ""){
				print(" &nbsp &nbsp <a href=\"$withvid\">With videos (zip file)</a>");
			}
			print ("</p>\n");
		}
		print("
						</blockquote>
					</td>
				</tr>
				");
	}

	// Prints the title, main image, and description
	function printBasic(){
		print ("
				<tr>
					<td><div align=\"center\"><font size=\"+2\">{$this->title}</font></div></td>
				</tr>");
		if ($this->titleimg_alt == "" && $this->titleimg == ""){
		} else {
			print("<tr>
						<td 
					");
			if ($this->titleimg_alt != ""){
				print (" background=\"{$this->titleimg_alt}\"");
			}
			print ("><center>");
			if ($this->titleimg != ""){
				print("<img src=\"{$this->titleimg}\" width=\"700\">");
			}
			print("</center></td></tr>");
		}
		if ($this->desc != ""){
			print("<tr><td>{$this->desc}</td></tr>");
		}
	}

	// Prints the list of publications
	function printPublications(){
		if (count($this->pubs) == 0) return;
		print ("
				<tr>
					<td><h3 id=\"Publications\">Publications</h3>
						<blockquote>
				");
		foreach($this->pubs as $pub){
//			if (is_int($pub)){
//				print_paperentry_byid($db, $pub, false);
//			} else {
//				print_paperentry_bytitle($db, $pub, false);
//			}
			print $pub;
			print "<br>";
		}
		print("
						</blockquote>
					</td>
				</tr>
				");
	}

	// prints arbitrary other HTML
	function printSections(){
		foreach($this->sections as $section){
			$name = $section[0];
			$data = $section[1];
			print("
					<tr>
						<td align=\"left\">
							<h3 id=\"$name\">$name</h3>
							$data
						</td>
					</tr>
			");
		}
	}

	// Prints the header of the page
	function printHeader(){
		$t = "Projects";
		$head = "top_thin.htm";
		print("
<html><head>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
	<title>RIDI | $t: {$this->title}</title>
	<meta name=\"description\" content=\"{$this->title}\">
	<meta name=\"keyword\" content=\"Computer Vision, RIDI, Information-Driven Imaging Lab, 
	Center for Imaging Science,
	Rochester Institute of Technology, $t, {$this->title}\">
	<link rel=\"stylesheet\" href=\"../projects.css\" type=\"text/css\" />
</head>

<body bgcolor=#ffffff>
	<table width=\"982\" height=\"100%\"  border=\"0\" cellpadding=0 cellspacing=0 align=\"center\">
		<tr>
			<td width=\"59\" rowspan=\"3\" align=\"left\" valign=\"baseline\" background=\"../bkgnd/left_side.gif\">&nbsp;</td>
			<td width=\"864\" height=\"42\" align=\"left\" valign=\"baseline\" background=\"../bkgnd/top_thin.gif\"></td>
			<td width=\"59\" rowspan=\"3\" align=\"left\" valign=\"baseline\" background=\"../bkgnd/right_side.gif\">&nbsp;</td>
		</tr>
		<tr>
			<td height=\"100%\" align=\"left\" valign=\"baseline\" bgcolor=\"#ffffff\">
			<div align=\"center\"><table width=\"709\"  border=\"0\" cellspacing=\"30\" cellpadding=\"0\">
		");
	}

	// Prints the footer of the page
	function printFooter(){
		print('
			<tr><td height="20"></td></tr>
			</table></div>
			</td>
		</tr>
		<tr>
			<td height="100" align="left" valign="baseline"><iframe src="bkgnd/footer_thin.htm" width="864" height="100" scrolling="no" frameborder="no" allowTransparency="true" name="viewcourse"></iframe></td>
		</tr>
	</table>
</body>
</html>
		');
	}
}

?>
