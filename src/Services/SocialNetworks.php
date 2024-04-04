<?php

namespace App\Services;

use App\Repository\SocialNetworkRepository;

class SocialNetworks {

    public function __construct(
        private SocialNetworkRepository $sn
    ){
    }

    public function getAll(){
        return $this->sn->findAll();
    }

}