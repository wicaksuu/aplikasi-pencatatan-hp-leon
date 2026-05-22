<?php

use App\Models\Platform;

$map = [
    'Shopee' => '#ee4d2d',
    'Tokopedia' => '#00AA5B',
    'TikTok Shop' => '#94a3b8',
    'Lazada' => '#1c26b8',
    'WhatsApp' => '#25D366',
];
foreach ($map as $name => $color) {
    $p = Platform::where('name', $name)->first();
    if ($p) {
        $p->color = $color;
        $p->save();
    }
}
echo "Done\n";
