<?php

namespace App\repository;

interface CRUDInterface {
    public function create($entitie):bool;
    public function update($entitie):bool;
    public function getBy(string $by,string $search);
    public function getAll():array|null;
    public function delete($entitie):bool;
}