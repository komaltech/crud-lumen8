<?php

namespace App\Lib;

class ResponseBase
{

    public static function success($data)
    {
        $response = [];

        $response['status'] = 'success';
        $response['code']   = 200;
        $response['data']   = isset($data['data']) ? $data['data'] : null;

        if (isset($data['status']) && $data['status'])
        {
            $response['status'] = $data['status'];
        }

        if (isset($data['links']) && $data['links']) 
        {
            $response['links'] = [
                'first' => (isset($data['links']['first'])) ? $data['links']['first']   : null,
                'last'  => (isset($data['links']['last']))  ? $data['links']['last']    : null,
                'prev'  => (isset($data['links']['prev']))  ? $data['links']['prev']    : null,
                'next'  => (isset($data['links']['next']))  ? $data['links']['next']    : null,
            ];
        }

        if (isset($data['meta']) && $data['meta'])
        {
            $response['meta'] = [
                'current_page'  => (isset($data['meta']['current_page']))   ? $data['meta']['current_page'] : null,
                'from'          => (isset($data['meta']['from']))           ? $data['meta']['from']         : null,
                'last_page'     => (isset($data['meta']['last_page']))      ? $data['meta']['last_page']    : null,
                'per_page'      => (isset($data['meta']['per_page']))       ? $data['meta']['per_page']     : null,
                'to'            => (isset($data['meta']['to']))             ? $data['meta']['to']           : null,
                'total'         => (isset($data['meta']['total']))          ? $data['meta']['total']        : null
            ];
        }

        if (isset($data['message']) && $data['message']) 
        {
            $response['message'] = $data['message'];
        }

        if(!preg_match('/login|oauth/i',request()->url()))
            $response['request'] = request()->all();

        return response()->json($response);
        // return response()->json($response,$response['code']);


    }

    public static function error($code = 400, $data)
    {
        $response = [];
        $response['status'] = 'error';
        $response['code'] = $code <= 0 ? 400 : $code;
        $response['message'] = $data;

        if(!preg_match('/login|oauth/i',request()->url()))
            $response['request'] = request()->all();

        return response()->json($response, 200, [], JSON_UNESCAPED_SLASHES);

        /*
        $url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if(preg_match('/agent/i',$url)) {
            return response()->json($response,$response['code']);
        }else{
            return response()->json($response);
        }
        */
    }

    public static function errorProduct($code = 400, $data)
    {
        $response = [];

        $response['status'] = 'error';
        $response['code']   = $code <= 0 ? 400 : $code;
        $response['data']   = isset($data['data']) ? $data['data'] : null;
        $response['message'] = $data['message'];

        if(!preg_match('/login|oauth/i',request()->url()))
            $response['request'] = request()->all();

        return response()->json($response, 200, [], JSON_UNESCAPED_SLASHES);
    }

    public static function successDelete($code,$data)
    {
        $response = [
            'status' => 'success',
            'code' => $code,
            'message' => $data
        ];

        return response()->json($response);
    }

}