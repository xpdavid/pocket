<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Attachment;


class PocketFileController extends Controller
{
    public function postUpload(Request $request, $id) {
        $this->validate($request, [
            'file' => 'required'
        ], [
            'file' => '必须要有文件, 大小无限制'
        ]);
        if (!$id) {
            abort(500);
        }
        $item = Item::findOrFail($id);
        $attachment = Attachment::createAttachment($request->file('file'));
        $item->attachments()->save($attachment);
    }
}
