<?php

use Livewire\Volt\Component;

new class extends Component {
    public $search = null;
    public $users = [];

    public function mount()
    {
        $this->reset();
    }
    public function updatedSearch()
    {
        if (!empty($this->search)) {
            $this->users = App\Models\User::query()
                ->where('name', 'like', "%{$this->search}%")
                ->get()
                ->toArray();
        } else {
            $this->reset();
        }
        sleep(1);
    }
}; ?>

<div>
    <h1>Search</h1>

    <x-text-input wire:model.live.debounce.500ms="search" id="name" name="name" type="text"
        class="mt-1 block w-full" />
    <!-- component -->
    <div class="inline-flex flex-col justify-center relative text-gray-500 w-full">

        <div class="w-full mt-2 justify-center flex">
            <p wire:loading>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
                    <circle fill="#FF156D" stroke="#FF156D" stroke-width="15" r="15" cx="40" cy="65">
                        <animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;"
                            keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4"></animate>
                    </circle>
                    <circle fill="#FF156D" stroke="#FF156D" stroke-width="15" r="15" cx="100" cy="65">
                        <animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;"
                            keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2"></animate>
                    </circle>
                    <circle fill="#FF156D" stroke="#FF156D" stroke-width="15" r="15" cx="160" cy="65">
                        <animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;"
                            keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="0"></animate>
                    </circle>
                </svg>
                Processing...
            </p>
        </div>

        @if (!empty($search))

            <ul class="bg-white border border-gray-100 w-full mt-2">


                @forelse ($users as $user)
                    <li
                        class="p-5 pr-2 ml-3 py-1 border-b-2 border-gray-100 relative cursor-pointer hover:bg-yellow-50 hover:text-gray-900 ">

                        <b>{{ $user['name'] }}</b>
                    </li>
                @empty
                    <li
                        class="pl-8 ml-3 pr-2 py-1 border-b-2 border-gray-100 relative cursor-pointer hover:bg-yellow-50 hover:text-gray-900 ">

                        <b>No users found</b>
                    </li>
                @endforelse


            </ul>
        @endif

    </div>
</div>

</div>
