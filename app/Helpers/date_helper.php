<?php

function formatDate($vdate) 
{
    $data = new DateTime($vdate);
    $parts = explode(' ',  $data->format('j/n/Y-H:i'));
    $datePart = $parts[0];    
    return $datePart;
}