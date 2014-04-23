<?php

$lab_data = file_get_contents('http://lab.vvvvjs.com/api.php?count=5');
$lab_data = json_decode($lab_data);

?>
<? foreach ($lab_data->patches as $labpatch): ?>
  <div class="gallery-item">
    <a href="<?= $labpatch->url ?>">
      <img src="<?= $labpatch->image ?>"/>
      <div class="description">View at the Lab</div>
    </a>
  </div>
<? endforeach; ?>
<div class="gallery-item">
  <a id="reload-gallery" href="#">
    <span class="icon-loop"></span>
    <div class="description">Show more</div>
  </a>
</div>