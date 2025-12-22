<?php
namespace App\View\Components\forminputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class StatusRadio extends Component
{

    public function __construct($value = 1) 
    {
        
    }

    public function render(): View|Closure|string
    {
        return view('components.forminputs.status-radio');
    }
}