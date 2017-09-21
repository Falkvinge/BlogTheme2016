<?php


function falkvinge_featured_title ($headerType, $displayExcerpt, $displayCatAuthor)
{
	global $post;


	echo('<div class="featuredTitleOuterContainer">');
	echo('<div class="featuredTitleImageContainer">');

	echo ('<a href="' . get_permalink() . '" title="'. get_the_title() . '" rel="bookmark">');
	the_post_thumbnail(array (646,363), array ('class'=>'FeaturedImage'));
	echo ('</a>');

	echo ('</div>');
	echo ('<div class="featuredTitleTextContainer"><' . $headerType . ' class="featuredTitle">');
	the_title(); 
	echo ('</' . $headerType . '></div>');

	$catauthor = falkvinge_get_primary_category (get_the_ID(), 0);
	$catauthor = falkvinge_strip_language_suffix($catauthor->cat_name);

	$authorname = get_the_author();
	$authormail = get_the_author_email();


	if ($authormail != "rick.falkvinge@pirateacademy.eu")
	{
		$catauthor = $catauthor . ' &ndash; ' . $authorname;

		echo ('<div class="authorAvatarContainer" style="position:absolute;bottom:88px;right:10px;height:58px;width:58px;pointer-events:none;border: 1px solid #222">');
		echo get_avatar( $authormail, '58' );
		echo ('</div>');
	}

	if ($displayExcerpt)
	{
		echo('<div style="position:absolute;bottom:10px;left:10px;height:64px;width:552px;background-color:black;opacity:.5;border:1px solid white;pointer-events:none"></div>');
		echo('<div style="position:absolute;bottom:15px;left:10px;height:62px;width:556px;pointer-events:none;overflow:hidden">');
		echo('<p style="color:white;padding-left:8px;padding-right:10px;padding-top:7px;padding-bottom:5px;font-weight:500;line-height:18px;font-size:110%"><span style="text-transform:uppercase;font-weight:600">' . $catauthor . ':</span> ' . string_limit_words(get_the_excerpt(), 45) . '&hellip;</p>');
		echo ('</div>');
	}

	echo ('<div style="position:absolute;bottom:5px;right:10px;width:60px;height:40px;pointer-events:none"><img src="' . THEME . '/images/callout-60px.png" style="background:none;border:none;padding:0px;border:none"></div>');
	echo ('<div style="position:absolute;bottom:21px;right:10px;width:60px;height:20px;font-weight:400;font-size:18px;text-align:center;color:white;pointer-events:none;line-height:17px">' . get_comments_number() . '</div>');

	echo ('<div style="position:absolute;bottom:48px;right:12px;height:20px;width:60px;font-style:italic;font-weight:500;text-align:center;pointer-events:none;font-size:20px;line-height:17px;color:white;text-shadow:#444 1px 1px 1px, black 1px 1px" class="plusOneCount" rel="');
	the_permalink();
	echo ('"></div>');

	if ($displayCatAuthor)
	{
		echo('<div style="position:absolute;bottom:15px;left:15px;background-color:black;border:solid 1px white;pointer-events:none;opacity:.5">');
		echo('<p style="color:white;padding-left:8px;padding-right:10px;padding-top:4px;padding-bottom:6px;font-weight:500;line-height:18px;font-size:20px;line-height:20px;text-transform:uppercase">' . $catauthor . '</p>');
		echo ('</div>');
		echo('<div style="position:absolute;bottom:15px;left:15px;background-color:transparent;pointer-events:none">');
		echo('<p style="color:white;padding-left:9px;padding-right:11px;padding-top:5px;padding-bottom:7px;font-weight:500;line-height:18px;font-size:20px;line-height:20px;text-transform:uppercase">' . $catauthor . '</p>');
		echo ('</div>');
	}


	echo ('</div>');
}



