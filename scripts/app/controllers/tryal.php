<form action="" method="GET" >
    <input type="date" name='dp' >
    <input type="submit">
</form>
<?php

function flushTemp()
{
    $thirtyMin = 60*30;
    $files = glob('../uploads/tmp/*');
    foreach($files as $file)
    {
        $filename = basename($file);
        $brokenFile = explode("_", $filename);
        $timestamp = array_shift($brokenFile);
        $elapsed = time()-$timestamp;
        $elapsed>$thirtyMin?unlink($file):null;
    }
}
echo password_hash('godspeed', PASSWORD_DEFAULT);die;
function checkFieldsConsistency(array $userData, array $mandatoryFields,  array $optionalFields = array()):void
    {
        $userFields = array_keys($userData);
        if(array_diff($mandatoryFields, $userFields))
            throw new Exception("Inadequate Fields Supplied");
        if(array_diff($userFields, array_merge($mandatoryFields, $optionalFields)))
            throw new Exception("Invalid Fields Supplied");
        foreach($userData as $datum)
        {
            if(empty($datum))
                throw new Exception("Required Fields Cannot Be Empty");
        }
    }

try{
    checkFieldsConsistency(array('l'=>'s'), array(), array('kofi', 'name', 'ama', 'location'));
}catch(Exception $e)
{
    echo $e->getMessage();
}
// // kvstore API url
// $url = 'https://sefecon.com/api/regions/list/';
// // Collection object
// $data = [
//     "*"=>"*"
//   ];
//   // Initializes a new cURL session
// $curl = curl_init($url);
// // 1. Set the CURLOPT_RETURNTRANSFER option to true
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// // 2. Set the CURLOPT_POST option to true for POST request
// curl_setopt($curl, CURLOPT_POST, true);

// // 3. Set the request data as JSON using json_encode function
// curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));

// // 4. Set custom headers for RapidAPI Auth and Content-Type header
// curl_setopt($curl, CURLOPT_HTTPHEADER, [
//   'X-RapidAPI-Host: kvstore.p.rapidapi.com',
//   'X-RapidAPI-Key: [Input your RapidAPI Key Here]',
//   'Content-Type: application/json'
// ]);

// // Execute cURL request with all previous settings
// $response = curl_exec($curl);
// $data =json_decode($response, true);
// $data = $data['vSky_msg'];
// echo "<table>";
// echo "<th>Region</th>";
// echo "<th>City</th>";
// // foreach ($data as $region => $cities)
// //  {
// //   //  echo "$region:   ";
// //   //  print_r($cities);die;
// //     foreach ($cities as $city) 
// //     {
// //       DbWrapper::runDml([$region, $city]);
// //     }

// //  }
// //  echo "</table>";
// // 
// // $query  = 'INSERT INTO locations(region, city) VALUES(?, ?)';
// // $params = array($region, $city);

// $timestamp = strtotime("4565223:45614:00");
// echo date('Y-m-d H:i:s');

   
