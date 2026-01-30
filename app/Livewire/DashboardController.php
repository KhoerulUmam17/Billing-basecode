<?php

namespace App\Livewire;

use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DashboardController extends Component
{
    use LivewireAlert;

    public function changeLang($lang)
    {
        $message = [
            'id' => 'Anda memakai bahasa indonesia',
            'en' => 'You already use English',
        ];
        Session::put('locale', $lang);
        $this->flash('success', $message[$lang], [
            'position' => 'top',
            'timer' => 3000,
            'toast' => true,
        ], redirect()->back());

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.dashboard-controller');
    }
}
