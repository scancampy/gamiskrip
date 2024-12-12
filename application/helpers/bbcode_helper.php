
<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* CodeIgniter BBCode Helpers
*
* @package  CodeIgniter
* @subpackage Helpers
* @category Helpers
* @author  Philip Sturgeon
* @changes  MpaK http://mrak7.com
* @link  http://codeigniter.com/wiki/BBCode_Helper/
*/

// ------------------------------------------------------------------------

/**
* parse_bbcode
*
* Converts BBCode style tags into basic HTML
*
* @access public
* @param string unparsed string
* @param int max image width
* @return string
*/

// Further custom sanitization if needed
function sanitize_description($input) {
    // Remove any script tags
    $input = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $input);
    // Remove unwanted HTML tags
    $allowed_tags = '<p><a><br><b><i><strong><em>';
    $input = strip_tags($input, $allowed_tags);
    return $input;
}

function parse_bbcode($str = '', $max_images = 0){
// Max image size eh? Better shrink that pic!
if($max_images > 0):
   $str_max = "style=\"max-width:".$max_images."px; width: [removed]this.width > ".$max_images." ? ".$max_images.": true);\"";
endif;

$find = array(
  "'\[b\](.*?)\[/b\]'is",
  "'\[code\](.*?)\[/code\]'is",
  "'\[h1\](.*?)\[/h1\]'is",
  "'\[h2\](.*?)\[/h2\]'is",
  "'\[h3\](.*?)\[/h3\]'is",
  "'\[i\](.*?)\[/i\]'is",
  "'\[u\](.*?)\[/u\]'is",
  "'\[s\](.*?)\[/s\]'is",
  "'\[img\](.*?)\[/img\]'i",
  "'\[url\](.*?)\[/url\]'i",
  "'\[url=(.*?)\](.*?)\[/url\]'i",
  "'\[link\](.*?)\[/link\]'i",
  "'\[link=(.*?)\](.*?)\[/link\]'i",
  "'\[list\](.*?)\[/list\]'is",
  "'\[\*\](.*?)\n's",
  "'\[olist\](.*?)\[/olist\]'is"
);

$replace = array(
  '<strong>\\1</strong>',
  '<pre><code>\\1</code></pre>',
  '<h1>\\1</h1>',
  '<h2>\\1</h2>',
  '<h3>\\1</h3>',
  '<em>\\1</em>',
  '<u>\\1</u>',
  '<s>\\1</s>',
  '<img src="\\1" alt="" />',
  '<a href="\\1">\\1</a>',
  '<a href="\\1">\\2</a>',
  '<a href="\\1">\\1</a>',
  '<a href="\\1">\\2</a>',
  '<ul>\\1</ul>',
  '<li>\\1</li>',
  '<ol>\\1</ol>'
);

return preg_replace($find, $replace, $str);

}

?>