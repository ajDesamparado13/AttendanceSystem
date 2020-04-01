<?php
// PHP code to get the MAC address of Client 
$MAC = exec('getmac'); 
  
// Storing 'getmac' value in $MAC 
$MAC = strtok($MAC, ' '); 
  
// Updating $MAC value using strtok function,  
// strtok is used to split the string into tokens 
// split character of strtok is defined as a space 
// because getmac returns transport name after 
// MAC address    
echo "MAC address of client is: $MAC"; 

$info = exec('systeminfo | find /i "Boot Time"');
echo $info;

$info = exec('wmic os get lastbootuptime');
echo $info;

function shutdown()
{
    // This is our shutdown function, in 
    // here we can do any last operations
    // before the script is complete.

    echo 'Script executed with success';
}

register_shutdown_function('shutdown');

?> 