<?php
/**
SSOFB Columns
May 2014
Andy gaskell @ SSOFB
ag@ssofb.co.uk
http://ssofb.co.uk
This extension in released under the GNU/GPL License - http://www.gnu.org/copyleft/gpl.html
GNU General Public License version 2 or later; see LICENSE.txt
 
Repo: https://github.com/AndyGaskell/ssofb_columns 
 
Syntax:
 
{cols}
blah blah 
{colbr}
blah blah 
{colbr}
blah blah 
{/cols} 

Secondary Syntax:
blah blah 
{split}
blah blah 
  
Tertiary Syntax:
blah blah 
{splitleft}
blah blah   
  
  
*/
 
 // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class plgContentSsofbcolumns extends JPlugin {

    function onContentPrepare($context, &$article, &$params, $limitstart)
    {
        # base for notices
        $notices = "";
        
        # see if the plug-in markers are in the content
        $num_col_open = substr_count ($article->text, "{cols}");
        $num_col_br = substr_count ($article->text, "{colbr}");
        $num_col_close = substr_count ($article->text, "{/cols}");

        # see if we have a split
        $split = substr_count ($article->text, "{split}");        

        # see if we have a split left
        $split_left = substr_count ($article->text, "{splitleft}");        
        
        #$notices .= "num_col_open: " . $num_col_open . " <br/>";        
        #$notices .= "num_col_br: " . $num_col_br . " <br/>";        
        #$notices .= "num_col_close: " . $num_col_close . " <br/>";        
        
        # check we have col open, col brean and a col close
        if ($num_col_open AND $num_col_br AND $num_col_close) {
            # see how many cols there are
            if ( $num_col_br == 1 ) {
                # we have 2 cols, so span6
                $span = "span6";
            } elseif ( $num_col_br == 2 ) {
                # we have 3 cols, so span4
                $span = "span4";
            } elseif ( $num_col_br == 3 ) {
                # we have 4 cols, so span3
                $span = "span3";
            } elseif ( $num_col_br == 4 ) {
                # we have 5 cols, so span5Col, this is a bit of a special
                $span = "span5Col";    
            } elseif ( $num_col_br == 5 ) {
                # we have 6 cols, so span2
                $span = "span2";
            } elseif ( $num_col_br == 11 ) {
                # we have 12 cols, so span1
                $span = "span1";
                
                
            } else {
                # we have an invalid number of cols
                $span = "";
                $notices .= "Invalid number of columns found by Joomla SSOFB Columns plug-in. This plug-in supports 2, 3, 4, 6 or 12 columns, but you have " . ($num_col_br + 1) . ".";
            }
            
            # check if span is true, if so, we're good to go
            if ($span) {
                # sub in the row start
                $article->text = str_replace('{cols}', '<div class="row-fluid"><div class="' . $span . '">', $article->text);
                # sub in the col breaks
                $article->text = str_replace('{colbr}', '</div><div class="' . $span . '">', $article->text);
                # sub in the row end
                $article->text = str_replace('{/cols}', '</div></div>', $article->text);
            }
            # if there are any notices, then lets show them at the top of the article
            if ($notices) {
                $article->text = "<div class=\"alert\">" . $notices . "</div>" . $article->text;
            }       

            
        } elseif ($split) { 
        
            # sub in the div close and open
            $article->text = str_replace('{split}', '</div><div class="span4">', $article->text);
            # add a div to front and back
            $article->text = "<div class=\"row-fluid\"><div class=\"span8\">" . $article->text . "</div></div>";

            
        } elseif ($split_left) { 

            # sub in the div close and open
            $article->text = str_replace('{splitleft}', '</div><div class="span8">', $article->text);
            # add a div to front and back
            $article->text = "<div class=\"row-fluid\"><div class=\"span4\">" . $article->text . "</div></div>";

        
        } else {
        
            return true;
        }
    }
}
