<?php


namespace App\Traits;


trait ApiRequestTrait
{
    /**
     *  HTTP request GET
     *
     * @param $url
     * @param array $data
     * @return array|mixed
     */
    protected function apiGet($url, $data = [])
    {
        $getParams = '';

        if (!empty($data)) $getParams = '?' . http_build_query($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,  $url . $getParams);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return $this->_buildResponse($result, $info);
    }

    /**
     * Build Api call response
     *
     * @param $response
     * @param $info
     * @return array|mixed
     */
    private function _buildResponse($response, $info)
    {
        $decodedResult = json_decode($response, true);
        if ($info['http_code'] == 422) {//validation errors
            return ['errors' => $decodedResult];
        } elseif ($info['http_code'] == 401) {//unauthorized
            return ['unauthorized_error'=>$decodedResult];
        } elseif ($info['http_code'] == 0) { //if api is offline
            return ['error' => 'api_connection_problem'];
        }

        return $response;
    }
}
