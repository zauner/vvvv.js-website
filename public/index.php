<?php

function render($filename) {
  ob_start();
  if (file_exists($filename))
    include($filename);
  else
    return false;
  return ob_get_clean();
}

function contents($page) {
  $res = render('../pages/'.$page.'.php');
  if (!$res) {
    header("HTTP/1.0 404 Not Found - Archive Empty");
    echo "Page not found.";
  }
  return $res;
}

function format_code($code) {
  $code = htmlentities($code);
  $code = preg_replace_callback("/~~([^~]+)~~/", function($match) {
    return '<span class="highlight">'.$match[1]."</span>";
  }, $code);
  return trim($code);
}


$PAGE = key_exists("page", $_GET) ? $_GET["page"] : "";
if ($PAGE=="")
  $PAGE = "start";

if (key_exists("layout", $_REQUEST) && $_REQUEST["layout"]=="false")
  echo render('../nolayout.php');
else
  echo render('../layout.php');


?>
