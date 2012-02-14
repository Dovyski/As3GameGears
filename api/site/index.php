
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>As3GameGears API Usage</title>
    <meta name="title" content="As3GameGears API Usage">    
    <meta name="description" content="Usage information for As3GameGears API">
    <meta name="author" content="Fernando Bevilacqua">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- Le SEO -->
    <link rel="canonical" href="http://api.as3gamegears.com/1.0/usage/" />

    <!-- Le styles -->
	<link href='http://fonts.googleapis.com/css?family=Cabin+Sketch' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="style.css">

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" type="image/x-icon" href="img/ico/favicon.ico">
    <link rel="apple-touch-icon" href="img/ico/agg-apple-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/ico/agg-apple-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/ico/agg-apple-114x114.png">
    
	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  //_gaq.push(['_setAccount', 'UA-10567379-5']);
	  //_gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
  </head>

  <body>
	<a href="http://github.com/Dovyski/As3GameGears" target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0;" src="http://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub" /></a>
	
    <!-- Masthead (blueprinty thing)
    ================================================== -->
    <header class="jumbotron masthead" id="overview">
      <div class="inner">
        <div class="container">
          <a href="/"><img src="img/header-image-simple.png" title="As3GameGears" border="0" /></a>
        </div><!-- /container -->
      </div>
    </header>

    <?php 
    	if(!isset($_GET['version'], $_GET['method'])) {
    ?>
    
		    <div class="container">
			    <section id="about">
				    <div class="page-header">
					    <h1>About <small>Some words about the API</small></h1>
					</div>
					<div class="row">
						<div class="span16">
						    <p>This is the As3GameGears API version <code>1.0</code>. Below you can find a list of all available methods. The term <code>slug</code> refers to the "non-spaced" version of a name. E.g. a category named <code>Augmented Reality</code> has as its slug <code>augmented-reality</code>. Every item, category and license on the site are indexed by their slug.</p>
						    <p>
							    The API accepts different return types, such as <code>JSON</code> and <code>XML</code>. In order to specify a return type, use the syntax <code>/method.RETURN_TYPE/</code>. If no return type is specified, the default is <code>JSON</code>. E.g: <br /><br />
							    <code>http://api.as3gamegears.com/1.0/items.xml</code><br />
							    <code>http://api.as3gamegears.com/1.0/items.xml/param</code><br />
							    <code>http://api.as3gamegears.com/1.0/items.json/param?foo=bar</code><br />
							    <code>http://api.as3gamegears.com/1.0/items</code> (defaults to <code>JSON</code>)
					    	</p>
					    </div>
				    </div><!-- /row -->
			    </section>
		    
			    <section id="methods">
				    <div class="page-header">
						<h1>Methods <small>Usage information for all available methods</small></h1>
				    </div>
				    <div class="row">
						<div class="span15">
					    This is the list of available methods. Click on any method to get further information such as params and return structure.<br /><br />
					    <h2>Items</h2>
					    <p class="method-link"><a href="./items">/items</a> - list all items.</p>
					    <p class="method-link"><a href="./items">/items/{category-slug}</a> - list the items of a specific category.</p>
					    <p class="method-link"><a href="./item">/item</a> - get information about a specific item.</p>
					    
					    <h2>Search</h2>
					    <p class="method-link"><a href="./search" target="_blank">/search</a> - search for items using an arbitrary text query.</p>
					    
					    <h2>Extra</h2>
					    <p class="method-link"><a href="./categories">/categories</a> - list all categories.</p>
					    <p class="method-link"><a href="./categories">/categories/{slug}</a> - get information about a specific category.</p>
					    <p class="method-link"><a href="./licenses">/licenses</a> - list the licenses used by all items.</p>
						<p class="method-link"><a href="./licenses">/licenses/{slug}</a> - get information about a specific license.</p>
					    </div>
				    </div><!-- /row -->
			    </section>
		    </div><!-- /container -->
    <?php
    	} else {

			$aVersions 	= array('1.0');
			$aMethods	= array('item', 'items', 'licenses', 'search', 'categories');
		
			$aVersion 	= isset($_GET['version']) && in_array($_GET['version'], $aVersions) ? $_GET['version'] : '';
			$aMethod 	= isset($_GET['method']) ? strtolower($_GET['method']) : '';
			$aMethod 	= in_array($aMethod, $aMethods) ? $aMethod : '';
			$aFile		= dirname(__FILE__) . './docs/' . $aVersion .'-'. $aMethod . '.html';
			
			if(!empty($aMethod)) {
	?>
				<div class="container">
					<section id="description">
						<div class="page-header">
		        			<p class="pull-right"><a href="./">Back to methods</a></p>
							<h1>Usage of <?php echo $aMethod;?></h1>
						</div>
						<div class="row">
							<div class="span16">
								<?php 
									$aContent = @file_get_contents($aFile);
									if($aContent !== false) {
										echo $aContent;
										
									} else {
										echo 'Oops, no description available for this method now. Sorry!'; 
									}
								?>
							</div>
						</div><!-- /row -->
					</section>
				</div><!-- /container -->
	
	<?php
			} else {
	?>
				<div class="container">
					<section id="unknown">
						<div class="page-header">
							<p class="pull-right"><a href="./">Back to methods</a></p>
							<h1>Meh, unknown method</h1>
						</div>
						<div class="row"> 
							<div class="span12">
								<p>It looks like you are trying to view an unknown method called <strong><?php echo htmlspecialchars($_GET['method']); ?></strong>. If you are sure this is the droid your are looking for, please <a href="http://twitter.com/as3gamegears" target="_blank">drop me a tweet</a> so I can fix the problem.</p>
								<p>You can check again the <a href="./">methods list</a> to find the method.</p>
							</div>
						</div><!-- /row -->
					</section>
				</div><!-- /container -->
	<?php
			}
		}
	?>    

    <footer class="footer">
      <div class="container">
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>Visit <a href="http://as3gamegears.com" target="_blank">As3GameGears.com</a> - Boost your tools!</p>
      </div>
    </footer>
  </body>
</html>