function falkvinge_archive_title()
{
	echo('<div style="width:100%;height:100px;overflow:hidden;position:relative">');

		echo('<div style="float:right;padding-left:10px;width:40px;height:114px;position:relative;pointer-events:none">');
			echo('<div style="position:absolute;bottom:10px;right:0px;width:40px;height:30px"><img src="' . THEME . '/images/callout-40px.png"></div>');
			echo('<div style="position:absolute;bottom:28px;right:0px;width:40px;height:12px;font-weight:400;font-size:13px;line-height:17px;text-align:center;color:white;pointer-events:none">' . get_comments_number() . '</div>');

			echo('<div style="position:absolute;bottom:38px;right:0px;height:20px;width:45px;font-style:italic;font-weight:500;font-size:13px;line-height:17px;text-align:center;pointer-events:none;color:#808080;text-shadow:#444 1px 1px 1px, black 1px 1px" class="plusOneCount" rel="' . get_permalink() . '"></div>');

			if (get_the_author_email()!="rick@piratpartiet.se") {
				echo('<div style="position:absolute;bottom:72px;right:0px;height:38px;width:38px;pointer-events:none;border: 1px solid #222">');
				echo(get_avatar( get_the_author_email(), '38' ));
				echo('</div>');
			}

		echo('</div>');

		the_post_thumbnail('wpnv-subnews', array ('class'=>'ArchiveImage', 'align' => 'left')); // 160x90

		echo('<h2 class="postTitle"><a href="' . get_permalink() . '" title="'. get_the_title() . '" rel="bookmark">'. get_the_title() . '</a></h2>');

		echo('<p class="postExcerpt" style="font-size:12px;line-height:17px"><a href="' . get_permalink() . '" title="' . get_the_title() . '" rel="bookmark">' . string_limit_words(get_the_excerpt(), 45) . '&hellip;</p></a>');

		echo ('<div style="position:absolute;top:0px;left:0px"><a href="' . get_permalink() . '"><img src="' . THEME . '/images/transparency.png"></a></div>');

	echo('</div> <!-- end of overflow-hidden div -->');
}



function falkvinge_article_teaser_large()
{
	// Indentation becomes a little special when you're interleaving two languages...

	echo('<div style="position:relative;width:320px;height:180px">');

		echo('<div style="position:absolute;top:0px;left:0px;width:320px;height:180px;opacity:.30">');

			gab_media(array(
				'name' => 'wpnv-colwide',
				'enable_video' => '0', 
				'enable_thumb' => '1', 
				'media_width' => '320', 
				'media_height' => '180', 
				'thumb_align' => 'alignleft', 
				'enable_default' => $wpnv_options["enthumb_2"],
				'default_name' => 'primary_rightcol.jpg'
			)); 

		echo('</div>');

		echo('<div style="position:absolute;top:0px;left:0px;width:318px;height:178px;pointer-events:none;border: solid 1px black;opacity:.1"></div>');

		echo('<div class="semiFeaturedTitleTextContainer">');
			echo('<h2 class="semiFeaturedTitle"><a href="');
			the_permalink();
			echo('" title="');
			the_title();
			echo('" rel="bookmark">');
			the_title();
			echo('</a></h2>');
		echo('</div>');

		echo('<div style="position:absolute;bottom:2px;right:10px;width:40px;height:30px"><img src="' . THEME . '/images/callout-40px.png"></div>');
		echo('<div style="position:absolute;bottom:20px;right:10px;margin:0px;padding:0px;width:40px;height:12px;font-weight:400;font-size:13px;text-align:center;color:white;pointer-events:none;line-height:17px">' . get_comments_number() . '</div>');

		echo('<div style="position:absolute;bottom:30px;right:10px;height:20px;width:45px;font-style:italic;font-weight:500;text-align:center;pointer-events:none;font-size:13px;color:#808080;text-shadow:#444 1px 1px 1px, black 1px 1px;line-height:17px" class="plusOneCount" rel="');

		the_permalink();

		echo('"></div>');

		$catauthor = falkvinge_get_primary_category (get_the_ID(), 0);
		$catauthor = falkvinge_strip_language_suffix($catauthor->cat_name);

		$authorname = get_the_author();
		$authormail = get_the_author_email();


		if ($authormail != "rick.falkvinge@pirateacademy.eu")
		{
			$catauthor = $catauthor . ' &ndash; ' . $authorname;

			echo('<div style="position:absolute;bottom:60px;right:10px;height:38px;width:38px;pointer-events:none;border: 1px solid #222">');
				echo (get_avatar( $authormail, '38' ));
			echo('</div>');
		}

		echo('<div style="position:absolute;bottom:10px;left:10px;background-color:black;border:1px solid white;pointer-events:none;opacity:.2">');
		echo('<p style="color:white;padding-left:6px;padding-right:6px;padding-top:1px;padding-bottom:3px;font-weight:400;font-size:11px;line-height:14px;text-transform:uppercase">' . $catauthor . '</p>');
		echo ('</div>');
		echo('<div style="position:absolute;bottom:10px;left:10px;background-color:transparent;pointer-events:none">');
		echo('<p style="color:white;padding-left:7px;padding-right:7px;padding-top:2px;padding-bottom:4px;font-weight:400;font-size:11px;line-height:14px;text-transform:uppercase">' . $catauthor . '</p>');
		echo ('</div>');


	echo('</div>');

}


