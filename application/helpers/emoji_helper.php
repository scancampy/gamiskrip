
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

function unicodeOrd($char) {
    $utf8Char = mb_convert_encoding($char, 'UTF-8', 'UTF-8');
    $codepoint = unpack('N', mb_convert_encoding($utf8Char, 'UCS-4BE', 'UTF-8'));
    return $codepoint[1];
}

function convertEmojisToHtmlEntities($string) {
    // Callback function to convert each emoji to HTML entity
    $callback = function($matches) {
        $unicode = unicodeOrd($matches[0]);
        return "&#" . $unicode . ";";
    };

    // Regex pattern to match emojis
    $emojiPattern = '/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F700}-\x{1F77F}\x{1F780}-\x{1F7FF}\x{1F800}-\x{1F8FF}\x{1F900}-\x{1F9FF}\x{1FA00}-\x{1FA6F}\x{1FA70}-\x{1FAFF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F004}\x{1F0CF}\x{1F170}-\x{1F251}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F700}-\x{1F77F}\x{1F780}-\x{1F7FF}\x{1F800}-\x{1F8FF}\x{1F900}-\x{1F9FF}\x{1FA00}-\x{1FA6F}\x{1FA70}-\x{1FAFF}\x{2300}-\x{23FF}\x{23E9}-\x{23EF}\x{23F0}\x{23F3}\x{23F8}-\x{23FA}]/u';

    return preg_replace_callback($emojiPattern, $callback, $string);
}

?>