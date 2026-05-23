<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class MediaController extends Controller
{
    public function store(UploadFileRequest $request, $model, $id){
        if(!in_array($model, ['Project', 'Task'])){
            abort(404);
        }

        $modelClass = 'App\Models\\' . $model;

        $record = $modelClass::findOrFail($id);

        $record->addMediaFromRequest('file')->usingName($request->file('file')->getClientOriginalName())->toMediaCollection('attachments', 'local');

        return redirect()->back()->with('status', 'Tải file lên thành công.');
    }

    public function download(Media $media) {
        return response()->download(
            $media->getPath(),
            $media->file_name
        );
    }

    public function destroy($model, $id, Media $media) {
        $media->delete();

        return redirect()->back()->with('status', 'Xóa file thành công');
    }
}
