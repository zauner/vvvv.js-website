<?php

require_once("../lib/parsedown/Parsedown.php");

$parsedown = new Parsedown();

$postfolders = scandir('posts');
$posts = array();

foreach ($postfolders as $postfolder) {
  if ($postfolder=='.' || $postfolder=='..')
    continue;
  $meta = file_get_contents('../public/posts/'.$postfolder."/meta.json");
  $meta = json_decode($meta);
  $content = file_get_contents('../public/posts/'.$postfolder."/content.md");
  $meta->link = $postfolder;
  $meta->content = $parsedown->parse($content);
  $meta->content = preg_replace_callback('/src="([^"]+)"/', function($matches) use ($postfolder) {
    return 'src="/posts/'.$postfolder.'/images/'.$matches[1].'"';
  }, $meta->content);
  $posts[] = $meta;
}
usort($posts, function($p1, $p2) {
  return $p1->date > $p2->date ? -1 : 1;
});

?>
<?php foreach ($posts as $post): ?>
  <div class="post box">
    <h2><a href="/posts/<?= $post->link ?>" class="internal"><?= $post->title ?></a></h2>
    <div class="meta">posted on <?= $post->date ?>, by <?= $post->author ?></div>
    <?= $post->content ?>
  </div>
<?php endforeach ?>
