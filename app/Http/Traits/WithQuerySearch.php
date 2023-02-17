<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

trait WithQuerySearch
{
    /**
     * Get by search option
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $search
     * @param [type] $order
     * @param boolean $isSelect
     * @param integer $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchOptions($query, $search = '', $order = null, $isSelect = true, $type = 1, $byId = '')
    {
        list($columns, $searchColumns,$order) = $this->getSearchParams($order);
        $query->select($columns)->where(function ($q) use ($search, $searchColumns, $type, $byId) {
            if (trim($search) != '') {
                foreach ($searchColumns as $column) {
                    if ($byId) {
                        $q->orWhere("id", $byId);
                    }
                    if ($column!='id') {
                        $type==1 ? $q->orWhere($column, 'LIKE', '%'.$search.'%') :
                        $q->orWhere($column, 'LIKE', $search.'%');
                    }
                }
            }
        });
        return $isSelect ? $query->orderBy($order)->limit(8) : $query;
    }

    /**
     * is selected value exists
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSelected($query,Request $request)
    {
        return $query->when(
            $request->exists('selected'),
            fn (Builder $query) => $query->whereIn($request->input('optionValue', 'id'), $request->input('selected', [])),
            fn (Builder $query) => $query->limit(10)
        );
    }

    private function getSearchParams($order){
        $columns = isset($this->selectColumns) ? $this->selectColumns : Schema::getColumnListing($this->getTable());
        $searchColumns = isset($this->searchColumns) ? $this->searchColumns : $columns;
        $order =  isset($this->searchOrderColumn) ? $this->searchOrderColumn : $this->getSearchOrderBy($order,$searchColumns);

        return [$columns, $searchColumns,$order];
    }

    /**
     * Get order by column search
     */
    private function getSearchOrderBy($order, $columns){
        if ($order==null && count($columns)>1) {
            $order = $columns[0];
        }else{
            $order = 'id';
        }
        return $order;
    }
}
