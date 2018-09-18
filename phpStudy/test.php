<?php 
$url = "http://www.genecopoeia.com:8000/sugarcrm/service/v4/rest.php";
	$username = "admin";
    $password = "4Cd5snLbb";

    //function to make cURL request
    function call($method, $parameters, $url)
    {
        ob_start();
        $curl_request = curl_init();

        curl_setopt($curl_request, CURLOPT_URL, $url);
        curl_setopt($curl_request, CURLOPT_POST, 1);
        curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl_request, CURLOPT_HEADER, 1);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

        $jsonEncodedData = json_encode($parameters);

        $post = array(
             "method" => $method,
             "input_type" => "JSON",
             "response_type" => "JSON",
             "rest_data" => $jsonEncodedData
        );

        curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
        $result = curl_exec($curl_request);
        curl_close($curl_request);

        $result = explode("\r\n\r\n", $result, 2);
        $response = json_decode($result[1]);
        ob_end_flush();

        return $response;
    }

    //login ----------------------------------------- 

    $login_parameters = array(
         "user_auth" => array(
              "user_name" => $username,
              "password" => md5($password),
              "version" => "1"
         ),
         "application_name" => "RestTest",
         "name_value_list" => array(),
    );

    $login_result = call("login", $login_parameters, $url);

    /*
    echo "<pre>";
    print_r($login_result);
    echo "</pre>";
    */

    //get session id
    $session_id = $login_result->id;
    // echo $session_id;
    //search --------------------------------------- 

    $search_by_module_parameters = array(
        //Session id
        "session" => $session_id,

        //The string to search for.
        'search_string' => 'GC-A0012',

        //The list of modules to query.
        'modules' => array(
        // 'Accounts',
        'inv_inventory',
        ),

        //The record offset from which to start.
        'offset' => 0,

        //The maximum number of records to return.
        'max_results' => 2,

        //Filters records by the assigned user ID.
        //Leave this empty if no filter should be applied.
        'id' => '',

        //An array of fields to return.
        //If empty the default return fields will be from the active listviewdefs.
        'select_fields' => array(
            'id',
            // 'gene_id',
            // 'gb_acc',
            'name',
            // 'account_type',
            // 'phone_office',
            // 'assigned_user_name',
        ),

        //If the search is to only search modules participating in the unified search.
        //Unified search is the SugarCRM Global Search alternative to Full-Text Search.
        'unified_search_only' => true,

        //If only records marked as favorites should be returned.
        'favorites' => false
    );

    $search_by_module_result = call('search_by_module', $search_by_module_parameters, $url);

    echo '<pre>';
    print_r($search_by_module_result);
    echo '</pre>';
?>