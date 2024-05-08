<?php


 function saksh_date_diff_in_days($date1, $date2) { 
    
    
    if($date1==$date2 ) return 1;
    
   
   
    $diff = strtotime($date2) - strtotime($date1); 
  
    
    
    return abs(round($diff / 86400)); 
} 


 
