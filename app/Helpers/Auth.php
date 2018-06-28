<?php

if ( ! function_exists('isLineManager')) {
    function isLineManager($currentUserId, $requestedUser)
    {
        return in_array($currentUserId, $requestedUser->getLineManagers()->toArray());
    }
}
