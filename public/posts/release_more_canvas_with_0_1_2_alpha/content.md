With slight delay we finally reached the next milestone with version 0.1.2-alpha. Besides some changes under the hood (mostly regarding graph evaluation), this release introduces a bunch of new nodes, covering a major part of Canvas 2D drawing functionality. As a development guidline we used this handy Canvas HTML5 Cheat Sheet.

Version 0.1.2-alpha allows us to:

* draw vector shapes like bezier curves, arcs, rectangles, text
* fill them — solid or using gradients
* stroke them, using several stroke styles
* draw images and streaming video
* render shadows and glows
* use various blend techniques
* transform all this using regular VVVV transform nodes
* Have a look at the CHANGELOG, and check out the Examples here, to get the details.

Thanks to vux, defetto, matise and micro.d for contributing to this release! The next big step is tackling the WebGL pipeline, by implementing dynamic shaders, render state nodes, etc. If you're interested in participating here, contact us via Github!

