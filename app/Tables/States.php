<?php

namespace App\Tables;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\AbstractTable;
use Spatie\QueryBuilder\AllowedFilter;

class states extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('country_id', 'LIKE', "%{$value}%");
                });
            });
        });

        return QueryBuilder::for(State::class)
            ->defaultSort('id')
            ->allowedSorts(['id', 'country_id', 'name', 'created_at'])
            ->allowedFilters(['id', 'country_id', 'name', 'created_at', $globalSearch]);
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id', 'country_id', 'name'])
            ->column('id', sortable: true)
            ->column('name', sortable: true)
            ->column(key: 'country.name', label:'Country')
            ->column('created_at', sortable: true)
            ->column('action')
            ->selectFilter(
                key: 'country_id',
                options: Country::pluck('name', 'id')->toArray(),    // Show the name first
                label: 'Country'
            )
            ->paginate(15);
    }
}
