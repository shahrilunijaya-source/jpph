<?php

namespace App\Livewire\Public;

use App\Models\CaseDutiSetem;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StatusDutiSetem extends Component
{
    #[Url(as: 'ref')]
    #[Validate(['required', 'regex:/^JPPH\/DS\/\d{4}\/\d{5}$/i'])]
    public string $reference = '';

    public ?CaseDutiSetem $result = null;

    public ?string $error = null;

    public bool $searched = false;

    public function mount(): void
    {
        if ($this->reference) {
            $this->lookup();
        }
    }

    public function lookup(): void
    {
        $this->error = null;
        $this->result = null;
        $this->searched = true;

        $this->reference = strtoupper(trim($this->reference));

        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->error = __('Format rujukan tidak sah. Contoh yang sah: JPPH/DS/2026/00123');
            return;
        }

        $hit = CaseDutiSetem::where('no_rujukan', $this->reference)->first();
        if (! $hit) {
            $this->error = __('Tiada rekod dijumpai untuk rujukan ini. Sila semak semula nombor rujukan anda.');
            return;
        }

        $this->result = $hit;
    }

    public function clearForm(): void
    {
        $this->reference = '';
        $this->result = null;
        $this->error = null;
        $this->searched = false;
    }

    public function render()
    {
        return view('livewire.public.status-duti-setem');
    }
}
