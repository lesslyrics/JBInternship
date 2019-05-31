<?php
# php_arXiv_parsing_example.php
#
# This sample script illustrates a basic arXiv api call
# followed by parsing of the results using the Simplepie
# module.
#
# Please see the documentation at
# http://export.arxiv.org/api_help/docs/user-manual.html
# for more information, or email the arXiv api
# mailing list at arxiv-api@googlegroups.com.
#
# Simplepie can be gotten from http://simplepie.org/
#
# Author: Julius B. Lucks, Bill Flanagan
#
# This is free software.  Feel free to do what you want
# with it, but please play nice with the arXiv API!
include_once('simplepie-1.5/autoloader.php');

define('EOL', "<br />\n");

# Base api query url
$base_url = 'http://export.arxiv.org/api/query?';

# Search parameters
$search_query = (isset($_GET['query']) ? $_GET['query'] : 'all'); # search for electron in all fields
$start = (isset($_GET['start']) ? $_GET['start'] : 0);
$max_results = (isset($_GET["max_results"]) ? $_GET["max_results"] : 5);

# Construct the query with the search parameters
$query = "search_query=" . $search_query . "&start=" . $start . "&max_results=" . $max_results;

# SimplePie will automatically sort the entries by date
# unless we explicitly turn this off
$feed = new SimplePie();
$feed->set_feed_url($base_url . $query);
$feed->set_cache_location($_SERVER['DOCUMENT_ROOT'] . '/simplepie_cache');
$feed->set_cache_duration(36000);
$feed->enable_order_by_date(false);
$feed->init();
$feed->handle_content_type();

if ($feed->error()) {
    echo $feed->error();
}

# Use these namespaces to retrieve tags
$atom_ns = 'http://www.w3.org/2005/Atom';
$opensearch_ns = 'http://a9.com/-/spec/opensearch/1.1/';
$arxiv_ns = 'http://arxiv.org/schemas/atom';

# print out feed information
print("<b>Print out feed information</b>" . EOL);
print("Feed title: " . $feed->get_title() . EOL);
$last_updated = $feed->get_feed_tags($atom_ns, 'updated');
print("Last Updated: " . $last_updated[0]['data'] . EOL . EOL);

# opensearch metadata such as totalResults, startIndex,
# and itemsPerPage live in the opensearch namespase
print("<b>Opensearch metadata such as totalResults, startIndex, and itemsPerPage live in the opensearch namespase</b>" . EOL);
$totalResults = $feed->get_feed_tags($opensearch_ns, 'totalResults');
print("totalResults for this query: " . $totalResults[0]['data'] . EOL);

$startIndex = $feed->get_feed_tags($opensearch_ns, 'startIndex');
print("startIndex for these results: " . $startIndex[0]['data'] . EOL);

$itemsPerPage = $feed->get_feed_tags($opensearch_ns, 'itemsPerPage');
print("itemsPerPage for these results: " . $itemsPerPage[0]['data'] . EOL . EOL);

# Run through each entry, and print out information
# some entry metadata lives in the arXiv namespace
print("<b>Run through each entry, and print out information some entry metadata lives in the arXiv namespace</b>" . EOL);

$i = 1;
foreach ($feed->get_items() as $entry) {
    print("<b>Entry " . $i++ . "</b>" . EOL);
    print("e-print metadata" . EOL);

    $temp = explode('/abs/', $entry->get_id());
    print("arxiv-id: " . $temp[1] . EOL);
    print("Title: " . $entry->get_title() . EOL);

    $published = $entry->get_item_tags($atom_ns, 'published');
    print("Published: " . $published[0]['data'] . EOL);

    # gather a list of authors and affiliation
    #  This is a little complicated due to the fact that the author
    #  affiliations are in the arxiv namespace (if present)
    # Manually getting author information using get_item_tags
    $authors = array();
    foreach ($entry->get_item_tags($atom_ns, 'author') as $author) {
        $name = $author['child'][$atom_ns]['name'][0]['data'];
        $affils = array();

        /*
        # If affiliations are present, grab them
        if ($author['child'][$arxiv_ns]['affiliation']) {
            foreach ($author['child'][$arxiv_ns]['affiliation'] as $affil) {
                array_push($affils, $affil['data']);
            }
            if ($affils) {
                $affil_string = join(', ', $affils);
                $name = $name . " (" . $affil_string . ")";
            }
        }*/
        array_push($authors, '    ' . $name . EOL);
    }
    $author_string = join('', $authors);
    print("Authors: " . EOL . $author_string . EOL);
    # get the links to the abs page and pdf for this e-print
    foreach ($entry->get_item_tags($atom_ns, 'link') as $link) {
        if ($link['attribs']['']['rel'] == 'alternate') {
            print("abs page link: " . $link['attribs']['']['href'] . EOL);
        } elseif ($link['attribs']['']['title'] == 'pdf') {
            print("pdf link: " . $link['attribs']['']['href'] . EOL);
        }
    }

    # The journal reference, comments and primary_category sections live under
    # the arxiv namespace
    $journal_ref_raw = $entry->get_item_tags($arxiv_ns, 'journal_ref');
    if ($journal_ref_raw) {
        $journal_ref = $journal_ref_raw[0]['data'];
    } else {
        $journal_ref = 'No journal ref found';
    }
    print("Journal Reference: " . $journal_ref . EOL);

    $comments_raw = $entry->get_item_tags($arxiv_ns, 'comment');
    if ($comments_raw) {
        $comments = $comments_raw[0]['data'];
    } else {
        $comments = 'No journal ref found';
    }
    print("Comments: " . $comments . EOL);

    $primary_category_raw = $entry->get_item_tags($arxiv_ns,
        'primary_category');
    $primary_category = $primary_category_raw[0]['attribs']['']['term'];
    print("Primary Category: " . $primary_category . EOL);

    # Lets get all the categories
    $categories = array();
    foreach ($entry->get_categories() as $category) {
        array_push($categories, $category->get_label());
    }
    $categories_string = join(', ', $categories);
    print("All Categories: " . $categories_string . EOL);

    # The abstract is in the <summary> element
    print("Abstract: " . $entry->get_description() . EOL . EOL);
}
?>
