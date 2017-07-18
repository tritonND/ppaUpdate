<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connections.php"); ?>
<?php
if(isset($_POST['login'])){
		$login = trim(strip_tags($_POST['login']));
		$profile = "SELECT * FROM user_info WHERE login = '".$login."'";
		$result = mysqli_query($con,$profile)
	or die(mysqli_error($con));
		if(mysqli_num_rows($result)<1){
			header('location:index.php');}else{
			$row = mysqli_fetch_array($result);
			$_SESSION['log'] = $row['login'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['name'] = $row['surname']." ".$row['othernames'];
			$_SESSION['message'] = "Login to proceed...";
			
// Display successful login in page 

        if(isset($_POST['sbmt'])){
	if(isset($_POST['password']) && isset($_POST['acc_number'])){	
	$_SESSION['password'] = trim(strip_tags($_POST['password']));
	$_SESSION['acc_number'] = trim(strip_tags($_POST['acc_number']));
	
	$query="SELECT * FROM user_info
	WHERE 
	login = '".$_SESSION['log']."'
	&& password = '".$_SESSION['password']."' 
	&& acc_number = '".$_SESSION['acc_number']."'";
	
 $result = mysqli_query($con,$query)
	or die(mysqli_error($con));
if(mysqli_num_rows($result) != 0){
$_SESSION['welcome'] ="Bank account details";
header('location:my_profile.php');
}else{
	$_SESSION['message'] = "<span style='color:red;'>Ivalid login details supplied</span>";
	
        }}}
 ?>
<html>
<head>
<style>
.top_bar{
	position:absolute;
	top:80px;
	left:0;
	height:20px;
	width:100%;
	background:#7B031F;
	border:none;
	border-bottom:2px double #FF3300;
	}
	.tag{	position:absolute;
	top:150px;
	left:39%;
	height:20px;
	width:700px;
	border:none;
	font-family:Calibri;
	font-size:.8em;
	font-weight:800;
	color:#666
	
	}
.app_infor{
	position:absolute;
	border:none;
	border-top:1px dashed #999999;
	width:700px;
	height:100px;
	top:520;
	left:25%;
	padding-top:10px;
	text-align:center;
	font-family:Calibri;
	font-size:.8em;
	color:#666;
	}
.app_infor a {
	color:#666;}
</style>
<link rel="stylesheet" type="text/css" href="./scripts/first_page.css">
<style>
.hide{
	display:none;
	position:relative;
	border:none;
	color:#000;
}
.hide:hover{
	display:block;
	position:relative;
	border:none;
	color:#000;
}

.input{
	position:relative;
	border:none;
	color:#CCC;
	background-color:transparent;
	width:1px;
}
.input:hover{
	position:relative;
	border:none;
	color:#000;
	background-color:transparent;
	width:80px;
}
</style>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/javascript">var _prum={id:"52699603abe53d3338000000"};var PRUM_EPISODES=PRUM_EPISODES||{};PRUM_EPISODES.q=[];PRUM_EPISODES.mark=function(b,a){PRUM_EPISODES.q.push(["mark",b,a||new Date().getTime()])};PRUM_EPISODES.measure=function(b,a,b){PRUM_EPISODES.q.push(["measure",b,a,b||new Date().getTime()])};PRUM_EPISODES.done=function(a){PRUM_EPISODES.q.push(["done",a])};PRUM_EPISODES.mark("firstbyte");(function(){var b=document.getElementsByTagName("script")[0];var a=document.createElement("script");a.type="text/javascript";a.async=true;a.charset="UTF-8";a.src="../rum-static.pingdom.net/prum.min.js";b.parentNode.insertBefore(a,b)})();</script>
<link rel="shortcut icon" href="sites/default/files/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="shortlink" href="node/7.html" />
<link rel="dns-prefetch" href="index.php" />
<meta name="Generator" content="Drupal 7 (http://drupal.org)" />
<meta http-equiv="x-dns-prefetch-control" content="on" />
<link rel="canonical" href="index.php" />
  <title> LOGIN |  </title>
  <link type="text/css" rel="stylesheet" href="sites/default/files/cdn/css/http/css_ierRin62iohLSeNQnrp2Mt_5yJQfW4stO4mLG7gu8UQ.css" media="all" />
<link type="text/css" rel="stylesheet" href="sites/default/files/cdn/css/http/css_n7aK8s-ciXhQyEYWNOJtISbWxtxQiQvnD-N_xWUtD5A.css" media="all" />
<link type="text/css" rel="stylesheet" href="sites/default/files/cdn/css/http/css_x5sjOTVEvcmMDr5AqwnRQ8dmYU58YjUiklF-gZxraNY.css" media="all" />
<link type="text/css" rel="stylesheet" href="sites/default/files/cdn/css/http/css_G-CqGNRbNmqdwnT08vf339s3MmKs6xGb9PhB4HweOJU.css" media="all" />
<link type="text/css" rel="stylesheet" href="sites/default/files/cdn/css/http/css_4Du2KLEIyiiOTaxRwvhot3TUURwDtYazkr6ymit6viI.css" media="print" />
  <script type="text/javascript" src="sites/default/files/js/js_xAPl0qIk9eowy_iS9tNkCWXLUVoat94SQT48UBCFkyQ.js"></script>
<script type="text/javascript" src="sites/default/files/js/js_avMSSzo0H5jWrMusSjW988zMLocrpTP0TwKDSUZQKt8.js"></script>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
var _gaq = _gaq || [];_gaq.push(["_setAccount", "UA-30094235-1"]);_gaq.push(["_trackPageview"]);(function() {var ga = document.createElement("script");ga.type = "text/javascript";ga.async = true;ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(ga, s);})();
//--><!]]>
</script>
<script type="text/javascript" src="sites/default/files/js/js_69Pvey-PSrstgpGf0lAQ0fjNw9DkcbKYmmZ-mVoGZ4s.js"></script>
<script type="text/javascript" src="sites/default/files/js/js_4AmrGiMh6YHDkkupwRIbCZ3QIXaD7WyWjUTFuxSZzPI.js"></script>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
jQuery.extend(Drupal.settings, {"basePath":"\/","pathPrefix":"","ajaxPageState":{"theme":"firstmerchants","theme_token":"ycBCMyeEXN93o99xHwluSQN1E-7_JrLNJyslz7NVHJs","js":{"misc\/jquery.js":1,"misc\/jquery.once.js":1,"misc\/drupal.js":1,"sites\/all\/modules\/calculators\/calculators.js":1,"sites\/all\/modules\/elf\/js\/elf.js":1,"sites\/all\/modules\/panels\/js\/panels.js":1,"sites\/all\/modules\/subnav\/listCollapse.js":1,"sites\/all\/modules\/subnav\/subnav.js":1,"sites\/all\/modules\/muchomenu\/js\/muchomenu.js":1,"sites\/all\/modules\/jcarousel\/js\/jquery.jcarousel.min.js":1,"sites\/all\/modules\/jcarousel\/js\/jcarousel.js":1,"sites\/all\/modules\/google_analytics\/googleanalytics.js":1,"0":1,"sites\/all\/modules\/rotating_banner\/includes\/jquery.easing.js":1,"sites\/all\/modules\/rotating_banner\/includes\/jquery.cycle.js":1,"sites\/all\/modules\/rotating_banner\/rotating_banner.js":1,"sites\/all\/themes\/firstmerchants\/pm_fp.js":1,"sites\/all\/themes\/firstmerchants\/login_box.js":1,"sites\/all\/themes\/firstmerchants\/jquery.cookie.js":1,"sites\/all\/themes\/firstmerchants\/captcha.js":1},"css":{"modules\/system\/system.base.css":1,"modules\/system\/system.menus.css":1,"modules\/system\/system.messages.css":1,"modules\/system\/system.theme.css":1,"modules\/comment\/comment.css":1,"sites\/all\/modules\/date\/date_api\/date.css":1,"sites\/all\/modules\/date\/date_popup\/themes\/datepicker.1.7.css":1,"modules\/field\/theme\/field.css":1,"modules\/node\/node.css":1,"modules\/search\/search.css":1,"modules\/user\/user.css":1,"sites\/all\/modules\/views\/css\/views.css":1,"sites\/all\/modules\/calculators\/calculators.css":1,"sites\/all\/modules\/ctools\/css\/ctools.css":1,"sites\/all\/modules\/elf\/css\/elf.css":1,"sites\/all\/modules\/panels\/css\/panels.css":1,"sites\/all\/modules\/subnav\/subnav.css":1,"sites\/all\/modules\/muchomenu\/css\/muchomenu.css":1,"sites\/all\/modules\/muchomenu\/css\/muchomenu-default-style.css":1,"public:\/\/ctools\/css\/ae0ed7ef7ddb71a6b58d249e6cb38fe1.css":1,"sites\/all\/modules\/panels\/plugins\/layouts\/flexible\/flexible.css":1,"sites\/all\/modules\/jcarousel\/skins\/fmc\/jcarousel-fmc.css":1,"sites\/all\/modules\/rotating_banner\/rotating_banner.css":1,"sites\/all\/themes\/firstmerchants\/nh_style.css":1,"sites\/all\/themes\/firstmerchants\/jobfairform.css":1,"sites\/all\/themes\/firstmerchants\/print.css":1}},"jcarousel":{"ajaxPath":"\/jcarousel\/ajax\/views","carousels":{"jcarousel-dom-1":{"view_options":{"view_args":"","view_path":"node\/7","view_base_path":null,"view_display_id":"block","view_name":"featured_news","jcarousel_dom_id":1},"wrap":"circular","skin":"fmc","autoPause":1,"start":1,"selector":".jcarousel-dom-1"}}},"muchomenu":{"animationEffect":"","animationSpeed":""},"rotatingBanners":{"rotating-banner-1":{"fluid":"0","width":"700","height":"295","cycle":{"fx":"scrollLeft","auto_slide":1,"timeout":"8000"},"controls":"numbers"}},"googleanalytics":{"trackOutbound":1,"trackMailto":1,"trackDownload":1,"trackDownloadExtensions":"7z|aac|arc|arj|asf|asx|avi|bin|csv|doc|exe|flv|gif|gz|gzip|hqx|jar|jpe?g|js|mp(2|3|4|e?g)|mov(ie)?|msi|msp|pdf|phps|png|ppt|qtm?|ra(m|r)?|sea|sit|tar|tgz|torrent|txt|wav|wma|wmv|wpd|xls|xml|z|zip"}});
//--><!]]>
</script>
</head>

<body>

<div class=" top_bar">
</div>
<div class="partition" style=" position:absolute; top:200px; left:50px; height:300px; width:300px; border:none; border-right:1px dashed #999999;">
<span class="tag" style="position:relative; top:100; left:0; font-size:1.1em; color:#33586B;"> ...Welcome, <?php echo $_SESSION['name'] ?>.<br> You are a step away from your Account Area.<br> Complete the following fields accordingly, to proceed: </span>
</div>
<div class="content" style="margin-left:150px;">
    <p><a href="index.php" itemprop="url"><img alt="" itemprop="logo" src="sites/default/files/images/Logos/logo-FMCCorp-v2.png" style="width: 292px; height: 61px; border-width: 0pt; border-style: solid;" /></a></p>
  </div>
<div class="app_infor"> 
  <p>Please enter your password and designated account number. <br> 
  Note:  Your Phone number (if required) is expected in the exact format in which you have supplied to it during account creation.
    <span style=" display:block; font-size:1.2em; margin-top:10px;">All rights Reserved:  Nationwide Bank &copy; 2015. </span>
  <br>
</div>
<div class="box"><div class="inner_1"><span class="top_text">APPLICATION ACCESS</span></div>
<div class="welcome"><?php if(isset($_SESSION['message'])) echo $_SESSION['message']; ?><br></div>
<div class="form_container">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
<span class="label">PASSWORD:</span> <input class="text" type="password" name="password" placeholder="Enter your Card PASSWORD" style="font-size:1.1em;"/>
<span class="label">ACCOUNT NUMBER:</span> <input class="text"  type="text" name="acc_number" placeholder="Enter your Card ACCOUNT" style="font-size:1.1em;" />
<input type="submit" name="sbmt" class="btn" id="access" value="PROCEED"/>
</form>
    <span class="cpanel" style="border-radius:5px; padding:5px; float:right; font-family:Calibri;"><a href="logout.php" style="color:#FFF; text-decoration:none;">Logout</a></span><br>

</div>
</div>
</body>
</html>
	<?php	
		}
	}
        ?>
