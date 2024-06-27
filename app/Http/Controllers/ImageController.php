<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest; // Import StoreImageRequest for validation
use App\Http\Requests\UpdateImageRequest; // Import UpdateImageRequest for validation
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Use Storage facade for file operations
use Intervention\Image\ImageManager; // Use Intervention Image for image manipulation

class ImageController extends Controller
{
    /**
     * Display a listing of the images.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();

        return view('images.index', compact('images'));
    }

    /**
     * Show the form for creating a new image.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created image in storage.
     *
     * @param  StoreImageRequest  $request  Validated request object
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageRequest $request) // Use validated request object
    {
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $fileExtension = $file->getClientOriginalExtension();
        $newFileName = uniqid() . '.' . $fileExtension;

        // Resize and save the image
        $image = ImageManager::make($file->getRealPath());
        $image->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path('app/public/images/' . $newFileName));

        // Create a new Image record in the database
        Image::create([
            'name' => $fileName,
            'path' => 'images/' . $newFileName,
        ]);

        return Redirect::route('images.index')->with('success', 'Image uploaded successfully!');
    }

    /**
     * Display the specified image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return abort(404);
        }

        return view('images.show', compact('image'));
    }

    /**
     * Show the form for editing the specified image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return abort(404);
        }

        return view('images.edit', compact('image'));
    }

    /**
     * Update the specified image in storage.
     *
     * @param  UpdateImageRequest  $request  Validated request object
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageRequest $request, $id) // Use validated request object
    {
        $image = Image::find($id);

        if (!$image) {
            return abort(404);
        }

        $file = $request->file('image');

        if ($file) {
            // Delete the existing image file
            Storage::delete('app/public/' . $image->path);

            // Upload and resize the new image
            $fileName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $newFileName = uniqid() . '.' . $fileExtension;

            $imageManager = new ImageManager();
            $image = $imageManager->make($file->getRealPath());
            $image->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/images/' . $newFileName));

            // Update the image record in the database
            $image->update([
                'name' => $fileName,
                'path' => 'images/' . $newFileName,
            ]);
        }

        return Redirect::route('images.show', $image->id)->with('success', 'Image updated successfully!');
    }

    /**
     * Remove the specified image from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return abort(404);
        }

        // Delete the image file from storage
        Storage::delete('app/public/' . $image->path);

        // Delete the image record from the database
        $image->delete();

        return Redirect::route('images.index')->with('success', 'Image deleted successfully!');
    }
}