<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class DiscoverController extends Controller
{
    public function getPackagesListing()
    {
        $packagesListing = Package::all();
        $locations = Package::distinct('location')->pluck('location')->toArray();

        return view('discover', compact('packagesListing', 'locations'));
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $location = $request->input('location');

        $queryBuilder = Package::query();

        // Filter by title
        if ($query) {
            $queryBuilder->where('title', 'like', '%' . $query . '%');
        }

        // Filter by price range
        if ($minPrice && $maxPrice) {
            $queryBuilder->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Filter by location
        if ($location) {
            $queryBuilder->where('location', $location);
        }

        $packagesListing = $queryBuilder->get();
        $locations = Package::distinct('location')->pluck('location')->toArray();

        return view('discover', compact('packagesListing', 'locations'));
    }
}
