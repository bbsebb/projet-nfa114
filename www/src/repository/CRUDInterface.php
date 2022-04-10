<?php

namespace App\repository;

interface CRUDInterface {
    public function create($entitie);
    public function update($entitie):bool;
    public function getBy(string $by,string $search);
    public function getByAll():array|null;
    public function delete($entitie):bool;
}