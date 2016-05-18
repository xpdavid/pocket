<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class Attachment extends Model
{
    protected $fillable = [
        'extension',
        'thumb_url',
        'url'
    ];

    protected $image_extension = [
        'png',
        'jpg',
        'jpeg'
    ];

    // belong to some item
    public function item() {
        return $this->belongsTo('App\Item');
    }

    static function createAttachment(UploadedFile $file) {
        self::storeAttachment($file);

        return $attachment;
    }

    static function storeAttachment(UploadedFile $file) {
        // encrypt the file name
        $name = sha1($file->getClientOriginalName() . time())
            . '.' .
            $file->getClientOriginalExtension();
        $file->move(config('pocket.upload_dir'), $name);

        // assing the url
        $attachment = new Attachment;
        $attachment->url = config('pocket.upload_dir') . $name;
        $attachment->extension = $file->getClientOriginalExtension();
    }

    static function createThumbnail($item) {
        
    }



    static function removeImage(Attachment $attachment) {
        File::delete($attachment->url);
        $attachment->delete();
    }
}
