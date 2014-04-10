This guide will give an introduction to the key principles of working with VVVV.js, and will make you comfortable with the patch editor.
After reading this guide, you will understand how the VVVV.js runtime parts and the patch editor work together, and basically know your
way around the patch editor. __You don't need anything but a Chrome web browser to work this guide.__

### Key principles

The basic thing to understand about VVVV.js is how developing and running VVVV.js plays together. There are these 3 compononents:

* __the VVVV.js Patch__, a .v4p file in  XML format, defining all the nodes and connections which build the logic
* __the Website__, which acts as *host* for a patch, loads it and runs it
* __the Patch Editor__, which you can launch from the website, to modify the running VVVV.js patch

<div class="figure">
  <img src="key_principle.png"/>
  <div class="caption">
    Key to understanding VVVV.js: it starts with a VVVV.js patch (here: example11.v4p) running in a website. The patch
    editor can be launched on top of it.
  </div>
</div>

What differs VVVV.js from similar projects is the fact that it does *not* start with launching an empty editor, which subsequently creates
patches. Instead, it starts with a website running an (initially empty) patch, where you can plug the patch editor in. So, to emphasize this:

__A VVVV.js patch can not run without a containing website. Also, the patch editor can not exist without a patch, it can only be launched on top of an already running patch__

This is essential, because this way, there is no difference between development mode and runtime mode. Your changes to the patch
will be reflected immediatly in the final environment &mdash; no exporting, no compiling, no refreshing.

### Warm-up

Let's forget about how to include and load VVVV.js for a moment, and just get some idea of how patching itself works. The best place
to start is the VVVV.js Lab, where we can launch the editor on any of the posted patches, and play around with them. So let's head 
to http://lab.vvvvjs.com/show.php?id=a15e18297f17a8dcb8ff94c2199e68c4 and click the __Edit Patch__ button. This should open the patch
editor in a new window. If not, check your browser's popup blocker.

Now you can make changes to the patch, and see the results on the website immediatly. Have a look at the
[VVVV.js Cheat Sheet](/cheatsheet/index.html) for the basic patching operations. The figure below gives some inspiration about what you can do with the patch.

<div class="figure">
  <div class="image-container">
  <img src="vvvvjs_lab_hints.png"/>
  
  <div class="image-annotation" style="left:678px;top:117px">
  <div class="annotation-wrapper">
  <div class="number">1</div>
  <div class="description">Right-Click the IOBox and change<br/>the number of arcs <span><br/>You can enter a value or hover over the input field and use the mouse wheel to modulate</span></div>
  <div class="arrow"></div>
  </div>
  </div>
  
  <div class="image-annotation" style="left:467px;top:180px">
  <div class="annotation-wrapper">
  <div class="number">2</div>
  <div class="description">Right-Click the <i>Width</i> pin to change<br/>the stroke width <span><br/>You can enter a value or hover over the input field and use the mouse wheel to modulate</span></div>
  <div class="arrow"></div>
  </div>
  </div>
  
  <div class="image-annotation" style="left:474px;top:231px">
  <div class="annotation-wrapper">
  <div class="number">3</div>
  <div class="description">Right-Click the <i>Color</i> pin to change<br/>the fill color
  <span>
  <br/>Hover over the color field, and use<br/>
  <b>Mouse Wheel</b> to modulate the hue<br/>
  <b>Shift+Mouse Wheel</b> to modulate the lightness<br/>
  <b>Alt+Mouse Wheel</b> to modulate saturation<br/>
  <b>Alt+Shift+Mouse Wheel</b> to modulate alpha<br/>
  </span>
  </div>
  <div class="arrow"></div>
  </div>
  </div>
  
  <div class="image-annotation" style="left:592px;top:311px">
  <div class="annotation-wrapper">
  <div class="number">4</div>
  <div class="description">Right-Click the <i>Input 2</i> pin to change<br/>length of the arcs<span><br/>You can enter a value or hover over the input field and use the mouse wheel to modulate</span></div>
  <div class="arrow"></div>
  </div>
  </div>
  
  </div> 
  <div class="caption">
    Try to modify some values in this patch from the VVVV.js Lab.
  </div>
</div>

### Using the #edit command

Of course, in a real-life scenario you usually don't want any "Edit Patch" and "Save Patch" buttons on your website. But that's ok, since
we actually don't need them. Instead we are providing a special command to the URL in the address bar, so we can launch the editor
without the need of any controls on the website. Open http://www.vvvvjs.com/vvvv_js/template/ and once it is loaded, view the page's source code
(e.g. Right-Click -> View Source). You will find the line

<div class="code">&lt;script language="VVVV" src="template_patch.v4p"&gt;&lt;/script&gt;</div>
  
This line tells you that the file `template_patch.v4p` has been loaded and is running. We are going to attach a patch editor to it by adding
`#edit/template_patch.v4p` to the URL in the address bar, like so:

<div class="figure">
  <img src="address_bar.png"/>
  <div class="caption">
    Adding <code>#edit/[patch file name]</code> to the URL in the address bar will launch the editor.
  </div>
</div>

The patch editor should open in a new window. Again, check your popup settings for the page if it does not work. Make this simple rotating quad more interesting by adjusting
the patch like this:

<div class="figure">
  <div class="image-container">
  <img src="inserting_nodes.png"/>
  
  <div class="image-annotation" style="left:826px;top:107px">
  <div class="annotation-wrapper">
  <div class="number">1</div>
  <div class="description">Double-Click anywhere in the patch to<br/>create an <i>IOBox (Value Advanced)</i><span><br/>Right-Click the IOBox to set its value to e.g. 31</span></div>
  <div class="arrow"></div>
  </div>
  </div>
  
  <div class="image-annotation" style="left:534px;top:181px">
  <div class="annotation-wrapper">
  <div class="number">2</div>
  <div class="description">Create a <i>CircularSpread</i> node and a <i>Translate (Transform)</i> node.<span><br/>This <i>CircularSpread</i> node will create a spread (~array) of 31 X and Y values, which form a circle. Going through the <i>Translate</i> node, this will result in 31 quads, arranged in a circle.</span></div>
  <div class="arrow"></div>
  </div>
  </div>
  
  <div class="image-annotation" style="left:490px;top:337px">
  <div class="annotation-wrapper">
  <div class="number">3</div>
  <div class="description">Draw connetions by left-clicking the Output Pins and Input Pins you want to connect<span><br/>Only pins of matching type can be connected. VVVV.js will highlight the pins that match.</span></div>
  <div class="arrow"></div>
  </div>
  </div>
  
  <div class="image-annotation" style="left:653px;top:420px">
  <div class="annotation-wrapper">
  <div class="number">4</div>
  <div class="description">Create the rest of the nodes (<i>HSV (Color Join)</i> and <i>LinearSpread</i>) and connect them.<span><br/>This <i>HSV (Color Join)</i> creates a series of 31 color shades, which will be applied to the 31 quads.</span></div>
  </div>
  </div>
  
  </div>
  <div class="caption">
    Double-Click anywhere in the patch to create new nodes. Left-Click pins to draw connetions.
  </div>
</div>

### Conclusion

That's it, you learned how to launch the editor and made your first steps in patching VVVV.js. Now it's time to find out how to use VVVV.js in your own project, rather than just
edit already deployed patches. Read all about it in the next guide, [Embedding VVVV.js](/learn/embed).

