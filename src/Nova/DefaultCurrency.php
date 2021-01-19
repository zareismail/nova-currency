<?php

namespace Zareismail\NovaCurrency\Nova; 

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;  
use Zareismail\NovaContracts\Nova\BiosResource; 

class DefaultCurrency extends BiosResource
{ 
    /**
     * The option storage driver name.
     *
     * @var string
     */
    public static $store = '';

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Select::make(__('Default Currency'), static::prefix('currency'))
                ->options(Currency::newModel()->get()->pluck('label', 'code'))
                ->displayUsingLabels(),
        ];
    }
}