function falkvinge_article_teaser_small()
{
	// Indentation becomes a little special when you're interleaving two languages...

	echo('<div style="position:relative;width:237px;height:133px;overflow:hidden">');

		echo('<div style="position:absolute;top:0px;left:0px;width:237px;height:133px;opacity:.30">');

			gab_media(array(
				'name' => 'wpnv-colnarrow',
				'enable_video' => '0', 
				'enable_thumb' => '1', 
				'media_width' => '237', 
				'media_height' => '133', 
				'thumb_align' => 'alignleft', 
				'enable_default' => $wpnv_options["enthumb_2"],
				'default_name' => 'primary_rightcol.jpg'
			)); 

		echo('</div>');

		echo('<div style="position:absolute;top:0px;left:0px;width:235px;height:131px;pointer-events:none;border: solid 1px black;opacity:.1"></div>');

		echo('<div class="semiFeaturedTitleTextContainer">');
			echo('<h2 class="demiFeaturedTitle"><a href="');
			the_permalink();
			echo('" title="');
			the_title();
			echo('" rel="bookmark">');
			the_title();
			echo('</a></h2>');
		echo('</div>');

		echo('<div style="position:absolute;bottom:2px;right:8px;width:30px;height:23px"><img src="' . THEME . '/images/callout-30px.png"></div>');
		echo('<div style="position:absolute;bottom:15px;right:8px;margin:0px;padding:0px;width:30px;height:12px;font-weight:400;font-size:10px;text-align:center;color:white;pointer-events:none;line-height:17px">' . get_comments_number() . '</div>');

		echo('<div style="position:absolute;bottom:19px;right:8px;height:20px;width:33px;font-style:italic;font-weight:500;text-align:center;pointer-events:none;font-size:11px;color:#808080;text-shadow:#444 1px 1px 1px, black 1px 1px;line-height:13px" class="plusOneCount" rel="');

		the_permalink();

		echo('"></div>');

		$catauthor = falkvinge_get_primary_category (get_the_ID(), 0);
		$catauthor = falkvinge_strip_language_suffix($catauthor->cat_name);

		$authorname = get_the_author();
		$authormail = get_the_author_email();


		if ($authormail != "rick.falkvinge@pirateacademy.eu")
		{
			$catauthor = $catauthor . ' &ndash; ' . $authorname;

			echo('<div style="position:absolute;bottom:45px;right:8px;height:28px;width:28px;pointer-events:none;border: 1px solid #222">');
				echo (get_avatar( $authormail, '28' ));
			echo('</div>');
		}

		echo('<div style="position:absolute;bottom:8px;left:8px;background-color:black;border:1px solid white;pointer-events:none;opacity:.2">');
		echo('<p style="color:white;padding-left:5px;padding-right:5px;padding-top:1px;padding-bottom:2px;font-weight:400;font-size:9px;line-height:12px;text-transform:uppercase">' . $catauthor . '</p>');
		echo ('</div>');
		echo('<div style="position:absolute;bottom:8px;left:8px;background-color:transparent;pointer-events:none">');
		echo('<p style="color:white;padding-left:6px;padding-right:6px;padding-top:2px;padding-bottom:3px;font-weight:400;font-size:9px;line-height:12px;text-transform:uppercase">' . $catauthor . '</p>');
		echo ('</div>');


	echo('</div>');

}


