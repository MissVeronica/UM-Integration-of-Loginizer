<?php
add_filter( 'um_custom_authenticate_error_codes', 'um_custom_authenticate_error_codes_loginizer', 10, 1 );

function um_custom_authenticate_error_codes_loginizer( $array ) {

    return array( 'ip_blocked', 'ip_blacklisted' );
}

add_filter( 'authenticate', 'loginizer_um_integration', 10002, 1 );

function loginizer_um_integration( $loginizer ) {

    if ( ! empty( $loginizer )) {
        if ( $loginizer->get_error_code() == 'ip_blocked' || 
             $loginizer->get_error_code() == 'ip_blacklisted' ) {

            if ( isset( UM()->form()->errors['user_password'] ) ) {
                unset( UM()->form()->errors['user_password'] );
            }
        }
    }
    return $loginizer;
}
