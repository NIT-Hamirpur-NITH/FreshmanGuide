<?php

namespace FreshmanGuide\Http\Controllers;
use Log;

use Illuminate\Http\Request;

use FreshmanGuide\Http\Requests;
use FreshmanGuide\Article;
use Image;

class ImageController extends Controller {

    public function upload(Request $request) {
        try {
            $image = $request->file('image');
            $extension =   $image->getClientOriginalExtension();
            $imageRealPath  =   $image->getRealPath();
            $imageName =   $image->getClientOriginalName();
            $img = Image::make($imageRealPath);
            $org = $img->save(public_path('uploads/org/' . $imageName));
            if($org) {
                $draft = $img->save(public_path('uploads/draft/' . $imageName), 50);
                if ($draft) {
                    return response()->json([
                        'url' => asset('uploads/draft/' . $imageName),
                        'name' => $imageName,
                        'size' => [$draft->width(),$draft->height()]
                    ], 200);
                } else {
                    throw new \Exception("Can not save draft image", 1);
                } 
            } else {
                throw new \Exception("Can not save original image", 1);
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
        
    }

    public function rotate(Request $request) {

        try {
            $imageName = $request->input('name');
            // var_dump($request->all());
            $path = public_path('uploads/draft/' . $imageName);
            $img = Image::make($path);
            $angle = $request->input('direction') == 'CCW' ? -90 : 90;
            $rotated = $img->rotate($angle)->save(public_path('uploads/draft/' . $imageName), 100);
            if ($rotated) {
                return response()->json([
                    'url' => asset('uploads/draft/' . $imageName),
                    'size' => [$rotated->width(),$rotated->height()]
                ], 200);
            } else {
                throw new \Exception("Can not save image", 1);
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

    }


    public function insert(Request $request) {
        try {
            $imageName = $request->input('name');
            $path = public_path('uploads/draft/' . $imageName);
            $img = Image::make($path);
            $height = $img->height();
            $width = $img->width();
            $iWidth = $request->input('width');

            if ($request->has('crop')) {
                $vals = explode(',', $request->input('crop'));
                $top = floor($height * $vals[0]);
                $left = floor($width * $vals[1]);
                $bottom = floor($height * $vals[2]);
                $right = floor($width * $vals[3]);
                $crWidth = $right - $left;
                $iWidth = $crWidth < $iWidth ? $crWidth : $iWidth;

                $img = $img->crop($right - $left, $bottom - $top, $left, $top)->save(public_path('uploads/draft/' . $imageName), 100);
            }


            $img->resize($iWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/draft/' . $imageName), 100);

            if ($img) {
                return response()->json([
                    'url' => asset('uploads/draft/' . $imageName),
                    'size' => [$img->width(),$img->height()]
                ], 200);
            } else {
                throw new \Exception("Can not save image", 1);
            }


        }  catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }


    public function onsave(Request $request) {
        try {
            $images = json_decode($request->input('images'), true);
            foreach ($images as $image => $width) {
                $vals = explode(parse_url(url, PHP_URL_PATH));
                $imageName = $vals[count($vals) - 1];
                $path = public_path('uploads/draft/' . $imageName);
                $img = Image::make($path);
                $img->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/draft/' . $imageName), 100);;
            }

            return response('All images resized', 200);
        }  catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

}