<?php

function render_solution($dbc, $db_name, $value) {
    $solution = array();
    $formula_title = get_formula($dbc, $db_name, $value);
    if ($formula_title != '')
        $solution[] = $formula_title;

    $herb_plus = get_herb_plus($dbc, $db_name, $value);
    if ($herb_plus != '')
        $solution[] = $herb_plus;

    $herb_minus = get_herb_minus($dbc, $db_name, $value);
    if ($herb_minus != '')
        $solution[] = $herb_minus;
    echo implode(',&nbsp;', $solution);
}

function get_formula($dbc, $db_name, $value) {
    $formula_links = array();
    $formulae = array_unique(array_merge(get_subjects($dbc, $value, "治疗"), get_values($dbc, $value, '方剂加（调整）'), get_values($dbc, $value, '方剂（调整）'), get_values($dbc, $value, '被...治疗')));
    foreach ($formulae as $formula) {
        $formula_links[] = render_value($dbc, $db_name, $formula, false);
    }

    $formula_title = '';
    if (count($formula_links) != 0) {
        $formula_title .= implode(',&nbsp;', $formula_links);
    }
    return $formula_title;
}

function get_herb_minus($dbc, $db_name, $value) {
    $herb_links = array();
    $herbs = array_merge(get_values($dbc, $value, '中药减（调整）'));
    foreach ($herbs as $herb) {
        $herb_links[] = render_value($dbc, $db_name, $herb, false);
    }
    $herb_title = '';
    if (count($herb_links) != 0) {
        $herb_title = '减' . implode(',&nbsp;', $herb_links);
    }
    return $herb_title;
}

function get_herb_plus($dbc, $db_name, $value) {
    $herb_links = array();
    $herbs = array_merge(get_values($dbc, $value, '中药加（调整）'));
    foreach ($herbs as $herb) {
        $herb_links[] = render_value($dbc, $db_name, $herb, false);
    }
    $herb_title = '';
    if (count($herb_links) != 0) {
        $herb_title = '加' . implode(',&nbsp;', $herb_links);
    }
    return $herb_title;
}
?>
