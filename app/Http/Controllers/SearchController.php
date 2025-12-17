<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class SearchController extends Controller
{
    public function index(Request $request){
        try {
        
        $query = Str::lower($request->string('q'));


        $results = collect(config('search-results'))
            ->filter(function ($item) use ($query) {
                if (! collect($item['keywords'])
                    ->contains(fn ($k) => Str::contains($k, $query))) {
                    return false;
                }

                [$model, $ability] = $item['policy'];

                return Gate::allows($ability, app("App\\Models\\$model"));
            })
            ->map(fn ($item) => [
                'label' => $item['label'],
                'url' => route($item['route']),
            ])
            ->values();

        return response()->json($results);
        }
        catch (\Throwable $th) {
            return response()->json([], 500);
        }

    }
}