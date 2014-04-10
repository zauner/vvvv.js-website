<h1 id="tagline" class="box">
  The visual programming language <a href="http://www.vvvv.org" target="_blank">VVVV</a> brought to your web browser.
</h1>
<div id="abstract" class="box">
  <p>
    VVVV.js is a great toolkit for prototyping and developing rich data visualisation, advanced user interfaces, games, and more &mdash; all by connecting nodes, spreading slices and
    letting the dafa flow. From simple 2D charts to complex 3D animations: the possibilities grow with your patching skills.
  </p>
</div>
<div id="downloads" class="box">
  <a id="try-lab" class="button" href="http://lab.vvvvjs.com"><span class="link_h">Try it</span><span class="link_descr">in the VVVV.js Lab</span></a>
  <a id="download" class="button" href="/download?layout=false"><span class="link_h">Download</span><span class="link_descr">Version 1.0</span></a>
</div>
<div id="features" class="box">
  <h2>Features</h2>
  <p>
    <strong>VVVV.js is fun to play with, yet it's more than a toy.</strong> Rather than being a standalone web application, it comes with a development workflow designed
    to integrate VVVV.js with your web application and enhance it in an unobtrusive way.
  </p>
  <div class="feature">
    <div class="feature-teaser"><img src="/assets/feature_editor.png"/></div>
    <h3>In-Browser Patch Editor</h3>
    <p>
      Using the patch editor you can work on your patches and see the results immediatly. This kind of "real-time coding" is what makes VVVV (and VVVV.js) fun and effective. The best thing: it runs
      entirely in your browser, no additional software needed.
    </p>
  </div>
  <div class="feature">
    <div class="feature-teaser"><img src="/assets/feature_subpatches.png"/></div>
    <h3>Subpatches</h3>
    <p>
      Once you are caught in a patching spree, things can get messy after a while. In order to create well-structured applications, VVVV.js supports VVVV's subpatch concept, which allows
      you to box patches into smaller, reusable modules.
    </p>
  </div>
  <div class="feature">
    <div class="feature-teaser"><img src="/assets/feature_graphics.png"/></div>
    <h3>Graphics</h3>
    <p>
      Besides covering the better part of the HTML5 Canvas API, VVVV.js is cool with WebGL: Meshes, shaders, blend modes, multi-pass rendering, and whatnot. It even comes with a built-in Shader code editor, which you can use to (again) real-time code
      shader nodes.
    </p>
  </div>
  <div class="feature">
    <div class="feature-teaser"><img src="/assets/feature_dom_interface.png"/></div>
    <h3>DOM Interface</h3>
    <p>
      VVVV.js is designed to be part of a website and interact with it. A patch can plant Canvas and WebGL output anywhere on the page, query and manipulate DOM elements, and react to events.
    </p>
  </div>
  <div class="feature">
    <div class="feature-teaser"><img src="/assets/feature_vvvv_compatibility.png"/></div>
    <h3>VVVV Compatibility</h3>
    <p>
      All the concepts, best practices, tricks and hacks common in VVVV also apply to VVVV.js. You can even copy and paste from and to classic VVVV, as both use the same XML format under the hood.
      If you already know VVVV, you know VVVV.js. While learning VVVV.js, you also learn VVVV.
    </p>
  </div>
  <div class="feature">
    <div class="feature-teaser"><img src="/assets/feature_packages.png"/></div>
    <h3>Packaging</h3>
    <p>
      VVVV.js comes with a constantly improving mechanism to compile your patches in order to decrease loading time and make it fit for production.
    </p>
  </div>
</div>
<div class="clear"></div>
<div id="gallery">
  <div class="box">
    <h2>Examples</h2>
    <p>
      Understanding how VVVV.js works is best done by viewing examples. Thanks to the way VVVV.js is designed and its built-in patch editor, patches can be
      explored <em>and</em> modified easily and effortless. A good starting point is the VVVV.js lab with a variety of experiments created by developers who already
      had a go on VVVV.js.
      <br/><br/>
      <a class="button" href="http://lab.vvvvjs.com">Go to the Lab</a>
    </p>
    <div class="gallery-item-list">
      <?= contents('gallery') ?>
    </div>
  </div>
  <div class="clear"></div>
</div>
<div id="getting-started" class="box">
  <h2>Getting Started</h2>
  <p>
    There are a lot of different ways to integrate VVVV.js with your project, have a look at the <a href="../docs">Docs Section</a> to read everything about it. However,
    getting a first VVVV.js patch up and running takes you four steps: 
  </p>
  <ol>
    <li>
      <b>Download VVVV.js and extract it</b> (or clone the github repo) to the location in your project where you keep your JavaScript. Here, we are using <code>javascripts/vvvv_js</code>. Some webservers seem to have problems with
      dots in directory names, so make sure to really rename the 'vvvv.js' from the archive to 'vvvv_js'.
    </li>
    <li>
      <b>Create a new patch.</b> You do so by just creating an empty .v4p file at the location you'd like to have it, for example, <code>assets/patches/mypatch.v4p</code>.
    </li>
    <li>
      <b>Include VVVV.js and the mypatch.v4p file</b> in your website (e.g. index.html) like this:
      <div class="code"><?php
      $code = <<<EOT
<head>
  ...
  <script language="JavaScript" src="javascripts/vvvv_js/lib/jquery/jquery-1.8.2.min.js"></script> 
  ~~<script language="JavaScript" src="javascripts/vvvv_js/vvvv.js"></script>
  <script language="VVVV" src="assets/patches/mypatch.v4p"></script>~~
  <script language="JavaScript">
    $(document).ready(function() {
      ~~VVVV.init("javascripts/vvvv_js/", 'full', function() {~~
        console.log('VVVV.js initialized');
      });
    });
  </script>
  ...
</head>
      
EOT;
      echo format_code($code);

      
?>    </div>
    </li>
    <li>
      <b>Launch the Editor</b> by appending <code>#edit/assets/patches/mypatch.v4p</code> in the address bar. The editor will open in a new popup, so make sure you allow them for
      this page. You see what we did here? Here is another example: <em>this</em> websites header animation is in the file <code>header_animation.v4p</code> in the <code>patches</code> directory. So, yes, you 
      can edit it by appending <code>#edit/patches/header_animation.v4p</code> in the address bar of this window.
    </li>
  </ol>
</div>
