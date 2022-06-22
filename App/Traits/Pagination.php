<?php

namespace App\Traits;

trait Pagination
{
    public function paginate($total_rows, $per_page = PER_PAGE)
    {
        $page = isset($_GET['page']) ? (abs((int) $_GET['page']) ?: 1) : 1;

        $start = ($page - 1) * $per_page;

        $total_pages = ceil($total_rows / $per_page);

        $next_page = ($page + 1) > $total_pages ? $total_pages : ($page + 1);

        return get_defined_vars();
    }
}