function falkvinge_subnews_section ($sectionId)
{
	global $wpnv_options, $currentcat, $themeinfo, $do_not_duplicate, $post;  // globals are worse than gotos

	echo('<div class="subNewsContainer">');

		// header

		echo('<h3 class="widgetbgTitle"><a href="' . get_category_link($wpnv_options["sub" . $sectionId . "CatID"]) . '">' . get_cat_name($wpnv_options["sub" . $sectionId . "CatID"]) . '</a></h3>');
		
		// number of total posts = [number of posts with excerp & thumbnail] + number of headlines
		// modified Falkvinge: always use count #1 for all nine sections

		$postcount = 6; // $wpnv_options["postCountBot1"] + $wpnv_options["postCountBot1a"];
		if (intval($postcount) > 0 ) { 

			// Determine the query parameters

			$count = 1; 
			$args = array(
				'post__not_in'=>$do_not_duplicate, 
				'showposts' => $postcount, 
				'cat' => $wpnv_options["sub" . $sectionId . "CatID"]
			);

			$gabquery = new WP_Query();
			$gabquery->query($args); 

			while ($gabquery->have_posts()) : 
				$gabquery->the_post();

				$do_not_duplicate[] = $post->ID;
				$key2 = 'thumbnail'; $gab_thumb = get_post_meta($post->ID, $key2, TRUE); /* Custom field thumbnail check */
			
				echo('<div class="subnewspost">');
					
				if ($count == 1) {
					falkvinge_article_teaser_large();
				} 
				else 
				{
					echo('<a href="');
					the_permalink();
					echo('" class="gab_headline"');
					if ($count == 2) {
						echo ('style="margin-top:5px" '); 
					} elseif($count == $postcount) {
						echo ('style="border:none" ');
					}
					echo('title="');
					the_title();
					echo('" rel="bookmark">');
					the_title();
					echo('</a>');
				}
					
				echo('</div>'); //  end of .subnewspost


				$count++;
			endwhile;
			wp_reset_query();

		}

	echo('</div>'); // end of div.subNewsContainer

}



function falkvinge_get_post_display_category_name()
{
	global $wpnv_options, $currentcat, $themeinfo, $post;  // globals are worse than gotos

	
}



