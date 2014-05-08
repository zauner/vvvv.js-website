<div class="box">
  <h2>Contribute</h2>
  
  If you are interested in contributing to the project, there are many ways you can. There are a couple of hot topics to be tackled, like
  
  <ul>
    <li>Audio Analysis Nodes</li>
    <li>Box2D Nodes</li>
    <li>Improved packaging mechanisms</li>
    <li>Server-side execution</li>
    <li>Creating alternative themes</li>
    <li>etc.</li>
  </ul>
  
  And of course, there are many other nodes and shaders waiting to be ported from VVVV to VVVV.js.
  
  <h2>Guidelines</h2>
  
  VVVV.js' sourcecode is available on <a href="http://github.com/zauner/vvvv.js">Github</a>. These guidelines will help you to
  integrate your nodes, fixes and other contributions.
  
  <h3>Where to put your nodes?</h3>
  
  Each node belongs to one or more categories. For example, `GetSlice (Spreads)` belongs to the _Spreads_ category, while `GetSlice (String)`
  belongs to the _String_ category. Place the nodes in the corresponding category file in VVVV.js' `nodes/` subdirectory, e.g. `nodes/vvvv.nodes.spreads.js`
  or `nodes/vvvv.nodes.string.js`. If there's no file for your node's category, just create it and add it to the list in `vvvv.js`.
  
  Also, make sure to fill out the meta data, like your name and to give credit to other sources.
  
  <h3>Adding third party libraries</h3>
  
  Add third party libraries to the `lib` folder and register them as described in `thirdparty.js`. This way, VVVV.js only loads
  the libraries, if a dependent node is used.
  
  <h3>Coding Style</h3>
  
  Please keep the coding style aligned with the rest of the code, and use <strong>2-space indentation</strong>.
  
  
</div>
