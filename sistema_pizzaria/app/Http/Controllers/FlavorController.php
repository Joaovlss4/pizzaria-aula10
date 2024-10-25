<?php

namespace App\Http\Controllers;

use App\Services\FlavorServiceInterface;
use App\Http\Requests\{
    FlavorCreatRequest
};
use Illuminate\Http\Request;

/**
 * Class FlavorController
 *
 * @package App\Http\Controllers
 * @author Vinícius Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 2024-10-01 15:52:04
 * @copyright UniEVANGÉLICA
 */
class FlavorController extends Controller
{
    private $flavorService;

    public function __construct(FlavorServiceInterface $flavorService)
    {
        $this->flavorService = $flavorService;
    }

    public function index()
    {
        return [
            'status' => 200,
            'message' => 'Sabores encontrados!',
            'sabores' => $this->flavorService->getAllFlavors()
        ];
    }

    public function store(FlavorCreatRequest $request)
    {
        $flavor = $this->flavorService->createFlavor($request);

        return [
            'status' => 200,
            'message' => 'Sabor cadastrado com sucesso!',
            'sabor' => $flavor
        ];
    }

    public function show(string $id)
    {
        $flavor = $this->flavorService->getFlavorById($id);

        return $flavor
            ? ['status' => 200, 'message' => 'Sabor encontrado com sucesso!', 'sabor' => $flavor]
            : ['status' => 404, 'message' => 'Sabor não encontrado!'];
    }

    public function update(Request $request, string $id)
    {
        $flavor = $this->flavorService->updateFlavor($request, $id);

        return $flavor
            ? ['status' => 200, 'message' => 'Sabor atualizado com sucesso!', 'sabor' => $flavor]
            : ['status' => 404, 'message' => 'Sabor não encontrado!'];
    }

    public function destroy(string $id)
    {
        $deleted = $this->flavorService->deleteFlavor($id);

        return $deleted
            ? ['status' => 200, 'message' => 'Sabor deletado com sucesso!']
            : ['status' => 404, 'message' => 'Sabor não encontrado!'];
    }
}