function falkvinge_formatted_post()
{
	global $post;

	$content = trim (get_the_content());
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);

	// Remove heading image from old posts

	$content = trim (falkvinge_stripfirst ($content, "<p><img", "</p>"));
	$content = trim (falkvinge_stripfirst ($content, "<div", "</div>"));

	// Remove empty lines, no matter where they are

	$content = str_replace('<p>&nbsp;</p>', '', $content);

	// Search-replace "<p style="text-align:justify">" to just "<p>"

	$content = str_replace('<p style="text-align: justify">', '<p>', $content);
	$content = str_replace('<p style="text-align:justify">', '<p>', $content);
	
	// If no intro paragraph, create one

	if (strncmp ($content, '<p>', 3) == 0)
	{
		$content = '<p class="intro">' . substr ($content, 3);
	}

	// Check for syndication

	$syndicatedLinks = get_post_custom_values ('falkvinge_syndicated_link', $post->ID);
	$syndicatedNames = get_post_custom_values ('falkvinge_syndicated_outlet_name', $post->ID);

	if (count ($syndicatedLinks) > 0)
	{
		$syndicationDisplay = '<div class="redbox"><span class="header">Syndicated Article</span><br/>This article was <a href="' . $syndicatedLinks[0] . '">previously</a> published ';
		if (count ($syndicatedNames) > 0)
		{
			$syndicationDisplay = $syndicationDisplay . 'at ' . $syndicatedNames[0] . '.</div>';
		}
		else
		{
			$syndicationDisplay = $syndicationDisplay . 'elsewhere';
		}
		$syndicationDisplay = $syndicationDisplay . '.</div>';
	}

	/* -- THIS PART WAS A DISASTER -- SAVE THE CODE FOR RSS, THOUGH

	$catauthor = falkvinge_get_primary_category (get_the_ID());
	$catauthor = $catauthor->cat_name;

	$authorname = get_the_author();


	if ($authorname != "Rick Falkvinge")
	{
		$catauthor = $catauthor . ' &ndash; ' . $authorname;
	}

	$content = str_replace ('<p class="intro">', '<p class="intro"><span class="catauthor" style="font-weight:700;text-transform:uppercase">' . $catauthor . ':</span>&ensp;', $content);


	*/

	echo $content;

	if (strlen ($syndicationDisplay) > 1)
	{
		echo $syndicationDisplay;
	}

}

function falkvinge_stripfirst ($text, $patternStart, $patternEnd)
{
	if (strncmp ($text, $patternStart, strlen($patternStart)) == 0)
	{
		// The beginning matches, so strip off at the end

		$text = strstr ($text, $patternEnd);
		$text = substr ($text, strlen ($patternEnd));
	}

	return $text;
}


function falkvinge_get_categories ($postId)
{
	global $wpnv_options;
	global $excludedPostCategoryIds;

	if (empty ($excludedPostCategoryIds))
	{
		$excludeCategoryIds = array();

		$excludeCategoryIds[] = $wpnv_options["admin1CatID"];
		$excludeCategoryIds[] = $wpnv_options["admin2CatID"];
		$excludeCategoryIds[] = $wpnv_options["admin3CatID"];

		$excludedPostCategoryIds = wpml_localized_object_ids($excludeCategoryIds, 'category');
	}

	$categories = get_the_category ($postId);

	foreach ($categories as $category)
	{
		$include = true;

		foreach ($excludedPostCategoryIds as $excludeCategoryId)
		{
			if ($category->cat_ID == $excludeCategoryId) { $include = false; }
		}

		if ($include)
		{
			$result[] = $category;
		}
	}

	return $result;
}



function wpml_localized_object_ids ($ids_array, $type)
{
	if(function_exists('icl_object_id'))
	{
		$res = array();
		foreach ($ids_array as $id)
		{
			$xlat = icl_object_id($id,$type,false);
			if(!is_null($xlat))
			{
				$res[] = $xlat;
			}
			else
			{
				$res[] = $id;
			}
		}
		return $res;
	}
	else
	{
		return $ids_array;
	}
}


function falkvinge_get_primary_category ($postId, $undesiredCategoryId)
{
	$categories = falkvinge_get_categories($postId);

	$result = $categories[0];

	if ($categories[0]->cat_ID == $undesiredCategoryId && count($categories) > 1)
	{
		$result = $categories[1];
	}

	return $result;
}

function falkvinge_strip_language_suffix ($categoryName)
{
	$result = $categoryName;

	if (strrchr ($result, '@') != false)
	{
		// Strip last three chars and trim. For when categories get "@RU" at end.

		$result = trim (substr ($result, 0, strlen($result)-3));
	}

	return $result;
}


