<?php
get_header();

$tagSlug = get_queried_object()->slug;

get_template_part('loop-templates/generic', 'tag', ['tagSlug' => $tagSlug]);

get_footer();
