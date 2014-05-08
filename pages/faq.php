<div class="box faq">
  <h2>General</h2>
  
  <h3>Q: Why are the nodes called "DX9" or "EX9" nodes, when they are actually WebGL?</h3>
  
  So they are compatible with classic VVVV. There is a feature in the making which translates terms from classic VVVV to VVVV.js and
  vice versa, but at the moment we just have to play along.
  
  <h3>Q: When should I use the <em>EX9/WebGL</em> nodes, and when the <em>Canvas VVVVjs</em> nodes?</h3>
  
  <p>With the <em>EX9/WebGL</em> nodes you can create hardware accelerated 3D graphics and employ shader effects. The downside is, that there is a
  considerable chance that the users' browser does not support WebGL.</p>
  
  <p>The <em>Canvas</em> nodes are great for all kinds of vector graphics. Shapes, curves, text, etc. is all done easier with the
  Canvas nodes, so they might be the better choice for e.g. charts and user interfaces. However, at the moment there is no support
  for 3D using the Canvas nodes.</p>
  
  
  <h2>Patching</h2>
  
  <h3>Q: How do I create a new patch?</h3>
  
  Just create a new empty text file with a .v4p extension and include it into your website. It will do nothing first, but you can launch an editor
  on top of it and add the logic.
  
  <h3>Q: I am trying to load a WebGL texture, but it does not show up</h3>
  
  Unfortunatly, image files can not have arbitrary size in order to work with WebGL. Instead, dimensions have to be powers of 2, like
  128px, 256px, 512px, 1024px, and so on.
  
  <h3>Q: I can't use the image file http://somehost.com/some_image.jpg as WebGL texture.</h3>
  
  For security reasons, WebGL only allows you to load image files from the host the site comes from. If you need to display external
  image files via WebGL, you can set up a script on your server backend, which proxies external files, and tell VVVV.js about this by
  setting the <code>VVVV.ImageProxy</code> variable.
  
  <h3>Q: I can't find PhongDirectional or any other shader nodes in the list of available nodes.</h3>
  
  In contrast to the classic desktop VVVV, VVVV.js can not search the file system for shader files and populate the node list based on that.
  Instead, you have to enter the complete file name (e.g. <code>PhongDirectional.fx</code>) when creating a new node, and hit enter. Only then
  VVVV.js can look in the effects folder if it finds that shader node. Once a patch contains a specific shader node, VVVV.js is aware of
  it, and also lists it in the list of available nodes.
  
  <h3>Q: I connected a WebGL/EX9 node to two Renderers, but it only shows up in one.</h3>
  
  Each WebGL ressource can only be used in one render context. At the current state, you have to duplicate nodes to have the same
  geometry in two different renderers. 
  
  <h3>Q: I can't connect the Quad node (or some other node) to the Renderer node, as it's shown in that example.</h3>
  
  There are two different Renderer nodes: Renderer (EX9) for WebGL graphics and Renderer (Canvas VVVVjs) for 2D Canvas graphics. You
  can only connect the according EX9 and Canvas VVVVjs nodes to it. Unfortunately, you can not mix those at will. However, you can
  use the output of a Renderer (Canvas VVVVjs) as a texture in a Renderer (EX9), if that helps. 
  
  
  <h2>Running</h2>
  
  <h3>Q: VVVV.js does not load correctly and I get ... JavaScript errors</h3>
  
  VVVV.js has to dynamically load scripts, patches, shader files, etc., so, in order to run a website containing VVVV.js from your computer, you have two options:
  
  <ul>
    <li>Run it from a webserver environment (like e.g. XAMPP for Windows), so you can load it via e.g. <code>http://localhost/my_visualization/index.html</code>
    <li>
      Launch Chrome with the <code>--allow-file-access-from-files</code> option. This disables the mentioned security measures, so websites can access files
      via <code>file://...</code>. But be careful, as this affects all websites you view with this Chrome instance. Read more about how to start Chrome
      with this flag [here](http://www.chrome-allow-file-access-from-file.com/)
    </li>
  </ul>
  
  <h3>Q: I appended #edit/some_patch_name.v4p to the URL to open the patch editor, but nothing happens.</h3>
  
  There are two common problems when trying to open the editor: pop ups are blocked, or the file name in the URL does not match the exact
  file name of the patch. Note, that it has to be exactly the same as you specified it in the <code>&lt;script language="VVVV"&gt;</code>
  tag or in the <code>new VVVV.Core.Patch(...)</code> call, including leading slashes.
  
</div>