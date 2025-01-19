<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PetController extends Controller
{
  private string $apiUrl = 'https://petstore.swagger.io/v2';

  public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
  {
    try {
      $response = Http::get("{$this->apiUrl}/pet/findByStatus?status=available");
      $pets = json_decode($response);

      if ($response->status() !== 200) {
        throw new \Exception($response->body(), $response->status());
      }
    } catch (\Exception $exception) {
      Log::error($exception->getMessage());
      return view('pets.index', ['pets' => [], 'error' => $exception->getMessage()]);
    }
    return view('pets.index', ['pets' => $pets]);
  }

  public function create(): \Illuminate\Contracts\View\View
  {
    return view('pets.create');
  }

  public function store(PetRequest $request): \Illuminate\Http\RedirectResponse
  {
    try {
      $response = Http::post("{$this->apiUrl}/pet", [
        'name' => $request->validated()['name'],
        'category' => ['name' => $request->validated()['category']],
        'photoUrls' => [$request->validated('photoUrl')],
        'status' => $request->validated()['status'],
      ]);

      if ($response->status() !== 200) {
        throw new \Exception($response->body(), $response->status());
      }
    } catch (\Exception $exception) {
      Log::error($exception->getMessage());
      return redirect()->back()->withErrors(['error' => $exception->getMessage()])->withInput();
    }
    return redirect()->route('pets.index')->with('success', true);
  }

  public function edit($petId): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
  {
    $response = Http::get("{$this->apiUrl}/pet/{$petId}");

    if($response->status() !== 200) {
      abort($response->status(), $response->body());
    }

    $pet = json_decode($response);

    return view('pets.edit', ['pet' => $pet]);
  }

  public function update(PetRequest $request): \Illuminate\Http\RedirectResponse
  {
    try {
      $response = Http::put("{$this->apiUrl}/pet", [
        'id' => $request->validated('id'),
        'name' => $request->validated('name'),
        'category' => ['name' => $request->validated('category')],
        'photoUrls' => [$request->validated('photoUrl')],
        'status' => $request->validated('status'),
      ]);

      if ($response->status() !== 200) {
        throw new \Exception($response->body(), $response->status());
      }
    } catch (\Exception $exception) {
      Log::error($exception->getMessage());
      return redirect()->back()->withErrors(['error' => $exception->getMessage()])->withInput();
    }
    return redirect()->route('pets.index');
  }

  public function delete($petId): \Illuminate\Http\JsonResponse
  {
    try {
      $response = Http::delete("{$this->apiUrl}/pet/{$petId}");

      if ($response->status() !== 200) {
        throw new \Exception($response->body(), $response->status());
      }
    } catch (\Exception $exception) {
      Log::error($exception->getMessage());
      return response()->json(['error' => $exception->getMessage()], 500);
    }
    return response()->json(['success' => true], 200);
  }
}
