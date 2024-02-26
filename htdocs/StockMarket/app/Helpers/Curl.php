<?php
    /**
     * curl
     *
     * @param string $method
     * @param string $curlUrl
     * @param array $headers
     * @param array $data
     * @return array
     * @author ZhiYong
     */
    function curl(string $method, string $curlUrl, array $headers = [], string|array $data = null) : array
    {
        $ch = curl_init();
        curl_setopt($ch , CURLOPT_URL , $curlUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 19913);
        switch($method){
            case 'GET':
                break;
            case 'POST':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($ch, CURLOPT_POST         , true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data );
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                break;
        }
        $result['content']   = curl_exec($ch);
        $result['httpCode'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return $result;
    }
