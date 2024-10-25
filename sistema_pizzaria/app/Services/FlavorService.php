<?php

namespace App\Services;

use App\Http\Enums\TamanhoEnum;
use App\Http\Requests\FlavorCreatRequest;
use App\Models\Flavor;
use Illuminate\Http\Request;

class FlavorService implements FlavorServiceInterface
{
    public function getAllFlavors()
    {
        return Flavor::select('id', 'sabor', 'preco', 'tamanho')->paginate(10);
    }

    public function createFlavor(FlavorCreatRequest $request)
    {
        $data = $request->all();

        return Flavor::create([
            'sabor' => $data['sabor'],
            'preco' => $data['preco'],
            'tamanho' => TamanhoEnum::from($data['tamanho']),
        ]);
    }

    public function getFlavorById(string $id)
    {
        return Flavor::find($id);
    }

    public function updateFlavor(Request $request, string $id)
    {
        $flavor = Flavor::find($id);
        if ($flavor) {
            $flavor->update($request->all());
        }
        return $flavor;
    }

    public function deleteFlavor(string $id)
    {
        $flavor = Flavor::find($id);
        if ($flavor) {
            $flavor->delete();
        }
        return $flavor;
    }
}
