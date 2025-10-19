<?php
    function get_pagging ($num_page, $page, $base_url= "")
    {
        $str_pagging= "<ul class='pagging'>";
        if ($page > 1)
        {
            $page_prev= $page-1;
            $str_pagging .="<li><a href=\"{$base_url}&page={$page_prev}\">Prev</a></li>";
        }
        for ($i=1; $i<=$num_page; $i++)
        {
            $active_class= ($i==$page)?'class="active"':"";
            $str_pagging .="<li {$active_class}><a href=\"{$base_url}&page={$i}\">{$i}</a></li>";
            // unset($active_class);
        }
        if ($page < $num_page)
        {
            $page_next= $page+1;
            $str_pagging .="<li><a href=\"{$base_url}&page={$page_next}\">Next</a></li>";
        }
        $str_pagging.="</ul>";
        return $str_pagging;
    }
?>
