<?php

namespace App\PublicApi\Presences\Queries;

use App\PublicApi\Presences\Filters\GreaterThanFilter;
use App\PublicApi\Presences\Filters\LowerThanFilter;
use Domain\Presence\Models\Presence;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class PresenceQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        parent::__construct($this->query(), $request);

        $this->filters();
        $this->sortings();
    }

    protected function query(): Builder
    {
        return Presence::query()
            ->with('player');
    }

    protected function filters(): self
    {
        return $this->allowedFilters([
            AllowedFilter::partial('name', 'player.name'),
            AllowedFilter::custom('joined_before', new LowerThanFilter, 'joined_at'),
            AllowedFilter::custom('joined_after', new GreaterThanFilter, 'joined_at'),
            AllowedFilter::custom('left_before', new LowerThanFilter, 'left_at'),
            AllowedFilter::custom('left_after', new GreaterThanFilter, 'left_at'),
            AllowedFilter::custom('updated_before', new LowerThanFilter, 'updated_at'),
            AllowedFilter::custom('updated_after', new GreaterThanFilter, 'updated_at'),
        ]);
    }

    protected function sortings(): self
    {

        return $this->defaultSort('-updated_at')
            ->allowedSorts([
                AllowedSort::field('updated_at'),
                AllowedSort::field('joined_at'),
                AllowedSort::field('-joined_at'),
                AllowedSort::field('left_at'),
                AllowedSort::field('-left_at'),

            ]);
    }
}