function falkvinge_write_post_categories($postId)
{
	$categories = falkvinge_get_categories ($postId);
	$length = count($categories);
	$count = 0;

	foreach ($categories as $category)
	{
		$count++;
		echo ('<a href="' . get_category_link($category->cat_ID) . '">');
		echo ($category->cat_name);
		echo ('</a>');
		
		if ($count < $length)
		{
			echo (', ');
		}
	}
}


function falkvinge_get_category_and_author($postId)
{
	$catauthor = falkvinge_get_primary_category ($postId);
	$catauthor = $catauthor->cat_name;

	$authorname = get_the_author();


	if ($authorname != "Rick Falkvinge")
	{
		$catauthor = $catauthor . ' &ndash; ' . $authorname;
	}
}



function falkvinge_teaser_list ($categoryId, $postCount, $large)
{
	global $do_not_duplicate, $wpnv_options;

	$currentCount = 1; 
	$args = array(
		'post__not_in'=>$do_not_duplicate, 
		'showposts' => $postCount, 
		'cat' => $categoryId
	);

	// var_dump($do_not_duplicate);

	add_filter( 'posts_where', 'filter_where_2011' );
	$gabquery = new WP_Query();$gabquery->query($args); 

	while ($gabquery->have_posts()) : 
		$gabquery->the_post();
		$do_not_duplicate[] = get_the_ID();
		echo('<div class="featuredPost');

		if ($currentCount == $postCount) {
			echo (' lastPost');
		} 
		elseif ($currentCount == 1) 
		{ 
			echo (' nopadding-top');
		}
		echo ('">');

		if ($large)
		{
			falkvinge_article_teaser_large();
		}
		else
		{
			falkvinge_article_teaser_small();
		}

		echo ('</div>');

		$currentCount++;
	endwhile;
	remove_filter( 'posts_where', 'filter_where_2011' );
	wp_reset_query();
}


function filter_where_60days( $where = '' ) {
	// posts in the last 60 days
	$where .= " AND post_date > '" . date('Y-m-d', strtotime('-60 days')) . "'";
	return $where;
}

function filter_where_2011( $where = '' ) {
	// posts from 2011 onward, meaning "in English"
	$where .= " AND post_date > '2011-01-01'";
	return $where;
}



function falkvinge_popular_post_list ($postCount)
{
	global $do_not_duplicate, $wpnv_options;

	$currentCount = 1; 

	// var_dump($do_not_duplicate);

	add_filter( 'posts_where', 'filter_where_60days' );
	$gabquery = new WP_Query('orderby=comment_count&posts_per_page=' . $postCount);

	while ($gabquery->have_posts()) : 
		$gabquery->the_post();
		$do_not_duplicate[] = get_the_ID();
		echo('<div class="featuredPost');

		if ($currentCount == $postCount) {
			echo (' lastPost');
		} 
		elseif ($currentCount == 1) 
		{ 
			echo (' nopadding-top');
		}
		echo ('">');
		falkvinge_article_teaser_large();

		echo ('</div>');

		$currentCount++;
	endwhile;
	remove_filter( 'posts_where', 'filter_where_60days' );
	wp_reset_query();
}



