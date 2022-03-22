<?php
function encrypt($sData)
{
    $id = (float)$sData * 525325.24;
    return base64_encode($id);
}

function decrypt($sData)
{
    $url_id = base64_decode($sData);
    $id = (float)$url_id / 525325.24;
    return $id;
}

function passwordEncode($sData) {
    return password_hash($sData, PASSWORD_DEFAULT);
}
