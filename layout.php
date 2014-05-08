<html>
  <head>
    <title>VVVV.js - Visual Web Client Programming</title>
    <meta charset="UTF-8">
    <link href='http://fonts.googleapis.com/css?family=Duru+Sans|Carme' rel='stylesheet' type='text/css'>
    <link type="text/css" rel="stylesheet" href="/main.css"/>
    <link type="text/css" rel="stylesheet" href="/fonts/style.css"/>
    <link type="text/css" rel="stylesheet" href="/lib/magnific-popup/magnific-popup.css"/>
    <link type="text/css" rel="stylesheet" href="/lib/dragdealer-master/src/dragdealer.css"/>
    <link rel="stylesheet" type="text/css" href="/vvvv_js/vvvviewer/vvvv.css"/>
    <script language="JavaScript" src="/vvvv_js/lib/jquery/jquery-1.8.2.min.js"></script>
    <script language="JavaScript" src="/vvvv_js/lib/underscore/underscore-min.js"></script>
    <script language="JavaScript" src="/vvvv_js/lib/glMatrix-0.9.5.min.js"></script>
    <script language="JavaScript" src="/vvvv_js/lib/d3-v1.14/d3.min.js"></script>
    <script language="JavaScript" src="/vvvv_js/vvvv.min.js"></script>
    <script language="JavaScript" src="/main.js"></script>
    <script language="VVVV" src="/patches/header_animation.v4p"></script>
    <script language="JavaScript" src="/lib/magnific-popup/magnific-popup.min.js"></script>
    <script language="JavaScript" src="/lib/dragdealer-master/src/dragdealer.js"></script>
    <script src="/lib/paypal-button/paypal-button.min.js?merchant=vvvvjs@vvvvjs.com"></script>
  </head>
  <body>
    <div id="top-bar" class="box">
      <div id="page-title">VVVV.js</div>
      <ul id="menu">
        <li><a href="/start">Start</a></li>
        <li><a href="/blog">Blog</a></li>
        <li><a href="/learn">Learning</a></li>
        <li><a href="/vvvv_js/api/" class="external">API</a></li>
        <li><a href="/contribute">Contribute</a></li>
      </ul>
    </div>
    <div id="header" class="box">
      <div class="no-webgl">
        <img src="assets/fallback_header1.png"/>
        <div class="fallback-message"><span>No Spinning? No Morphing?</span> Your browser does not support WebGL. <a href="http://get.webgl.org" target="_blank">Find out more.</a></div>
      </div>
      <div id="social-links">
        <div class="social-group facebook">
          <div class="icon icon-facebook"></div>
          <div class="social-actions-wrapper">
            <div class="social-actions">
              <a class="first last" href="http://www.facebook.com/sharer.php?u=http://www.vvvvjs.com" target="_blank">Share on Facebook</a>
            </div>
          </div>
        </div>
        <div class="social-group twitter">
          <div class="icon icon-twitter"></div>
          <div class="social-actions-wrapper">
            <div class="social-actions">
              <a class="first" href="https://twitter.com/vvvv_js" target="_blank">Follow @vvvv_js</a><a class="last" href="https://twitter.com/share?url=http://www.vvvvjs.com" target="_blank">Tweet</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="contents">
      <?= contents($GLOBALS['PAGE']) ?>
    </div>
    <div id="footer">
      <div class="box">
        <div id="background"></div>
        <div class="two-column">
          <a href="http://github.com/zauner/vvvv.js">Github</a><br/>
          <a href="https://groups.google.com/d/forum/vvvvjs">Google Groups</a><br/>
          <a href="http://www.twitter.com/vvvv_js">Twitter</a><br/>
          <a href="https://flattr.com/thing/1972082/zaunervvvv-js-on-GitHub">Flattr</a>
        </div>
        <div class="two-column" style="text-align:right">
          This is a <a href="http://quasipartikel.at">Quasipartikel</a> Quasiproject<br/>
          &copy; <?= date('Y') ?> VVVV.js Project<br/>
          <a class="internal" href="/imprint">Imprint &amp; Contact</a>
        </div>
      </div>
    </div>
    
    <!-- Start of StatCounter Code -->
    <script type="text/javascript">
    var sc_project=7067416; 
    var sc_invisible=1; 
    var sc_security="cfe91c6a"; 
    </script>
    
    <script type="text/javascript"
    src="http://www.statcounter.com/counter/counter.js"></script><noscript><div
    class="statcounter"><a title="free web stats"
    href="http://statcounter.com/" target="_blank"><img
    class="statcounter"
    src="http://c.statcounter.com/7067416/0/cfe91c6a/1/"
    alt="free web stats" ></a></div></noscript>
    <!-- End of StatCounter Code -->
  </body>
</html>