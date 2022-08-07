<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use App\Models\Attachment;

trait HasAttachment
{
    public function addAttachment(null|UploadedFile $attachment, string $group='')
    {
        if (!$attachment) {
            return;
        }

        $disk = 'attachments';
        $type = $this->determineType($attachment->extension());
        $disk = Attachment::disk($type);
        $path = $attachment->store('', $disk);

        $this->$group()->create([
            'name' => $path,
            'original_name' => $attachment->getClientOriginalName(),
            'type' => $type,
            'size' => $attachment->getSize()
        ]);
    }

    private function determineType($ext)
    {
        if (in_array($ext, ['jpeg','gif','png', 'jpg'])) {
            $type = 'image';
        } else if (in_array($ext, ['doc', 'docx', 'pdf'])) {
            $type = 'document';
        } else if (in_array($ext, ['mov','mp4','avi','ogg','wmv','webm','mkv'])) {
            $type = 'video';
        } else {
            $type = 'file';
        }

        return $type;
    }
}
