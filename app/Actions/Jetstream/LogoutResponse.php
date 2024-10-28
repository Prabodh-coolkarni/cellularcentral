<?php

namespace App\Actions\Jetstream;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // Redirect to the index page after logout
        return redirect('/');  // Change '/' to any route if you want a different redirection
    return redirect('/');

}
}