<?php
/* 
 * Date: 10-20-2020 
 * Autho: Carlos Alvarez
 * This file gets the search field and loads the JSON, find the matches and returns a JSON to be displayed. 
 */
$json = file_get_contents('data/keyword.json');

$data = json_decode($json, true);

$search_field = $_GET['search_field'];

if(count($data) > 0)
{
    foreach($data as $row => $result)
    {
	$id = $result['ID'];    
        $name = $result['name'];
        $city = $result['city'];
        $state = $result['state']; 

        $string = $name.$city.$state; 
	/*
	 * We are looking the search field in the string, we are doing the comparison in lowercase so the match is case sensitive.
	 */                 
        $found = strpos(strtolower ($string), strtolower ($search_field));
         
	if ($found !== false || $search_field == "")		
	{
 	    $data_result[] = array(
		    'ID' => $id,
		    'name' => $name,
		    'city' => $city, 
		    'state' => $state
	    );            
        }
    }
}

header('Content-Type: application/json');
echo json_encode($data_result);
?>
