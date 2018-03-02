<?php
/*****************************************************************
 * Package: Laranotify
 * Description: A Laravel notification box using bootstrap.
 * Author: Josiah O. Yahaya
 * Email: josiahoyahaya@gmail.com
 * Version: 1.0.0
 ******************************************************************/



return [

    /**
     * The bootstrap version you are using.
     * Default is version 3.0
     */
    'bs_version' => 3.0,
    /**
     * The container to hold notifications.
     * This is always used to put $.notify in a session
     */
    'container' => 'laranotify',
    /**
     * Set your template here.
     * Default template will be loaded from pacakge views folder.
     */
    'template' => '',

];