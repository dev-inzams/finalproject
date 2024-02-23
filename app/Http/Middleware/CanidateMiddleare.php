<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanidateMiddleare {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle( Request $request, Closure $next ): Response {
        $token = $request->cookie( 'token' );
        $result = JWTToken::VerifyToken( $token );
        if ( $result == 'unauthorized' ) {
            return redirect( '/login' );
        } else if ( $result->type == 'canidate' ) {
            return $next( $request );
        } else {
            return redirect( '/login' );
        }
    }
}