function falkvinge_format_rss_post_header($content)
{
	global $post;
	$header = '';

	// Remove legacy formatting

	$content = trim (get_the_content());
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);

	$content = trim (falkvinge_stripfirst ($content, "<p><img", "</p>"));
	$content = trim (falkvinge_stripfirst ($content, "<div", "</div>"));

	$catauthor = falkvinge_get_primary_category (get_the_ID(), 0);
	$catauthor = $catauthor->cat_name;

	$authorname = get_the_author();

	if ($authorname != "Rick Falkvinge")
	{
		$catauthor = $catauthor . ' &ndash; ' . $authorname;
	}

	// If no intro paragraph, create one

	if (strncmp ($content, '<p>', 3) == 0)
	{
		$content = '<p class="intro">' . substr ($content, 3);
	}

	// Replace CSSed intro paragraph with direct styling

	$content = str_replace ('<p class="intro">', '<p style="font-size:120%;font-weight:700"><span style="font-weight:800;text-transform:uppercase">' . $catauthor . ':</span>&ensp;', $content);

	// Replace redbox, bluebox with direct styling 

	$content = str_replace ('<div class="redbox"><span class="header">', '<div style="margin-top: 15px;margin-bottom: 15px;border: 2px #cd1713 solid;padding: 5px;padding-left: 8px;padding-top:2px;padding-bottom: 6px;line-height: 140%;font-size: 80%;font-style: italic;"><span style="color: #cd1713;padding-bottom: 10px;	line-height:200%;font-size:110%;font-weight: bold;font-style: normal;text-transform: uppercase;">', $content);

	$content = str_replace ('<div class="bluebox"><span class="header">', '<div style="margin-top: 15px;margin-bottom: 15px;border: 2px #1317CD solid;padding: 5px;padding-left: 8px;padding-top:2px;padding-bottom: 6px;line-height: 140%;font-size: 80%;font-style: italic;"><span style="color: #1317CD;padding-bottom: 10px;	line-height:200%;font-size:110%;font-weight: bold;font-style: normal;text-transform: uppercase;">', $content);

	if(has_post_thumbnail($post->ID)) {

		$header = $header . '<div style="width:237;height:133px;margin-bottom:15px;margin-left:20px;float:right">';

		// Image

		$header = $header . get_the_post_thumbnail($post->ID, array(232,120)); // The array is pixel size for the thumbnail

		// Everything except the thumbnail was stripped out as it looked absolutely AWFUL in Google Reader which is the primary
		// target -- Google Reader strips _all_ positioning instructions in DIVs

		// End of encapsulating div

		$header = $header . '</div>';
	}

	return $header . $content;
}


add_filter('the_excerpt_rss', 'falkvinge_format_rss_post_header');
add_filter('the_content_feed', 'falkvinge_format_rss_post_header');


function falkvinge_get_language_name ($languageCode)
{
	if ($languageCode == 'zh')
	{
		$languageCode = 'zh-hans';
	}

	if ($languageCode == 'pt')
	{
		$languageCode = 'pt-br';
	}

	if(!function_exists('icl_object_id'))
	{
		return "WPML_NOT_INSTALLED";
	}

	global $wpdb;
	$activeLanguageCode = ICL_LANGUAGE_CODE;
	$langQueryResult = $wpdb->get_row($wpdb->prepare("SELECT * FROM wprf_icl_languages_translations WHERE language_code='%s' AND display_language_code='%s'", $languageCode, $activeLanguageCode));

	return falkvinge_get_language_name_in_current_capitalization($langQueryResult->name);
}


function falkvinge_credit_translator()
{
	global $post, $wpdb;

	if(!function_exists('icl_object_id'))
	{
		echo ("WPML_NOT_INSTALLED");
	}

	$xlatId = icl_object_id($post->ID,'post',false);

	if ($xlatId == NULL)
	{
		echo ("<p>translated ID is NULL -- this should not happen</p>");
	}

	$translatorDisplay = '';
	$txlQueryResult = $wpdb->get_row($wpdb->prepare("SELECT * FROM wprf_posts WHERE post_name='%d-revision'", $post->ID));

	if ($txlQueryResult != NULL)
	{
		$translator = get_userdata ($txlQueryResult->post_author);
		$translatorDisplay = $translator->display_name;

		if (strlen ($translator->user_url) > 1)
		{
			$translatorDisplay = ' <a href="' . $translator->user_url . '">' . $translatorDisplay . '</a>';
		}
	}

	$translatorNames = get_post_custom_values ('translator_name', $post->ID);
	$translatorLinks = get_post_custom_values ('translator_link', $post->ID);

	if (count ($translatorNames) > 0)
	{
		if (count ($translatorLinks) > 0)
		{
			$translatorDisplay = '<a href="' . $translatorLinks[0] . '">' . $translatorNames[0] . '</a>';
		}
		else
		{
			$translatorDisplay = $translatorNames[0];
		}
	}

	if (strlen ($translatorDisplay) > 1)
	{
		echo ('<p><small><em>');
		printf(__('This article was translated into %s by %s.', 'foi_text'),
			falkvinge_get_language_name_in_current_capitalization(ICL_LANGUAGE_NAME), 
			$translatorDisplay);
		echo('</em></small></p>');
	}
}


