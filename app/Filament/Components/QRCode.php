<?php

namespace App\Filament\Components;

use Filament\Forms\Components\Component;
use Illuminate\Contracts\View\View;

class QRCode extends Component
{
    public function render(): View
    {
        return view('filament.fields.qr-code');
    }

    public function getQRCode()
    {
        $this->getRecordId();
    }

    private function getRecordId() {}
}
