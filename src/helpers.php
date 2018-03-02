<?php
/************************************************************
 * Package: Laranotify
 * Description: A Laravel notification box using bootstrap.
 * Author: Josiah O. Yahaya
 * Email: josiahoyahaya@gmail.com
 * Version: 1.0.0
 ************************************************************/

/**
 * @return \Illuminate\Foundation\Application|mixed
 */
if (!function_exists('notify')) {
    function notify($message = '')
    {
        if ($message != '') {
            return app('Notify')->message($message);
        }
        return app('Notify');
    }
}
/**
 * @param string $message
 * @return \Illuminate\Foundation\Application|mixed
 */
function laranotify($message = '')
{
    if ($message != '') {
        return app('Laranotify')->message($message);
    }
    return app('Laranotify');
}

/**
 * @return \Illuminate\Foundation\Application|mixed
 */
function ln_config()
{
    return app('LNConfig');
}

/**
 * Css Files
 * @param boolean $use_foundations
 * @return mixed
 */
function notify_header($use_foundations = false)
{
    return ln_config()->getHeader($use_foundations);
}

/**
 * Js Files
 * @param boolean $use_foundations
 * @return mixed
 */
function notify_footer($use_foundations = false)
{
    return ln_config()->getFooter($use_foundations);
}




