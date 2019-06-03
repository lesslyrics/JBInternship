<html>
<head>
    <title>Query results</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
</head>
</html>
<?php
# Please see the documentation at
# http://export.arxiv.org/api_help/docs/user-manual.html
# for more information, or email the arXiv api
# mailing list at arxiv-api@googlegroups.com.
#
# Simplepie can be gotten from http://simplepie.org/

include_once('simplepie-1.5/autoloader.php');

define('EOL', "<br />\n");
/*
 * List of stop words
 */
$stopWords = array(
    "a", "about", "above", "above", "across", "after", "afterwards", "again", "against", "all", "almost", "alone",
    "along", "already", "also", "although", "always", "am", "among", "amongst", "amoungst", "amount", "an", "and",
    "another", "any", "anyhow", "anyone", "anything", "anyway", "anywhere", "are", "around", "as", "at", "back",
    "be", "became", "because", "become", "becomes", "becoming", "been", "before", "beforehand", "behind", "being",
    "below", "beside", "besides", "between", "beyond", "bill", "both", "bottom", "but", "by", "call", "can",
    "cannot", "cant", "co", "con", "could", "couldnt", "cry", "de", "describe", "detail", "do", "done",
    "down", "due", "during", "each", "eg", "eight", "either", "eleven", "else", "elsewhere", "empty", "enough",
    "etc", "even", "ever", "every", "everyone", "everything", "everywhere", "except", "few", "fifteen", "fify",
    "fill", "find", "fire", "first", "five", "for", "former", "formerly", "forty", "found", "four", "from",
    "front", "full", "further", "get", "give", "go", "had", "has", "hasnt", "have", "he", "hence", "her", "here",
    "hereafter", "hereby", "herein", "hereupon", "hers", "herself", "him", "himself", "his", "how", "however",
    "hundred", "ie", "if", "in", "inc", "indeed", "interest", "into", "is", "it", "its", "itself", "keep", "last",
    "latter", "latterly", "least", "less", "ltd", "made", "many", "may", "me", "meanwhile", "might", "mill",
    "mine", "more", "moreover", "most", "mostly", "move", "much", "must", "my", "myself", "name", "namely", "neither",
    "never", "nevertheless", "next", "nine", "no", "nobody", "none", "noone", "nor", "not", "nothing", "now",
    "nowhere", "of", "off", "often", "on", "once", "one", "only", "onto", "or", "other", "others", "otherwise",
    "our", "ours", "ourselves", "out", "over", "own", "part", "per", "perhaps", "please", "put", "rather",
    "re", "same", "see", "seem", "seemed", "seeming", "seems", "serious", "several", "she", "should", "show",
    "side", "since", "sincere", "six", "sixty", "so", "some", "somehow", "someone", "something", "sometime",
    "sometimes", "somewhere", "still", "such", "system", "take", "ten", "than", "that", "the", "their",
    "them", "themselves", "then", "thence", "there", "thereafter", "thereby", "therefore", "therein", "thereupon",
    "these", "they", "thickv", "thin", "third", "this", "those", "though", "three", "through", "throughout",
    "thru", "thus", "to", "together", "too", "top", "toward", "towards", "twelve", "twenty", "two", "un",
    "under", "until", "up", "upon", "us", "very", "via", "was", "we", "well", "were", "what", "whatever",
    "when", "whence", "whenever", "where", "whereafter", "whereas", "whereby", "wherein", "whereupon",
    "wherever", "whether", "which", "while", "whither", "who", "whoever", "whole", "whom", "whose",
    "why", "will", "with", "within", "without", "would", "yet", "you", "your", "yours", "yourself",
    "yourselves", "the");

# Base api query url
$base_url = 'http://export.arxiv.org/api/query?';

