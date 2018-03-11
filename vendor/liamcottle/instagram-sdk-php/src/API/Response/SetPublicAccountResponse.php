<?php

namespace Instagram\API\Response;

class SetPublicAccountResponse extends BaseResponse {

    /**
     * User
     * @var Model\User
     */
    protected $user;

    /**
     * @return Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param Model\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}