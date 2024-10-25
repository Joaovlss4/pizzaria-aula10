<?php

namespace App\Services;

use App\Http\Requests\FlavorCreatRequest;
use Illuminate\Http\Request;

interface FlavorServiceInterface
{
    public function getAllFlavors();
    public function createFlavor(FlavorCreatRequest $request);
    public function getFlavorById(string $id);
    public function updateFlavor(Request $request, string $id);
    public function deleteFlavor(string $id);
}
