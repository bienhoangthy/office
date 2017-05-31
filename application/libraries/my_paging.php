<?php
/**
 * Created by PhpStorm.
 * User: tinhnguyenvan
 * Date: 5/29/14
 * Time: 2:44 PM
 */
    class my_paging
    {
        public function paging_donturl($record,$currpage,$display,$pagesize,$link){
            $pagenumber = 1;
            $i = 1;
            $totalpage=0;
            if ($record % $display > 0)
                $totalpage = (int)($record / $display) + 1;
            else
                $totalpage = (int)($record / $display);
            $start = 0;
            $paging='';
            if($totalpage > 1)
            {
                if ($currpage <= $totalpage)
                {
                    if ($currpage == 1)
                    {
                        $pagenumber = $pagesize;
                        if ($pagenumber  > $totalpage) $pagenumber  = $totalpage;
                        $start = 1;
                    }
                    else
                    {
                        $paging = $paging . " <li><a href='".$link."1'>First</a></li>";
                        $paging = $paging . " <li class='prev'><a href='".$link.($currpage - 1) ."'>← Previous</a></li>";
                        if (($totalpage - $currpage) < ($pagesize / 2))
                        {
                            $start = ($totalpage - $pagesize) + 1;
                            if ($start < 0) $start = 1;
                            $pagenumber  = $totalpage;
                        }
                        else
                        {
                            if ($currpage - ($pagesize / 2) == 0)
                            {
                                $start = 1;
                                $pagenumber  = $currpage + ($pagesize / 2) + 1;
                                if ($totalpage < $pagenumber) $pagenumber = $totalpage;
                            }
                            else
                            {
                                $start = $currpage - ($pagesize / 2);
                                if ($start < 0) $start = 1;
                                $pagenumber  = $currpage + ($pagesize / 2);
                                if ($totalpage < $pagenumber) $pagenumber = $totalpage;
                                else
                                    if ($pagenumber < $pagesize) $pagenumber = $pagesize;
                                //PRINT @PageNumber
                            }
                        }
                    }
                    $i = $start<1?1:(int)$start;
                    while ($i <= $pagenumber)
                    {
                        if ($i == $currpage) $paging = $paging . " <li class='active'><a>" . $i . "</a></li>";
                        else
                            $paging = $paging . " <li><a href='".$link. $i ."'>" . $i . "</a></li>";
                        $i++;
                    }
                    if ($currpage < $totalpage)
                    {
                        $paging = $paging . " <li class='next'><a href='".$link.($currpage + 1) ."'>Next → </a></li>";
                        $paging = $paging . " <li><a href='".$link. $totalpage ."'>Last</a></li>";
                    }
                }
            }
            return $paging;
        }   
    }
?>