<?php $title='Sitemap';
include'config.php';
echo $head;
$file = file("sitemap.dat");
$count = count($file);
$limit = $count;
echo '<div class="title">Sitemap</div><div class="menu">';
for ($i=0; $i < $limit; $i++)
{$chunk=$file[$i];
$chunk=str_replace('
','',$chunk);
echo'<a href="/search/'.$chunk.'">'.$chunk.'</a>, ';
}
echo'</div>';
echo $foot; ?>
