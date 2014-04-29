In the [previous guide](/learn/patching) you learned how VVVV.js' development parts and runtime parts work together, and got to know
the patch editor. This guide explains how to make VVVV.js part of your website &mdash; how to include, run, embed and interact with VVVV.js.

### Including the VVVV.js scripts

Once [downloaded](/start) or [forked](http://github.com/zauner/vvvv.js) VVVV.js, copy it into you project's location where you keep your
JavaScript libraries. For this guide, we assume the following file structure:

<div class="code">my_project
  +- index.html
  +- lib
     +- vvvv_js
  +- assets
     +- patches
        +- my_patch.v4p</div>

According to this, VVVV.js is located at `my_project/lib/vvvv_js`. We renamed the `vvvv.js` directory coming from the archive to
`vvvv_js`, as some web servers seem to have problems with dot characters in directory names.

`my_project/index.html` is the site which acts as host for the VVVV.js patch. We start with a basic HTML skeleton, and the tags necessary to
include the VVVV.js library:

<div class="code">&lt;html&gt;
  &lt;head&gt;
    &lt;title&gt;My VVVV.js project&lt;/title&gt;
    <span class="highlight">&lt;script language="JavaScript" src="lib/vvvv_js/lib/jquery/jquery-1.8.2.min.js"&gt;&lt;/script&gt;
    &lt;script language="JavaScript" src="lib/vvvv_js/vvvv.js"&gt;&lt;/script&gt;
    &lt;link rel="stylesheet" href="lib/vvvv_js/vvvviewer/vvvv.css"&gt;&lt;/script&gt;</span>
  &lt;/head&gt;
  &lt;body&gt;
  nothing here ...
  &lt;/body&gt;
&lt;/html&gt;</div>

VVVV.js comes packaged with jQuery, you can use this one, or your own version.

### Initializing and starting VVVV.js

After this, we have to initialize VVVV.js by calling `VVVV.init(...)` when the document is ready:

<div class="code">&lt;html&gt;
  &lt;head&gt;
    &lt;title&gt;My VVVV.js project&lt;/title&gt;
    &lt;script language="JavaScript" src="lib/vvvv_js/lib/jquery/jquery-1.8.2.min.js"&gt;&lt;/script&gt;
    &lt;script language="JavaScript" src="lib/vvvv_js/vvvv.js"&gt;&lt;/script&gt;
    &lt;link rel="stylesheet" href="lib/vvvv_js/vvvviewer/vvvv.css"&gt;&lt;/script&gt;
    <span class="highlight">&lt;script language="JavaScript"&gt;
      $(document).ready(function() {
        VVVV.init("lib/vvvv_js", "full", function() {
          console.log("VVVV.js initialized ...");
        });
      });
    &lt;/script&gt;</span>
  &lt;/head&gt;
  &lt;body&gt;
  nothing here ...
  &lt;/body&gt;
&lt;/html&gt;</div>

This will load the rest of the needed scripts. The first argument is the VVVV.js root directory relative to the document, in our case
`lib/vvvv_js`. As second argument, we provide `"full"`, as we want to do both, running and viewing VVVV.js patches. The third argument
is the function which is called once everything is loaded. For now, we only output some success message.

### Including the patch

Now that everything is in place, we have to create a new patch and tell VVVV.js to run it. Creating a new patch is easy: we just create
a new blank .v4p file. For this guide, it is going to be `my_project/assets/patches/my_patch.v4p`. The easiest way to do this is to supply a `<script language="VVVV">`
tag in the HTML header:

<div class="code">&lt;html&gt;
  &lt;head&gt;
    &lt;title&gt;My VVVV.js project&lt;/title&gt;
    &lt;script language="JavaScript" src="lib/vvvv_js/lib/jquery/jquery-1.8.2.min.js"&gt;&lt;/script&gt;
    &lt;script language="JavaScript" src="lib/vvvv_js/vvvv.js"&gt;&lt;/script&gt;
    &lt;link rel="stylesheet" href="lib/vvvv_js/vvvviewer/vvvv.css"&gt;&lt;/script&gt;
    &lt;script language="JavaScript"&gt;
      $(document).ready(function() {
        VVVV.init("lib/vvvv_js", "full", function() {
          console.log("VVVV.js initialized ...");
        });
      });
    &lt;/script&gt;
    <span class="highlight">&lt;script language="VVVV" src="assets/patches/my_patch.v4p"&gt;&lt;/script&gt;</span>
  &lt;/head&gt;
  &lt;body&gt;
  nothing here ...
  &lt;/body&gt;
&lt;/html&gt;</div>

### Programatically loading patches

The `<script>`-tag approach might be a suitable shortcut for most cases where a VVVV.js patch simply should start on loading a website. Of course there
are scenarios, where you want to load and start a patch manually, e.g. triggered by a user action, or after performing conditional checks. You
can do this by creating a new `VVVV.Core.Patch` object yourself:

<div class="code">var patch = new VVVV.Core.Patch("assets/patches/my_patch.v4p", function() {
  var mainloop = new VVVV.Core.MainLoop(patch, 30);
  mainloop.start();
});</div>

The code above creates a new `Patch` object, and runs the function passed as the second argument, once the patch is completely loaded.
If so, a new `MainLoop` object is created for `patch`. The second argument of the `MainLoop` constructor is optional and specifies the target frame rate.

### Launching the editor

After everything is set up, we can view the page in the browser. Obviously, nothing will happen, except a blank screen saying "nothing here ...", because
the patch we loaded is still empty. Check the JavaScript console (F12 in Chrome) to see if VVVV.js loaded correctly. If yes, we can start patching now.
As discussed in the [previous guide](/learn/patching), you can plug an editor into a running patch by appending the `#edit` command to the URL in the address bar
like this (assuming you are viewing the page at `http://localhost/my_project/`):

    http://localhost/my_project/#edit/assets/patches/my_patch.v4p
    
Hit enter, and an empty patch editor should start in new popup. If not, double-check if the patch file name after `#edit/` is _exactly_ as you specified it when loading it. Also
make sure the popup has not been blocked by your browser.

Double-click anywhere in the empty patch window and create a Renderer (Canvas VVVVjs) node. There should appear an empty black canvas
on the web site. Congratulations, you are ready to start patching.

### Saving Patches

Saving your changes from the VVVV.js editor is not as straight forward as with a desktop application. You have to take the round trip via
a file download and overwriting the existing patch file. Hit `Ctrl+S` to make VVVV.js export the patch as .v4p and to trigger the download.
Move the downloded file to the original location `my_project/assets/patches/my_patch.v4p` and overwrite the old file.

Always having to move the file from your Downloads folder to your project location is of course quite cumbersome. There is the possibility
of making Chrome display the "Save As" dialog instead of downloading to the default Downloads folder: `Settings -> Show Advanced Settings -> Downloads -> Check the "Ask where to save each file before downloading" checkbox`

### Conclusion

You learned how to include the VVVV.js library in your project and how to run a VVVV.js patch on a website. Go ahead with the [next guide](/learn/integrating)
to find out about more advanced techniques to seemlessly integrate VVVV.js with your site. 
