The result of the previous guides has always been some canvas graphics showing off in the center of the page in a standalone manner, like a Java Applet or a 
Flash intro back in 1998. But VVVV.js offers a variety of advanced techniques to integrate patches seemlessly into your website. This
guide shows how to

* unobutrusively embed Renderer output anywhere on the page
* read content and attributes from the surrounding page
* react to DOM events fired on the page
* modify content and attributes of the surrounding page

with a VVVV.js patch. This will help you to combine the advantages of both, UI elements/layout with HTML/CSS, and swift graphics
development with VVVV.js.

### Referencing DOM elments using selectors

The basic idea about how VVVV.js communicates with the surrounding DOM is to bind certain nodes to DOM elements using selectors. You
do so by setting the _Descriptive Name_ pin of a node to a DOM selector. _Descriptive Name_ is a hidden pin, and can only be set via
the Inspektor: select the node and hit `CTRL+I`. This DOM selector string
goes straight into jQuery, so you can use anything jQuery understands here. Read more about it in the [jQuery documentation](http://api.jquery.com/category/selectors/).

<div class="figure">
  <img src="../../../cheatsheet/img/embedding_renderer.png"/>
  <div class="caption">
    Associating nodes with DOM elements by applying a selector to the "Descriptive Name" pin. Select a node and hit <code>CTRL+I</code> to open the Inspektor window.
  </div>
</div>

Some basic examples:

<table>
 <thead>
 <tr>
 <th>Selector</th>
 <th>Description</th>
 <th>Example</th>
 </tr>
 </thead>
 <tbody>
 <tr>
 <td class="nowrap">h1</td>
 <td>matches all `&lt;H1&gt;` elements</td>
 <td><code>&lt;h1&gt;The first heading&lt;/h1&gt;</code>, <code>&lt;h1&gt;Another heading&lt;/h1&gt;</code></td>
 </tr>
 <tr>
 <td class="nowrap">.menu-item</td>
 <td>matches all elements which have the class <code>menu-item</code></td>
 <td><code>&lt;a class="menu-item"&gt;Home&lt;/a&gt;</code>, <code>&lt;a class="menu-item active"&gt;Docs&lt;/a&gt;</code></td>
 </tr>
 <tr>
 <td class="nowrap">#total-amount</td>
 <td>matches <em>the one</em> element with ID <code>total-amount</code>. IDs have to be unique within a DOM, so this can only match one element</td>
 <td><code>&lt;div id="total-amount"&gt;300.00&lt;/div&gt;</code></td>
 </tr>
 </tbody>
</table>

### Placing Renderer Output

In most practical cases you want to place VVVV.js generated graphics output at a certain location on your site: a data visualisation
next to a table, a morphing ribbon of polygons as a header animation, etc.

When you create a Renderer node, a `<CANVAS>` element is _appended_ to the end of the page as default. You have to tell the renderer where to put
that `<CANVAS>` element instead, by providing a DOM selector matching the target element to the Renderer's _Descriptive Name_ pin.

The following shows the most common example, where the HTML document contains a `<DIV>` element which serves as placeholder for
the VVVV.js output:

<div class="code">...
&lt;body&gt;
  ...
  The insignificance of the test results is shown in the following interactive infographic:
  <span class="highlight">&lt;div id="test_result_viz"&gt;&lt;/div&gt;</span>
  As you can see, it is all random.
  ...
&lt;/body&gt;</div>

To place VVVV.js' graphical output into that placeholder, we have to associate the Renderer node with the element with ID `test_result_viz`,
by setting its _Descriptive Name_ pin to `#test_result_viz`:

<div class="figure">
  <img src="placing_renderer.png"/>
  <div class="caption">
    The Renderer node's output is placed into the <code>&lt;DIV id="test_result_viz"&gt;</code> element.
  </div>
</div>

### Reading values from the DOM

You can use IOBoxes to read text, attributes, events and style information from the surrounding DOM tree. This is a handy method to e.g. transform textual
data provided in a table into a chart. Also, it's a good practise to get all kinds of data from your backend into the VVVV.js patch.

Again, we are using the _Descriptive Name_ pin to reference a DOM element. The IOBox is automatically populated with the matching values
from the DOM. If there are multiple elements matching, the IOBox will contain as much slices as there are matching values.

#### Reading text nodes

To retreive text nodes (that's the content between the tags), just provide a suitable DOM selector to the IOBox's _Descriptive Name_

<div class="figure">
  <table class="layout">
  <tr>
  <td>
  <div class="code">&lt;body&gt;
  ...
  &lt;h1 class="chapter"&gt;Chapter 1&lt;/h1&gt;
  &lt;div id="total-amount"&gt;600.00&lt;/div&gt;
  &lt;h1 class="chapter"&gt;Another Chapter&lt;/h1&gt;
  Lorem ipsum
  &lt;h1 class="chapter"&gt;Final Chapter&lt;/h1&gt;
  Some foxes over fences.
  ...
&lt;/body&gt;</div>
  </td>
  <td>
    <img src="reading_text.png"/>
  </td>
  </tr>
  </table>
  <div class="caption">
    IOBoxes populated with text from the DOM.
  </div>
</div>

#### Reading attributes

To read attributes, use a suitable selector followed by `/attribute/[attribute name]`:

<div class="figure">
  <table class="layout">
  <tr>
  <td>
  <div class="code">&lt;body&gt;
  ...
  &lt;select id="country"&gt;
    &lt;option value="AT"&gt;Austria&lt;/option&gt;
    &lt;option value="CH"&gt;Switzerland&lt;/option&gt;
    &lt;option value="DE"&gt;Germany&lt;/option&gt;
  &lt;/select&gt;
  ...
&lt;/body&gt;</div>
  </td>
  <td>
    <img src="reading_attributes.png"/>
  </td>
  </tr>
  </table>
  <div class="caption">
    The selector <code>select#country option</code> refers to all <code>&lt;OPTION&gt;</code> elements within the <code>&lt;SELECT&gt;</code> element. The string <code>attribute/value</code> appended
    to it retreives the "value" attribute rather than the enclosed text.
  </div>
</div>
 

#### Reading CSS information

By appending `/style/[css property]` to a selector, you can access an element's CSS information. 

<div class="figure">
  <table class="layout">
  <tr>
  <td>
  <div class="code">&lt;head&gt;
  &lt;style type="text/css"&gt;
    .thick-borders{border-width:6px; border-color:black; border-style:solid}
    .thin-borders{border-width:1px; border-color:red; border-style:solid}
  &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
  ...
  &lt;div class="thick-black-borders"&gt;Div 1&lt;/div&gt;
  &lt;div class="thin-red-borders"&gt;Div 2&lt;/div&gt;
  &lt;div class="thick-black-borders"&gt;Div 3&lt;/div&gt;
  &lt;div class="thick-black-borders"&gt;Div 4&lt;/div&gt;
  ...
&lt;/body&gt;</div>
  </td>
  <td>
    <img src="reading_style.png"/>
  </td>
  </tr>
  </table>
  <div class="caption">
    Using <code>/style/[property name]</code> we can get CSS properties of elements.
  </div>
</div>


#### Capturing DOM events

Adding `event/[event name]` to a selector allows you to capture events like mouse clicks, key presses, etc. fired in the surrounding page. The IOBox bound to an event will output
the value `1` for exactly one frame, when the event is fired.

<div class="figure">
  <table class="layout">
  <tr>
  <td>
  <div class="code">&lt;body&gt;
  ...
  &lt;a class="menu-item" href="..."&gt;Home&lt;/a&gt;
  &lt;a class="menu-item" href="..."&gt;About&lt;/a&gt;
  &lt;a class="menu-item" href="..."&gt;Contact&lt;/a&gt;
  ...
&lt;/body&gt;</div>
  </td>
  <td>
    <img src="capturing_events.png"/>
  </td>
  </tr>
  </table>
  <div class="caption">
    The FlipFlop node's output is set to 1, when the mouse pointer hovers over a link element, and is reset to 0 when it leaves the element again.
  </div>
</div>
