<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\Qr;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\URL;

class ItemObserver
{
    public function created(Item $item)
    {
        $dataToEncode = URL::route('item.show', $item->id); 

        $qrImage = QrCode::format('png')
            ->size(250)
            ->margin(2)
            ->generate($dataToEncode);

        $folder = 'qrcodes';
        $fileName = "{$folder}/item_{$item->id}.png";

        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        Storage::disk('public')->put($fileName, $qrImage);

        Qr::create([
            'item_id' => $item->id,
            'file_path' => $fileName,
        ]);
    }
}
