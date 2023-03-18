<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FileController extends BaseController
{
    public function showMultipleModal(Request $request):View
    {
        return view('admin.general.upload-multiple-modal', [
            'type' => $request->type ?: 'images',
            'name' => $request->name
        ]);
    }

    public function storeMultipleFiles(Request $request)
    {
        $images = array();

        if ($request->hasfile('files') && $request->get('type') == 'images') {

            foreach ($request->file('files') as $key => $image) {

                $extension = $image->getClientOriginalExtension();

                if (!in_array(strtolower($extension), ['jpeg', 'jpg', 'png', 'svg']))
                    return $this->sendError('Загружайте только файлы форматов JPEG, PNG',200);

                if ($image->getSize() > 2097152)
                    return $this->sendError('Максимальный размер загружаемого файла ~ 2 МБ',200);

                $path = date('Y') . '/' . date('m') . '/' . date('d');

                try {
                    $filePath = Storage::disk('media')->putFile($path, $image);

                    $images[$key]['image'] = $filePath;
                    $images[$key]['path'] = '/media/' . $filePath;

                } catch (\Exception) {
                    return $this->sendError('Ошибка',200);
                }
            }

        }

        $view = view("admin.releases.image-list",compact('images'))->render();

        $result['status'] = true;
        $result['view'] = $view;
        $result['type'] = $request->get('type');
        return $result;
    }

    public function destroy(Request $request)
    {
        $path = $request->get('path');
        File::delete($path);

        $result['status'] = true;
        return $result;
    }
}
