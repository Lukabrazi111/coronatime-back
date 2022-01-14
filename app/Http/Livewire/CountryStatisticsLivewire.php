<?php

namespace App\Http\Livewire;

use App\Models\CountryStatistics;
use Livewire\Component;

class CountryStatisticsLivewire extends Component
{
    public $search;
    public $sortField;
    public $sortAsc = true;

    protected $queryString = ['search'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.country-statistics-livewire', [
            'countries' => CountryStatistics::where('name', 'like', '%' . $this->search . '%')
                ->when($this->sortField, function ($query) {
                    return $query->orderBy(
                        $this->sortField === 'name' ?
                            $this->sortField . '->' . session()->get('locale', 'en') :
                            $this->sortField,
                        $this->sortAsc ? 'asc' : 'desc',
                    );
                })->when($this->sortField, function($query) {
                    return $query->orderBy($this->sortAsc ? 'asc' : 'desc');
                })->when($this->sortField, function($query) {
                    return $query->orderBy($this->sortAsc ? 'asc' : 'desc');
                })->when($this->sortField, function($query) {
                    return $query->orderBy($this->sortAsc ? 'asc' : 'desc');
                })->get(),
        ]);
    }
}
