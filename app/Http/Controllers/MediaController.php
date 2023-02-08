<?php

namespace App\Http\Controllers;

use App\Contracts\StorageContract;
use App\Utilities\ResponseUtilities;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Response;

class MediaController extends BaseController
{
	public function showModal(Request $request)
	{
        return view('admin.general.upload-modal',[
            'type' => $request->type?:'img',
            'name' => $request->name
        ]);
	}

    public function showMedia($fileName)
    {
        $path = storage_path('app/media/'.$fileName);

        if(!File::exists($path)){
            $path = public_path('/custom/img/default.jpg');
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $lifetime = 10000000;

        $filetime = filemtime($path);
        $etag = md5($filetime . $path);
        $time = gmdate('r', $filetime);
        $expires = gmdate('r', $filetime + $lifetime);

        $headers['Content-Type'] = $type;
        $headers['Content-Disposition'] = 'inline; filename="' . $fileName . '"';
        $headers['Last-Modified'] = $time;
        $headers['Cache-Control'] = 'must-revalidate';
        $headers['Expires'] = $expires;
        $headers['Pragma'] = 'public';
        $headers['Etag'] = $etag;
        return $response->withHeaders($headers);
    }


    public function uploadFile(Request $request)
    {
        $file = $request->file('media');
        $file_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        if ($file == null)
            return $this->sendError('Укажите файл для загрузки');

        if($request->type == 'img' && !in_array(strtolower($extension), ['jpeg', 'jpg', 'png', 'svg']))
            return $this->sendError('Загружайте только файлы форматов JPEG, PNG');

        if($file->getSize() > 2097152)
            return $this->sendError('Максимальный размер загружаемого файла ~ 2 МБ');


        $path = '/'.date('Y').'/'.date('m').'/'.date('d');
        $file_name = $path .'/' .$file_name;

        try {
            if(Storage::disk('media')->exists($file_name)){
                $now = \DateTime::createFromFormat('U.u', microtime(true));
                $file_name = $path .'/' .$now->format("Hisu").'.'.$extension;
            }

            Storage::disk('media')->put($file_name,  File::get($file));
        }
        catch (\Exception $exception){
            return $this->sendError('Ошибка');
        }

        $result['status'] = true;
        $result['name'] = '/media'.$file_name;
        return $result;
    }
}