# Search parameters
$search_query = (isset($_GET['query']) ? $_GET['query'] : 'all'); // search
$start = ((isset($_GET['start'])  &&  $_GET['start']) ? $_GET['start'] : 0); //first article to be shown, default: 1
if (isset($_GET['max_results'])) {
    // restriction of total articles: no more than 10 000. Default: 10
    if ($_GET['max_results'] <= 10000) {
        $max_results = $_GET['max_results'];
    } else {
        $max_results = 10000;
    }
} else {
    $max_results = 10;
}

$query = "search_query=" . $search_query . "&start=" . $start . "&max_results=" . $max_results;


/* SimplePie will automatically sort the entries by date
 * unless we explicitly turn this off*/
$feed = new SimplePie();
$feed->set_feed_url($base_url . $query);
$feed->set_cache_location('./simplepie_cache');
$feed->set_cache_duration(36000);
$feed->enable_order_by_date(false);
$feed->init();
$feed->handle_content_type();

if ($feed->error()) {
    echo $feed->error() . EOL;
}

// retrieve tags
$atom_ns = 'http://www.w3.org/2005/Atom';
$opensearch_ns = 'http://a9.com/-/spec/opensearch/1.1/';
$arxiv_ns = 'http://arxiv.org/schemas/atom';


print("<b>RESULTS</b>" . EOL);
$totalResults = $feed->get_feed_tags($opensearch_ns, 'totalResults');
print("Total possible results for this query: " . $totalResults[0]['data'] . EOL);

$startIndex = $feed->get_feed_tags($opensearch_ns, 'startIndex');
print("Start index for these results: " . $startIndex[0]['data'] . EOL);

$itemsPerPage = $feed->get_feed_tags($opensearch_ns, 'itemsPerPage');
print("Items per page for these results: " . $itemsPerPage[0]['data'] . EOL);
print("Entries are sorted by date ". EOL);

/*echo "<table>";
echo "<tr><th>ID</th></tr>";

echo "<tr><td>13</td>    <td>33</td></tr>\n";

echo "</table>";*/

$i = $startIndex[0]['data'];
$decadesCounter = 0;
$dictionary = array();
$dict = array();

