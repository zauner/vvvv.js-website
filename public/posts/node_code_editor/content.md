Visual programming is great. There are many situations, where you only need a couple of clicks to achieve what would have caused you headaches with textual programming. However, there are just as many situations, where juggling spread slices can be frustrating, and you feel like just _writing_ the goddamn code would do the job. In these cases, it totally makes sense to switch back to textual programming &ndash; at least for a bit.

To create a seemless integration of textual code and visual VVVV code, VVVV.js now has a built-in node editor. This allows you to create custom nodes directly in VVVV.js, writing JavaScript. You don't even have to reload the page after you changed your node's sourcecode. You can 'recompile' the node, and it will be updated in the patch while it is running.

<p class="figure">
  <a href="/micropages/code_editor_demo" target="_new">
    <img src="code_editor.png"/>
  </a>
</p>

It works similar to classic VVVV's built-in node editor, with some differences. To create a new node, you have to use the *DefineNode* node. Using the Inspector, you can set a node name, and when you right-click
the *DefineNode* node, you will get to the code editor. You can then create new instances of your custom node just as you would create common nodes: by double-clicking the patch, and selecting your custom node from the node list. Have a look at the <a href="/micropages/code_editor_demo">Demo page</a> to see how it works.

In contrast to classic VVVV, the node is _not stored externally_ but right "inside" the DefineNode node. This means, in order to use your new node within another project, you have do copy the DefineNode node to the other patch. However, your defined node will be recognized across subpatches, so you can build a library of custom nodes, and include it as subpatch in various projects.

The <a href="/micropages/code_editor_demo">Demo</a> you see in the image above is a typical example, where a task is better done in textual programming. Finding the n nearest neighbours for each point in an array of points would be very impratical to solve in VVVV's visual programming language &ndash; just because its lack of classic loops. However, packing this in a custom node called "GetNearest", allows us to combine the best of both worlds, visual and textual programming.
