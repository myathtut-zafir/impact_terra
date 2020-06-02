<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductPriceMyanmarCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param $resource
     */
    public function __construct($resource)
    {
        $this->pagination = [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'last_page' => $resource->lastPage(),
            'next_pages' => $resource->nextPageUrl(),
            'previous_pages' => $resource->previousPageUrl(),
            'first_pages' => $resource->onFirstPage(),
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'code' => 200,
            'message' => "success to get products",
            'data' => ProductPriceMyanamrResource::collection($this->collection),
            'current_page' => $this->pagination['current_page'],
            'last_page' => $this->pagination['last_page'],
            'next_page_url' => $this->pagination['next_pages'],
            'per_page' => $this->pagination['per_page'],
            'prev_page_url' => $this->pagination['previous_pages'],
            'total' => $this->pagination['total']

        ];
    }
}