function falkvinge_get_language_name_in_current_capitalization ($input)
{
	/* only English, German capitalizes language names, and yet, WPML's db has them all capitalized */

	if(!function_exists('icl_object_id'))
	{
		return "WPML_NOT_INSTALLED";
	}

	if (ICL_LANGUAGE_CODE == "en")
	{
		return $input;
	}
	else if (ICL_LANGUAGE_CODE == "de")
	{
		return $input;
	}
	
	return mb_strtolower($input);
}


function falkvinge_social_buttons()
{
	global $post;

	// Twitter

	echo('<div style="float:right;margin-left:10px">');

		echo('<a href="http://twitter.com/share" class="twitter-share-button" data-url="' . get_permalink() . '" data-text="#'. get_the_author_meta('aim') . ': ' . get_the_title() . '" data-count="vertical">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>');

	echo('</div>');

	// Flattr

	if (function_exists ('the_flattr_permalink'))   // included through plugin
	{
		echo ('<div style="float:right;margin-left:10px">');
			the_flattr_permalink();
		echo ('</div>');
	}
	
	// StumbleUpon

	echo('<div style="float:right;margin-left:10px">');
		echo('<script src="http://www.stumbleupon.com/hostedbadge.php?s=5"></script>');
	echo('</div>');


	// Reddit

	echo('<div style="float:right;margin-left:10px">');
		echo('<script type="text/javascript" src="http://www.reddit.com/static/button/button2.js">reddit_url="' . get_permalink() . '";</script>');
	echo('</div>');

	// Digg

	echo('<div style="float:right;margin-left:10px">');
		echo('<script type="text/javascript">(function() {var s = document.createElement("SCRIPT"), s1 =document.getElementsByTagName("SCRIPT")[0];s.type = "text/javascript";s.async = true;s.src = "http://widgets.digg.com/buttons.js";s1.parentNode.insertBefore(s, s1);})();</script>');
		echo('<a class="DiggThisButton DiggMedium" href="' . get_permalink() . '"></a>');
	echo('</div>');

	// Facebook

	echo ('<div style="float:left;margin-bottom:8px;margin-top:4px;width:300px">');
		echo ('<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=156424067775558&amp;xfbml=1"></script><fb:like href="' . get_permalink() . '" send="false" width="300" show_faces="false" font="tahoma"></fb:like>');
	echo ('</div>');

	// G+

	echo ('<div style="clear:left;float:left;margin-bottom:4px;width:300px">');
		echo ('<g:plusone size="standard" href="' . get_permalink() . '" annotation="inline"></g:plusone><script type="text/javascript">(function() { var po = document.createElement("script"); po.type = "text/javascript"; po.async = true; po.src = "https://apis.google.com/js/plusone.js"; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s); })(); </script>');
	echo ('</div>');

}


/* returns a comma-delimited string of categories to exclude */
function falkvinge_get_excluded_categories()
{
	global $wpnv_options;
	global $excluded_localized_categories;

	if (empty($excluded_localized_categories))
	{
		$originalCatsExclude = $wpnv_options["excludeCategories"];
		$excluded_localized_categories = join (',', wpml_localized_object_ids (explode(',', $originalCatsExclude), 'category'));
	}

	return $excluded_localized_categories;		
}

