<?php

namespace App\Nova\Traits;

use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Number;

trait HasPriceFields
{
    public function priceFields(): array
    {
        return [
            Heading::make('Price Fields')
                ->hideFromIndex(),

            Currency::make('Price', 'price')
                ->rules('required', 'numeric', 'min:0')
                ->hideFromIndex(),

            Number::make('Discount Percentage', 'discount_percentage')
                ->rules('required', 'numeric', 'min:0', 'max:100')
                ->step(0.01)
                ->hideFromIndex()
                ->displayUsing(fn ($value) => $value . '%')
                ->default(0),

            Currency::make('Discount Amount', 'discount_amount')
                ->readonly()
                ->exceptOnForms()
                ->onlyOnDetail(),

            Currency::make('Price with Discount', 'price_with_discount')
                ->readonly()
                ->exceptOnForms()
                ->onlyOnDetail(),

            Number::make('Tax Percentage', 'tax_percentage')
                ->rules('required', 'numeric', 'min:0', 'max:100')
                ->step(0.01)
                ->hideFromIndex()
                ->displayUsing(fn ($value) => $value . '%')
                ->default(0),

            Currency::make('Tax Amount', 'tax_amount')
                ->readonly()
                ->exceptOnForms()
                ->onlyOnDetail(),

            Currency::make('Total Price', 'total_price')
                ->readonly()
                ->exceptOnForms()
                ->onlyOnDetail(),
        ];
    }
}
