<?php

require_once('lib/Zebra_Form.php');

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
    $form = new Zebra_Form('form');
    $form->clientside_validation(array(
        'close_tips' =>  true,
        'on_ready' =>  false,
        'disable_upload_validation' => true,
        'scroll_to_error' =>  false,
        'tips_position' =>  'right',
        'validate_on_the_fly' =>  true,
        'validate_all' =>  true,
    ));
    
    $form->add('label', 'label_url', 'url', 'URL');
    $url = $form->add('text', 'url', 'http://');
    $url->set_rule(array(
        'required' => array('url_error', 'URL musí být vyplněno.'),
        'url' => array(true, 'url_error', 'Pole musí obsahovat platné URL (včetně protokolu).'),
    ));
    
    
    $form->add('label', 'label_title', 'title', 'Název stránky');
    $title = $form->add('text', 'title', '');
    $title->set_rule(array(
        'required' => array('title_error', 'Název musí být vyplněn.'),
    ));
    
    $form->add('submit', 'submitbtn', 'Přidat');

    
    if ($form->validate()) {
        $ok = model_add($_POST['url'], $_POST['title'], array());
        if ($ok) {
            flash('info', 'Záložka byla vytvořena');
        } else {
            flash('error', 'Záložku se nepodařilo vytvořit.');
        }
        redirect_to('/');
    }
    
    // set('form', $form->render('views/add_form.php', true));
    set('form', $form->render('', true));
    
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


