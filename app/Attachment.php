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
        $attachment->createThumbnail($file);
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


    public function createThumbnail(UploadedFile $file) {
        if (in_arrayi($this->extension, self::$image_extension)) {
            Image::make($this->url)
                    ->fit(200)
                    ->save($this->thumb_url);
        } else {
            // else we print file name to the image
            $name_pic = explode('.' , $this->thumb_url);
            $this->thumb_url = $name_pic[0] . ".png";
            $img = Image::make(config('pocket.default_image'))
                ->text($file->getClientOriginalName(), 380, 310, function($font) {
                    $font->file('fonts/yaihei.ttf');
                    $font->size(50);
                    $font->align('center');
                    $font->valign('top');
                    $font->angle(45);
                })
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
