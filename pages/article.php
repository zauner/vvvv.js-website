<?php

require_once("../lib/parsedown/Parsedown.php");

$postfolder = $_GET["article"];

$parsedown = new Parsedown();
$meta = file_get_contents('../public/'.$postfolder."/meta.json");
$meta = json_decode($meta);
$content = file_get_contents('../public/'.$postfolder."/content.md");
$content = $parsedown->parse($content);
$content = preg_replace_callback('/(<img .*)src="([^"]+)"/', function($matches) use ($postfolder) {
  return $matches[1].'src="/'.$postfolder.'/images/'.$matches[2].'"';
}, $content);

?>

<div class="box">
  <h2><?= $meta->title ?></h2>
  <?= $content ?>
</div>
