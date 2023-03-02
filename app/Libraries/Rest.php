<?php
namespace App\Libraries;
use Illuminate\Support\Facades\Log;

class Rest{

    public function __construct(
        private string $api_url,
        private string $api_key
    ){}

    /**
     * Curl GET command is issued to the given endpoint with the API key used in the header
     *
     * @param string $endpoint
     * @param string $params
     * @return object
     */
    public function get(string $endpoint='', string $params=''): object
    {
        $request_url = $this->api_url . $endpoint . "?" . $params;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request_url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: {$this->api_key}"
            ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        #Error in curl
        if($response === false)
        {
            $response = new \stdClass();
            $response->success = false;
            $response->message = curl_error($curl);
        }
        curl_close($curl);

        $response = json_decode($response);

        return $response;
    }
}