<?php

namespace App\Services;

use App\Repository\CompanyDataRepository;

class CompanyDetails {

    public function __construct(
        private CompanyDataRepository $dataRepo
    ){
    }

    public function getData(){
        return $this->dataRepo->findOneBy(['id' => 1]);
    }

}