<?php
function encrypt($Data)
{
    $id = (float)$Data * 525325.24;
    return base64_encode($id);
}

function decrypt($Data)
{
    $url_id = base64_decode($Data);
    $id = (float)$url_id / 525325.24;
    return $id;
}

function passwordEncode($Data)
{
    return password_hash($Data, PASSWORD_DEFAULT);
}
