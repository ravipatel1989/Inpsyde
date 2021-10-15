<?php
// include header of the theme
get_header();

$endpoint = USERLIST_ENDPOINT ? USERLIST_ENDPOINT : 'https://jsonplaceholder.typicode.com/';
$usersendpoing = $endpoint.'users';
$request = wp_remote_get( $usersendpoing );

if( is_wp_error( $request ) ) {
	return false; // Bail early
}
$body = wp_remote_retrieve_body( $request );


?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="userList">
            <table id="userList" class="display">
                <thead>
                    <tr>
                        <th><?php _e('id','userlist_api');?></th>
                        <th><?php _e('name','userlist_api');?></th>
                        <th><?php _e('username','userlist_api');?></th>
                        <th><?php _e('email','userlist_api');?></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $users = json_decode($body, true);
                if(is_array($users) && !empty($users)){
                foreach($users as $user): ?>
                    <tr class="userdata" data-id="<?php echo $user['id'];?>">
                        <td><?php _e($user['id'],'userlist_api');?></td>
                        <td><?php _e($user['name'],'userlist_api');?></td>
                        <td><?php _e($user['username'],'userlist_api');?></td>
                        <td><?php _e($user['email'],'userlist_api');?></td>
                    </tr>
                <?php endforeach; 
                }
                ?>
                </tbody>
            </table>
            </div>
            <div class="userDetails">
                <div class="backtolist">
                    <div class="innerlist">
                        <button class="userdata" data-id="0">Back</button>
                    </div>
                </div>
                <div class="resuserdata">

                </div>                
            </div>
        </div>
    </div>
</div>
<?php
// include footer of the theme
get_footer();
?>