<?php

function formatDate($vdate) 
{
    $data = new DateTime($vdate);
    $parts = explode(' ',  $data->format('d/m/Y-H:i:s'));
    $datePart = $parts[0];    
    return $datePart;
}