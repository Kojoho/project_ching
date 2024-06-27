<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    //
    public function index()
    {
        $assets = Asset::all();

        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        return view('assets.create');
    }

    public function store(Request $request)
    {
        $asset = Asset::create([
            'asset_type' => $request->input('asset_type'),
            'asset_name' => $request->input('asset_name'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->route('assets.index');
    }

    public function edit($id)
    {
        $asset = Asset::find($id);

        return view('assets.edit', compact('asset'));
    }

    public function update(Request $request, $id)
    {
        $asset = Asset::find($id);

        $asset->update([
            'asset_type' => $request->input('asset_type'),
            'asset_name' => $request->input('asset_name'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'), // Use the actual form field name for quantity
        ]);
    }
}