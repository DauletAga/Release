<?php

namespace App\Utilities;

class ResponseUtilities
{
    /**
     * @param  string|null  $message
     * @param  mixed  $data
     *
     * @return array
     */
    public static function makeResponse(?string $message, $data): array
    {
        $res = [
            'data' => $data,
        ];

        if (!empty($message)) {
            $res['message'] = $message;
        }

        return $res;
    }

    /**
     * @param string  $message
     * @param array  $data
     *
     * @return array
     */
    public static function makeError(string $message, array $data = []): array
    {
        $res = [
            'message' => $message,
        ];

        if (!empty($data)) {
            $res['data'] = $data;
        }

        return $res;
    }
}