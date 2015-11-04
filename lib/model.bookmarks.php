<?php

function model_load() {
    $f = fopen("data.json", "r");
    if ($f === FALSE) {
        return array("data"=>array(), "counter" => 0);
    }
    $json = fread($f, filesize("data.json"));
    fclose($f);
    return json_decode($json, true);
}

function model_save($data) {
    $json = json_encode($data);
    $f = fopen("data.json", "w");
    if ($f === FALSE) {
        return FALSE;
    }
    fwrite($f, $json);
    fclose($f);
    return TRUE;
}

function model_add($url, $title) {
    $data = model_load();
    $data["counter"]++;
    $data["data"][] = array(
        "title" => $title,
        "url" => $url,
        "id" => $data["counter"]
    );
    
    return model_save($data);
}

function model_remove($id) {
    $data = model_load();
    $data["data"] = array_values(array_filter($data["data"], function($bookmark) use ($id) {
        return $bookmark["id"] != $id;
    }));
    
    return model_save($data);
}

function model_get_all() {
    $data = model_load();
    return $data["data"];
}
