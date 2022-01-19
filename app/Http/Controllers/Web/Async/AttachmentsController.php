<?php

namespace App\Http\Controllers\Web\Async;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attachment;

class AttachmentsController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('filepond');
        $path = $file->store('attachments', [
            'disk' => 'public'
        ]);

        $attachment = Attachment::fromFile($file, $path);

        return $attachment->id;
    }


    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);

        $attachment->delete();
        
        return $attachment->id;
    }
}
