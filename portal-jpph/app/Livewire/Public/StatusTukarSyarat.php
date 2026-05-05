<?php

namespace App\Livewire\Public;

use App\Models\CaseTukarSyarat;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StatusTukarSyarat extends Component
{
    #[Url(as: 'ref')]
    #[Validate(['required', 'regex:/^JPPH\/TS\/\d{4}\/\d{5}$/i'])]
    public string $reference = '';

    public ?CaseTukarSyarat $result = null;

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
            $this->error = __('Format rujukan tidak sah. Contoh yang sah: JPPH/TS/2026/00789');
            return;
        }

        $hit = CaseTukarSyarat::where('no_rujukan', $this->reference)->first();
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
        return view('livewire.public.status-tukar-syarat');
    }
}
