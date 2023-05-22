<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Log;
use Throwable;

class MediaService
{
    public function fromBase64(
        Model $model,
        mixed $attachments,
        string $collectionName = 'default'
    ): void {
        try {
            if (! $attachments) {
                return;
            }

            if (is_string($attachments)) {
                $attachments = [$attachments];
            }

            foreach ($attachments as $attachment) {
                $extension = explode('/', mime_content_type($attachment))[1];

                $model->addMediaFromBase64($attachment)
                    ->usingFileName(md5(time()).($extension ? ".$extension" : '.png'))
                    ->toMediaCollection($collectionName);
            }
        } catch (Throwable $exception) {
            Log::error($exception->getMessage(), ['Order', 'Attachments']);
        }
    }
}
