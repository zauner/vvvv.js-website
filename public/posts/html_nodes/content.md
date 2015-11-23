A big part of VVVV.js version 1.1 was narrowing the gap between visual and textual programming. And while our <a href="../node_code_editor">previous post covered textual programming in the visual programming environment</a>, this time it's kind of the other way around: achieving classic webdev programming tasks with pure VVVV.js.

Until now, you were able to use VVVV.js to embed realtime graphics into a website. You were also able to interface with surrounding elements, but you had to create and style these elements first &ndash; usually by coding HTML, CSS and JavaScript. The new _HTML nodes_
hope to help here, so you can develop functionality happening _outside_ the renderer windows, without leaving the patch.

<p class="figure">
  <a href="/micropages/html_nodes_demo" target="_new">
    <img src="demo_screen.png"/>
  </a>
  <span class="caption">The <a href="/micropages/html_nodes_demo">Demo</a> shows most of the concepts in action. Make sure to open the patch, to see how it works.</span>
</p>

### Creating Elements

Using the _Element_ node, you can create every kind of HTML element. Choose the tag name and the node content. Use the inspector to define attribute pins. Besides manually filling the _Element_ node, there are various "shortcut" nodes, like _Image_ or _Link_ which come with preconfigured attribute pins.

<p class="figure">
  <img src="creating_elements.png">
  <span class="caption">Creating HTML elements on the page using either the generic "Element" node, or one of the predefined helpers, like "Image" or "Link".</span>
</p>

### Styling

The element nodes described above all have a _Style In_ input pin, which can be connected to the respective nodes. There is again a generic node simply called _Style_ which lets you set all kinds of CSS attributes. And again, there are some convenience nodes, which might help you if you don't know all CSS attributes by heart, and also make the patch more readable.

<p class="figure">
  <img src="styling.png"/>
  <span class="caption">The &lt;span&gt; element created in the patch is styled by various Style nodes, like "Background", "Padding", "FontSize", etc. Because the background color is spreaded across 130 slices, 130 HTML elements are created.</span>
</p>

You can chain up the _Style_ nodes similar to chaining up _Render State_ nodes. It is like defining a render state, and assigning it to elements by connecting. Also note, that it works pretty well with spreads.

### Nesting Elements

Each _Element_ node has a _Parent_ input pin, which can be connected to another _Element_ node. You can use the _Group_ node to preserve the order of the nested elements. Note, that this whole grouping thing does not work like we are used to from VVVV, but it's flipped right upside down. This is to avoid elements being nested into multiple other elements, which would be confusing. In general, this direction matches much more the tree-structure of an HTML DOM. When reading from upside down, instead of thinking "this element goes into that element", think "this element contains that element".

<p class="figure">
  <img src="nesting_elements.png"/>
  <span class="caption">Nesting elements using the "Parent" pins. Here, the yellow box is parent of the "Settings" headline, and three darker boxes. The three darker boxes again each are parent of a label and a text input box.</span>
</p>

### Events

You can use the event nodes to catch user interaction events like mouse clicks, key presses, etc. from DOM elements. It's the same story here: a generic _OnEvent_ node, and some predefined nodes like _OnClick_, _OnMouseOver_, etc. to make your life easier. All these nodes get an element as input, and as in classic VVVV manner, bang a 1 when the event occures.

<p class="figure">
  <img src="events.png"/>
  <span class="caption">Five buttons are created using a spreaded input on the "Button" node. The "OnClick" node outputs a spread of 5 slices, where each slice is set to 1 if the respective button has been clicked. Note, how the result of "OnClick" is influencing the buttons' styling via the "FrameDelay" node. By using "OnMouseOver" and "OnMouseOut" we detect which button is being hovered over, and display the respective info text in another element.</span>
</p>

### Selecting elements

In order to get hands on elements which are not created in VVVV, you can use the _GetElement (HTML)_ node. It takes a DOM selector as input, and delivers the matching elements as output. You can use these elements just as you can use the ones created in VVVV.js: style them using _ApplyStyle (HTML)_, nest other element into them, or catch events for these elements.

<p class="figure">
  <img src="selecting_elements.png"/>
  <span class="caption">Using "GetElement (HTML)" to select the VVVV.js website's &lt;body&gt; element to change its background and flip it upside down. The "SetText" node with the selected "#page-title" element changes the websites title.</span>
</p>

### Conclusion

Of course this all won't ever be a complete replacement for classic web design craftmanship, and you are not supposed to build entire websites this way (although you can &ndash; hello <a href="http://000.graphics">000.grapics</a>!). But it allows you to tighter connect your canvas/webgl content with the HTML surrounding it, and helps you to make use of all browser capapilities (like typography, element flow, UI elements, etc.) in a patching-manner.
