<?php
/**
 * Define the Endpoints and API routes and functionalities.
 *
 *
 * @since      1.0.0
 * @package    WooCrud
 * @author     Soufiane <tr4him@gmail.com>
 */
if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');}

class WooCrudEndPoint {

    /**
     *  Register API routes
     */
    public function Register_Endpoint() {

        add_action( 'rest_api_init', function () {
            register_rest_route( 'wp/v2', '/current-user/(?P<user_id>\S+)/change_password', array(
                array(
                    'methods'  => WP_REST_Server::EDITABLE,
                    'callback'  => array($this, 'WP_update_user_password'),
                    'args' => [
                        'user_id'
                    ]
                )
            ));
        });
    }
    /**
     * Function to check if the old password is correct
     * Change connected user password
     */
    function WP_update_user_password(WP_REST_Request $request){

        if ( !is_user_logged_in() )
            return new WP_Error( 'Not_Authorized', 'Invalid Token', array( 'status' => 404 ) );

        $oldPassword    = $request['old_password'];
        $newPassword    = $request['new_password'];
        $user           = get_user_by( 'id', intval($request['user_id']) );

        if ( wp_check_password( $oldPassword, $user->user_pass, $request['id'] ) ) {
            wp_set_password( $newPassword, $request['id'] );
            return new WP_REST_Response([
                "success" => true,
                "message" => "Password updated successfully."
            ]);
        }
        else
            return new WP_Error( "wrong_old_password", "Old password doesn't match", array( 'status' => 404 ) );

    }
}