/*For each article-result*/
foreach ($feed->get_items() as $entry) {

    //print(EOL . "<b>------------------ PUBLICATION  " . $i++ . " ------------------</b>" . EOL);
    $temp = explode('/abs/', $entry->get_id());

    $string = $entry->get_title();
    echo "<table>";

    echo "<tr><th>$i . $string</th></tr>";
    $i++;
    $data = preg_split('/\s+/', $string);

    if ($decadesCounter < 10) {
        $decadesCounter++;

        foreach ($data as $word) {

            if (!in_array(strtolower($word), $stopWords)) {
                $dictionary[] = $word;
                $resultCount = array_count_values(array_map("strtolower", $dictionary)); //create dictionary and top-10
                                                                                         // from words in headings
                if (!in_array($word, $dict))
                    $dict[] = strtolower($word);
            }
        }
    } else {
        $dictionary = array();
        $dict = array();
        $decadesCounter = 1;

        foreach ($data as $word) {
            if (!in_array(strtolower($word), $stopWords)) {
                $dictionary[] = $word;                          //create new dictionary and top-10 for each 10 results
                $resultCount = array_count_values(array_map("strtolower", $dictionary));

                if (!in_array($word, $dict))
                    $dict[] = strtolower($word);

            }
        }
    }

    $published = $entry->get_item_tags($atom_ns, 'published');
    $publ_print = $published[0]['data'];
    echo "<tr><td><b>Published: </b>$publ_print</td> </tr>\n";
   // print("<b>Published: </b>" . $published[0]['data'] . EOL);

    /* gather a list of authors and affiliation
     * manually getting author information using get_item_tags
     * */
    $authors = array();
    foreach ($entry->get_item_tags($atom_ns, 'author') as $author) {
        $name = $author['child'][$atom_ns]['name'][0]['data'];
        $affils = array();

        array_push($authors, '    ' . $name . EOL);
    }
    $author_string = join('', $authors);
   // print("<b>Authors: </b>" . " " . $author_string);
    echo "<tr><td><b>Authors: </b> $author_string</td> </tr>\n";

    // get the links to the abs and pdf
    foreach ($entry->get_item_tags($atom_ns, 'link') as $link) {
        if ($link['attribs']['']['rel'] == 'alternate') {
            echo("<br>");
            $linkpr = $link['attribs']['']['href'];

            echo "<tr><td>Download: <a href=" . $linkpr. ">ABS </a> ";
           // echo sprintf("<a href='%s'>ABS page</a>", $link['attribs']['']['href']);

        } elseif ($link['attribs']['']['title'] == 'pdf') {
            $linkpr = $link['attribs']['']['href'];
            echo "<a href=" . $linkpr. ">PDF</a> </td></tr>\n";
            //echo sprintf("<a href='%s'>PDF page</a>", $link['attribs']['']['href']);


        }
    }

    /* The journal reference, comments and primary_category sections */
    $journal_ref_raw = $entry->get_item_tags($arxiv_ns, 'journal_ref');
    if ($journal_ref_raw) {
        $journal_ref = $journal_ref_raw[0]['data'];
    } else {
        $journal_ref = 'No journal reference found';
    }
    //print("<b>Journal Reference: </b>" . $journal_ref . EOL);
    echo "<tr><td><b>Journal Reference: </b> $journal_ref </td> </tr>\n";


    $comments_raw = $entry->get_item_tags($arxiv_ns, 'comment');
    if ($comments_raw) {
        $comments = $comments_raw[0]['data'];
    } else {
        $comments = 'No journal reference found';
    }
   // print("<b>Comments: </b>" . $comments . EOL);
    echo "<tr><td><b>Comments: </b> $comments </td> </tr>\n";


    $primary_category_raw = $entry->get_item_tags($arxiv_ns,
        'primary_category');
    $primary_category = $primary_category_raw[0]['attribs']['']['term'];
   // print("<b>Primary Category: </b>" . $primary_category . EOL);
    echo "<tr><td> <b> Primary Category: </b> $primary_category </td> </tr>\n";


    // all the categories
    $categories = array();
    if (is_array($entry->get_categories()) || is_object($entry->get_categories())) {
        foreach ($entry->get_categories() as $category) {
            array_push($categories, $category->get_label());
        }
    }
    $categories_string = join(', ', $categories);
    //print("<b>All Categories: </b>" . $categories_string . EOL);
    echo "<tr><td> <b> All Categories:  </b> $categories_string </td> </tr>\n";


    //The abstract is in the <summary> element
   // print("<b>Abstract: </b>" . EOL . $entry->get_description() . EOL);
    $disc = $entry->get_description();
    echo "<tr><td> <b> Abstract:  </b> $disc </td> </tr>\n";
    echo "</table>";


    if ($decadesCounter == 10) {

        /*
          Printing all the key words from the headers and TOP-10 most popular ones every 10 results
        */

        array_multisort($resultCount, SORT_NUMERIC, SORT_DESC);
        print(EOL);

        print(EOL . "<b>KEY WORDS FROM TITLES:</b> ");
        $j = 0;
        for ($j = 0; $j < sizeof($dict); $j++) {
            if ($j != (sizeof($dict) - 1))
                print("<b>$dict[$j]</b>" . ", ");
            else
                print("<b>$dict[$j]</b>" . EOL . EOL);
        }
        print("<b>TOP-10 MOST POPULAR: </b>");
        for ($c = 0; $c < 9; $c++) {
            print(array_keys($resultCount)[$c] . " ");
            print("(" . array_values($resultCount)[$c] . "), ");
        }
        print(array_keys($resultCount)[9] . " ");
        $temp =array_keys($resultCount)[9];
        print("(" . array_values($resultCount)[$c] . ") ");
        print(EOL . EOL);
    }
}
?>
