<?php

class HttpHelper {
    public static function responseJson($code, $message, $data = [])
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    public static function validationError($errors, $message = "Unprocessable entity") {
        return HttpHelper::responseJson(422, $message, $errors);
    }
}

?>