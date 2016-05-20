<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;
use Image;

class Attachment extends Model
{
    protected $fillable = [
        'extension',
        'thumb_url',
        'url'
    ];

    public static $image_extension = [
        'png',
        'jpg',
        'jpeg'
    ];

    // belong to some item
    public function item() {
        return $this->belongsTo('App\Item');
    }

    static function createAttachment(UploadedFile $file) {
        $attachment = self::storeAttachment($file);
        // if it is the image then create thumbnail
        $attachment->createThumbnail();
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
        $attachment->url = sprintf("%s%s", config('pocket.upload_dir'), $name);
        $attachment->extension = $file->getClientOriginalExtension();
        $attachment->thumb_url = sprintf("%sth-%s", config('pocket.upload_dir'), $name);

        return $attachment;
    }


    public function createThumbnail() {
        if (in_arrayi($this->extension, self::$image_extension)) {
            Image::make($this->url)
                    ->fit(200)
                    ->save($this->thumb_url);
        }
    }

    /**
     * Override delete function to delete relevant file
     * @throws \Exception
     */
    public function delete() {
        File::delete([
            $this->thumb_url,
            $this->url
        ]);

        parent::delete();
    }


}
