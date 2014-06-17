<!DOCTYPE html>
<!-- 

Dries007.net Website 2.0

Work under modified version of The MIT License:
(Changed "substantial portions of the Software" to "portions of the Software")

Copyright (c) 2012-2014 Dries K. aka Dries007

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
-->
<?
	Error_Reporting( E_ALL | E_STRICT );
	Ini_Set( 'display_errors', true );
	$start = microtime(true);
	
	date_default_timezone_set("Europe/Brussels");
	
	include("assets/php/service.class.php");
	include("assets/php/link.class.php");
	include("assets/php/serverstats.php");
	
	$services = array(
		new service("Website Http", 80, "http://dries007.net", "dries007.net"),
		new service("Website Https", 443, "https://dries007.net", "dries007.net"),
		new service("MySQL", 3306),
		new service("SSH", 22),
		new service("Webmin", 81, "http://webmin.dries007.net"),
		new service("Jenkins", 8080, "http://jenkins.dries007.net"),
		new service("Transmission", 9091, "http://transmission.dries007.net"),
    new service("Btsync", 8888, "http://btsync.dries007.net"),
    new service("ZNC", 6969, "http://znc.dries007.net"),
    new service("Maven", 8081, "http://maven.dries007.net")
	);
	
	$links = array(
		"Online profiles" => array(
			new link("Home", "http://dries007.net", "globe"),
			new link("Github", "https://github.com/dries007/", "github"),
			new link("Bitbucket", "https://bitbucket.com/dries007/", "bitbucket"),
			new link("Youtube", "https://www.youtube.com/user/driesk007/", "youtube-play"),
			new link("Twitter", "https://twitter.com/driesk007/", "twitter"),
			new link("Facebook", "https://www.facebook.com/driesk007/", "facebook-square"),
			new link("Email", "#contactModal", "envelope", "data-toggle=\"modal\"  data-target=\"#myModal\"")
		),
		"Links" => array(
			new link("dtools.net", "http://dtools.net", "wrench"),
			new link("Github report card", "http://osrc.dfm.io/dries007", "github"),
			new link("Downloads", "/downloads/", "download"),
      new link("Screenshots", "/screenshots/", "crosshairs"),
      new link("Geogebra", "/geogebra/", "superscript"),
			new link("Minecraft Capes", "/capes/", "bookmark"),
			new link("The Hacker Manifesto", "/manifesto/", "quote-left"),
			new link("Graph", "/graph/", "pencil")
		)
	);
	
	?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Dries007.net</title>
        <meta name="author" content="Dries007">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Le styles -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/bootswatch/3.0.3/slate/bootstrap.min.css" rel="stylesheet">
        
        <!-- Custom style for footer, centering of all text and the table -->
        <style type="text/css">
        table {
            table-layout: fixed;
        }
        table th, table td {
            overflow: hidden;
        }
		
        html, body {
	        height: 100%; text-align: center;
        }
	    
        #wrap {
          min-height: 100%;
          height: auto;
          margin: 0 auto -70px;
          padding: 0 0 70px;
        }
        
        #footer {
          height: 70px;
        }
        </style>
		
	</head>
	<body>
		<div class="container container-narrow" id="wrap">
			<div class="row" style="padding-top: 30px;">
			    <p><img src="assets/img/dries007.png" style="height: 80px;" class="img-rounded" /></p>
			</div>
			<div>
				<!-- Nav sidebar -->
				<div class="col-sm-3">
                    <? foreach ($links as $catName => $cat) {?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <? echo $catName;  ?>
                        </div>
                        <div class="list-group">
    						<?foreach ($cat as $link) $link->makeLink(); ?>
    					</div>
    				</div>
    			    <? } ?>
				</div>
				<!-- Services -->
				<div class="col-sm-6">
					<div class="panel panel-default">
					    <div class="panel-heading">
					        Services
					    </div>
					    <div class="panel-body">
    					<table class="table table-hover table-condensed">
    						<thead>
    							<th style="text-align: right;width: 50%">Service</td>
    							<th style="text-align: left;">Status</td>
    						</thead>
                <thead>
    						<? foreach($services as $service){ ?>
    						<tr>
    							<td style="text-align: right;"><? echo $service->name; ?></td>
    							<td style="text-align: left;"><? echo $service->makeButton(); ?></td>
    						</tr>
    				    	<?}?>
    				    </table>
    				    </div>
          </div>
				</div>
				<!-- Server stats -->
				<div class="col-sm-3">
				    <div class="panel panel-default">
				        <div class="panel-heading">
				            System load
				        </div>
				        <div class="panel-body">
				            <div><span id="sys1minT"></span>
				                <div class="progress progress-striped active">
				                    <div class="progress-bar progress-bar-warning" style="width: 100%" id="sys1minPB">
				                    </div>
			                    </div>
				            </div>
				            <div><span id="sys5minT"></span>
				                <div class="progress progress-striped active">
				                    <div class="progress-bar progress-bar-warning" style="width: 100%" id="sys5minPB">
				                    </div>
			                    </div>
				            </div>
				            <div><span id="sys15minT"></span>
				                <div class="progress progress-striped active">
				                    <div class="progress-bar progress-bar-warning" style="width: 100%" id="sys15minPB">
				                    </div>
			                    </div>
				            </div>
				        </div>
				    </div>
				    <div class="panel panel-default">
				        <div class="panel-heading">
				            RAM Usage
				        </div>
				        <div class="panel-body">
				            <div><span id="ramT"></span>
				                <div class="progress progress-striped active">
				                    <div class="progress-bar progress-bar-warning" style="width: 100%" id="ramPB">
				                    </div>
			                    </div>
				            </div>
				        </div>
			        </div>
			        <div class="panel panel-default">
				        <div class="panel-heading">
				            Disk space
				        </div>
				        <div class="panel-body">
				            <div><span id="diskRT"></span>
				                <div class="progress progress-striped active">
				                    <div class="progress-bar progress-bar-warning" style="width: 100%" id="diskRPB">
				                    </div>
			                    </div>
				            </div>
				            <div><span id="diskDT"></span>
				                <div class="progress progress-striped active">
				                    <div class="progress-bar progress-bar-warning" style="width: 100%" id="diskDPB">
				                    </div>
			                    </div>
				            </div>
				        </div>
			        </div>
				</div>
			</div>
		</div>
		<!-- Footer -->
		<div id="footer">
			<div class="container">
				<p class="muted credit">
					<a href="http://dries007.net">&copy; Dries007</a> <? echo date("Y")?>. Website source available <a href="https://github.com/dries007/Dries007.net">here.</a><br>
					Oh and I &lt;3 <a href="https://koding.com/R/dries007"> Koding</a>, thé cloud development environment.<br>
					Built with 
					<a href="http://getbootstrap.com/">Bootstrap</a>,
					<a href="https://fortawesome.github.io/Font-Awesome/">Font Awesome</a>,
					<a href="http://bootswatch.com/">Bootswatch</a> &amp;
					<a href="http://www.bootstrapcdn.com/">Bootstrap CDN</a> in 
					<? $end = microtime(true); echo round(($end - $start), 4);?> sec.
				</p>
			</div>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Contact by email</h4>
              </div>
              <div class="modal-body">
                <p>I prefer to be contacted through project related channels but, if its really necessary, you can mail me at the address below.</p>
                <img src="assets/img/contact.png" style="width: 250px;"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
		<!-- Contact modal --
		<div id="contactModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Contact info</h3>
			</div>
			<div class="modal-body">
				<p>I prefer to be contacted through project related channels but, if its really necessary, you can mail me at the address below.<p>
				<img src="assets/img/contact.png" style="width: 150px;"/>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div>
		<!-- End Contact modal -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function refreshBars()
            {
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        var result = JSON.parse(xmlhttp.responseText);
                        // LOAD 1 min
                        document.getElementById('sys1minT').innerHTML  = "1 min: " + result["load"]["1 min"] + "%";
                        document.getElementById('sys1minPB').style.width  = result["load"]["1 min"] + "%";
                        // LOAD 5 min
                        document.getElementById('sys5minT').innerHTML  = "5 min: " + result["load"]["5 min"] + "%";
                        document.getElementById('sys5minPB').style.width  = result["load"]["5 min"] + "%";
                        // LOAD 15 min
                        document.getElementById('sys15minT').innerHTML  = "15 min: " + result["load"]["15 min"] + "%";
                        document.getElementById('sys15minPB').style.width  = result["load"]["15 min"] + "%";
                        
                        // RAM
                        document.getElementById('ramT').innerHTML  = result["ram"] + "%";
                        document.getElementById('ramPB').style.width  = result["ram"] + "%";
                        
                        // DISK Root
                        document.getElementById('diskRT').innerHTML  = "Root: " + result["disk"]["Root"] + "%";
                        document.getElementById('diskRPB').style.width  = result["disk"]["Root"] + "%";
                        
                        // DISK Data
                        document.getElementById('diskDT').innerHTML  = "Data: " + result["disk"]["Data"] + "%";
                        document.getElementById('diskDPB').style.width  = result["disk"]["Data"] + "%";
                    }
                }
                xmlhttp.open("GET", "assets/php/serverstats.php?progressbars", false );
                xmlhttp.send();
            }
            
            refreshBars();
            
            window.setInterval(function(){
              refreshBars();
            }, 5000);
        </script>
        <script type="text/javascript">
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-11627969-4']);
          _gaq.push(['_setDomainName', 'dries007.net']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
      </script>
	</body>
</html>