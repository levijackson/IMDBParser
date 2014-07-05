<?php

namespace IMDBParser\Models;

use SplFileObject;

class MovieParser extends Parser {

    protected $StartText = 'MOVIES LIST';
    /*
        ([\s\S]*) - this will match any whitespace and non-whitespace character
        \( - this will stop that first matching when it runs into an opening parenthesis, normally signifying the start of a release date.
        ([\d{4}]*|\?*) - this matches the year
        (?:\/)? - sometimes the year was entered as (2004/I) or (2005/IV).  This allows an optional forward slash after the year.
        ([\w]*)? - Along with the previous item,  this accommodates finding characters after the year. Still not sure exactly what that means though.
        \) - this just signified the end of the release date.
        (\s*{([\w!\s:;\/\.\-\'"?`_&@$%^*<>~+=\|\,\(\)]*) - this looks way more complex than it is (it goes along with the next bit, so look at those as a whole as opposed to separate chunks). It looks for a space after the year and then it matches the content inside the curly brace until it hits a pound sign signaling an episode.
        (\s*\(#([\d]*)\.([\d]*)\))?})? - This matches the episode name, season, and episode number if it runs into #.
        \s* - just allows for as many spaces as needed between this and anything after.
        ([\d{4}]*)? - these last 3 go hand in hand. They will match an optional year range. Some of the shows have year ranges for how long it has been running.
        (?:-)?
        ([\d{4}]*)?
    */
    protected $MatchRegExp = '^([\s\S]*)\(([\d{4}]*|\?*)(?:\/)?([\w]*)?\)(\s*{([\w!\s:;\/\.\-\'"?`_&@$%^*<>~+=\|\,\(\)]*)(\s*\(#([\d]*)\.([\d]*)\))?})?\s*([\d{4}]*)?(?:-)?([\d{4}]*)?';

    protected function parseMatch($match = array()) {
        // sometimes IMDB likes to put (????) instead of the year... and then later in the title line give the year.
        if (!empty($match[9]) and is_numeric($match[9])) {
            $match[2] = $match[9];
        }

        // remove any white space in the matches
        array_walk($match, function(&$m) {
            $m = trim($m);
        });

        if (substr($match[1], 0, 1) == '"' and substr($match[1], -1) == '"') {
            // this is a tv show and IMDB wraps those in quotes.
            $match[1] = trim($match[1], '"');
        }
        
        return array('title' => $match[1], 'year' => $match[2], 'season' => $match[7], 'episode_number' => $match[8], 'episode_name' => $match[5]);
    }

}