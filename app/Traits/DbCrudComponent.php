<?php

namespace App\Traits;

use Livewire\Component;

abstract class DbCrudComponent extends Component
{
    use InteractDbCrud;
}
