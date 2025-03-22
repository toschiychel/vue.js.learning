<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $images = $data['images'];
        unset($data['images']);

        $post = Post::firstOrCreate($data);

        foreach ($images as $image) {
            $name = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);
            $previewName = 'prev_' . $name;

            Image::create([
                'path' => $filePath,
                'url' => url('/storage/' . $filePath),
                'preview_url' => url('/storage/images/' . $previewName),
                'post_id' => $post->id
            ]);

            $image = ImageManager::imagick()->read($image);
            $image->resize(100, 100)
                ->save(storage_path('app/public/images/' . $previewName));
        }
        return response(['message' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function edit(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();

        if (isset($data['images'])) {
            $images = $data['images'];
            unset($data['images']);
        }
        if (isset($data['image_ids_for_delete'])) {
            $imagesIdsForDelete = $data['image_ids_for_delete'];
            unset($data['image_ids_for_delete']);
        }
        if (isset($data['image_urls_for_delete'])) {
            $imagesUrlsForDelete = $data['image_urls_for_delete'];
            unset($data['image_urls_for_delete']);
        }

        if (isset($imagesUrlsForDelete)) {
            foreach ($imagesUrlsForDelete as $imagesUrlForDelete) {
                $removeStr = $request->root() . '/storage/';
                $path = str_replace($removeStr, '', $imagesUrlForDelete);
                Storage::disk('public')->delete($path);
            }
        }

        $currentImages = $post->images;
        if ($imagesIdsForDelete) {
            foreach ($currentImages as $currentImage) {
                if (in_array($currentImage->id, $imagesIdsForDelete)) {
                    Storage::disk('public')->delete($currentImage->path);
                    Storage::disk('public')->delete(str_replace('images/', 'images/prev_', $currentImage->path));
                    $currentImage->delete();
                }
            }
        }

        if (isset($images)) {
            foreach ($images as $image) {
                $name = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
                $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);
                $previewName = 'prev_' . $name;

                Image::create([
                    'path' => $filePath,
                    'url' => url('/storage/' . $filePath),
                    'preview_url' => url('/storage/images/' . $previewName),
                    'post_id' => $post->id
                ]);

                $image = ImageManager::imagick()->read($image);
                $image->resize(100, 100)
                    ->save(storage_path('app/public/images/' . $previewName));
            }
        }
        $post->update($data);
        return response(['message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
