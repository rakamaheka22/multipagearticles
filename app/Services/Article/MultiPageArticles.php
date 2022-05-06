<?php

namespace App\Services\Article;

use Illuminate\Pagination\LengthAwarePaginator;

trait MultiPageArticles
{
    /**
     * Default attribute name for paginated content.
     *
     * @var string
     */
    protected $defaultPaginatedContentAttribute = 'content';

    /**
     * Get the attributes name for paginated content.
     *
     * @return string
     */
    protected function getPaginatedContentAttribute()
    {
        return $this->paginatedContentAttribute ?? $this->defaultPaginatedContentAttribute;
    }

    /**
     * @param  int  $page
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginateContent(int $page)
    {
        // separate article content by pagebreak
        $contents = explode('<!-- pagebreak -->', $this->{$this->getPaginatedContentAttribute()});
        // set separated article contents to associative array
        foreach ($contents as $key => $content) {
            $contents[$key] = ['content' => $content];
        }
        // set article contents as collection
        $contents = collect($contents);

        // get separated article content count
        $contentPageCount = $contents->count();

        // get selected article content by page params
        $offset = $page != 1 ? $offset = (1 * ($page - 1)) : 0;
        $contentPerPage = $contents->slice($offset, 1)->all();

        return new LengthAwarePaginator(
            $contentPerPage,
            $contentPageCount,
            1,
            $page,
            ['path' => url()->current()]
        );
    }
}
