<?php

function page_index() {
    set('title', 'Moje záložky');
    set('bookmarks', model_get_all());
    return html('list.html.php');
}

function bookmark_matches($q, $bookmark) {
    if (stripos($bookmark['title'], $q) !== FALSE) {
        return TRUE;
    }
    
    if (stripos($bookmark['url'], $q) !== FALSE) {
        return TRUE;
    }
    
    return FALSE;
}

function page_search() {
    
    $q = params('keyword');
    
    $result = array();
    
    foreach (model_get_all() as $b) {
        if (bookmark_matches($q, $b)) {
            $result[] = $b;
        }
    }
    
    set('title', 'Výsledky hledání');
    set('bookmarks', $result);
    
    return html('list.html.php');
}

function page_add_bookmark() {
    $errors = array();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bookmark = array(
            'url' => trim(get_post_value('url')),
            'title' => trim(get_post_value('title'))
        );
        if (empty($bookmark['url'])) {
            $errors[] = "URL nesmí být prázdné.";
        }
        if (empty($bookmark['title'])) {
            $errors[] = "Nadpis musí být vyplněn.";
        }
        if (count($errors) == 0) {
            $ok = model_add($bookmark['url'], $bookmark['title']);
            if ($ok) {
                flash('info', 'Záložka byla vytvořena');
            } else {
                flash('error', 'Záložku se nepodařilo vytvořit.');
            }
            redirect_to('/');
        }
    } else {
        $bookmark = array(
            "url" => "http://",
            "title" => ""
        );
    }
    
    set('f_url', $bookmark['url']);
    set('f_title', $bookmark['title']);
    set('errors', $errors);
        
    set('title', 'Nová záložka');
    return html('add.html.php');
}

function page_remove_bookmark() {
    $id = params('id');
    $ok = model_remove($id);
    if ($ok) {
        flash('info', 'Záložka smazána.');
    } else {
        flash('error', 'Záložku se nepodařilo smazat.');
    }
    redirect_to('/');
}


