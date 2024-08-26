<?php

// member register php - check duplicate nokp
function isNokpExist($nokp,$combine_data)
{
    $exist = false;

    $nokp  = $combine_data->real_escape_string($nokp); //prevent sql injection attack
    $sql = "SELECT * FROM member WHERE member_nokp = '$nokp'";

    if ($result = $combine_data->query($sql))
    {
        if ($result->num_rows > 0)
        {
            $exist = true;
        }
    }
    
    $result->free();

    //$combine_data->close();

    return $exist;
}

// add admin php - check duplicate nokp
function isAdminExist($adminNokp,$combine_data)
{
    $exist = false;

    $adminNokp  = $combine_data->real_escape_string($adminNokp); //prevent sql injection attack
    $sql = "SELECT * FROM admin WHERE admin_nokp = '$adminNokp'";

    if ($result = $combine_data->query($sql))
    {
        if ($result->num_rows > 0)
        {
            $exist = true;
        }
    }
    
    $result->free();

    return $exist;
}
?>