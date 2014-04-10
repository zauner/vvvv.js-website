<?php

require_once("../lib/parsedown/Parsedown.php");

$parsedown = new Parsedown();
$meta = file_get_contents('../public/'.$_GET["article"]."/meta.json");
$meta = json_decode($meta);
$content = file_get_contents('../public/'.$_GET["article"]."/content.md");
$content = $parsedown->parse($content);
$content = preg_replace_callback('/(<img .*)src="([^"]+)"/', function($matches) use ($postfolder) {
  return $matches[1].'src="/'.$_GET["article"].'/images/'.$matches[2].'"';
}, $content);

?>

<div class="box">
  <h2><?= $meta->title ?></h2>
  <?= $content ?>
</div>
