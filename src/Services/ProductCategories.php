<?php

namespace App\Services;

use App\Repository\ProductCategoryRepository;

class ProductCategories {

    public function __construct(
        private ProductCategoryRepository $repo
    ){
    }

    public function getAll(){
        return $this->repo->findAll();
    }

}