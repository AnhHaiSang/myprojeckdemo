<?php 
$tags = get_tags(array(
    'hide_empty' => false
));
echo '<ul class="tag-lists">';
foreach ($tags as $tag) {
    echo '<li class="list-item">' . $tag->name . '</li>';
}
echo '</ul>';?>