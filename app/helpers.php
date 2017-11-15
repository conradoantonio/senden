<?php

if (! function_exists('success')) {
    /**
     * Return a new success response from the application.
     *
     * @param  string  $message
     * @param  array  $params
     * @return Response
     */
    function success($message, array $params = [])
    {
        return new App\Http\Response($message, $params);
    }
}

if (! function_exists('error')) {
    /**
     * Return a new error response from the application.
     *
     * @param  string  $message
     * @param  array  $params
     * @param  int  $status
     * @return Response
     */
    function error($message, array $params = [], $status = 400)
    {
        if ($status < 400) {
            throw new InvalidArgumentException('Status code can not be less than 400.');
        }

        return new App\Http\Response($message, $params, $status);
    }
}

if (! function_exists('cast_array_recursive')) {
    /**
     * Casts objects/arrays to pure arrays recursively.
     *
     * @param  mixed  $toCast
     * @return array
     */
    function cast_array_recursive($toCast)
    {
        return json_decode(json_encode($toCast), true);
    }
}

if (! function_exists('url_starts_with')) {
    /**
     * Returns a css class when url starts with given string.
     *
     * @param  string  $url
     * @param  string  $class
     * @return string
     */
    function url_starts_with($url, $class = 'active')
    {
        return starts_with(Request::path(), $url) ? $class : '';
    }
}
