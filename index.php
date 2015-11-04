<?php

require_once("lib/limonade.php");

session_start();


layout('layout/default.html.php');



dispatch('/', 'page_index');

dispatch('/q/:keyword', 'page_search');

dispatch('/add', 'page_add_bookmark');
dispatch_post('/add', 'page_add_bookmark');

dispatch('/remove/:id', 'page_remove_bookmark');


run();
