<?php

namespace App\Http\Middleware;

use Closure;
use App\ConfirmationCode;

class EmailConfirmed
{
    public function handle($request, Closure $next)
    {
        if (! $email = $request->cookie(ConfirmationCode::EMAIL)) {
            return redirect()->route('confirmation-codes.create');
        }

        if(! $code = ConfirmationCode::where('email', $email)->first()) {
            return redirect()->route('confirmation-codes.create');
        }

        return $next($request);
    }
}
