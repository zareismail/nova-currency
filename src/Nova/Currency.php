<?php

namespace Zareismail\NovaCurrency\Nova; 

use Illuminate\Http\Request;
use Laravel\Nova\Fields\{ID, Text, Number, Boolean, Currency as Money}; 
use Zareismail\NovaContracts\Nova\Resource; 

class Currency extends Resource
{  
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Zareismail\NovaCurrency\Models\NovaCurrency::class; 

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'label';

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
    	return [
    		ID::make(),

            Text::make(__('Display Name'), 'label')
                ->required()
                ->rules('required'),

            Text::make(__('Currency Code'), 'code')
                ->required()
                ->rules('required'),

            Text::make(__('Currency Symbol'), 'symbol')
                ->required()
                ->rules('required'),

            Text::make(__('Thousands Separator'), 'separator')
                ->required()
                ->rules('required')
                ->default(',')
                ->hideFromIndex(),

            Text::make(__('Decimal Separator'), 'point')
                ->required()
                ->rules('required')
                ->default('.')
                ->hideFromIndex(),

            Number::make(__('Decimals'), 'decimal')
                ->required()
                ->rules('required')
                ->default(2),

            Number::make(__('Exchange Rate'), 'exchange_rate')
                ->required()
                ->rules('required')
                ->default(1)
                ->step(0.1)
                ->hideFromIndex(),

            Text::make(__('Number Format'), function() {
                return number_format(10252648.0235, $this->decimal, $this->point, $this->separator);
            }),

            Boolean::make(__('Enable'), 'enabled') 
                ->default(true),
    	];
    } 
}