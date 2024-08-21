<?php
/*
	 * Template Name: Kezdőlap
 	 * Template Author: Bakos Attila
 	 * Date: 2024
	 */
?>

<?php
$messages = array(
	"signin" => "Sikeres bejelentkezés",
	"signout" => "Kijelentkeztél a fiókodból.",
	"not_authorized" => "Az oldal megtekintéséhez be kell jelentkezned."
)
?>

<!-- Header -->
<?php get_header(); ?>

<!-- Alert box -->
<?php if (isset($_GET['action'])) : ?>
	<div class="alertbox alert alert-info text-justify" role="alert">
		<i class="fa fa-info-circle"></i>
		<span>
			<?= $messages[$_GET['action']] ?>
		</span>
	</div>
<?php endif; ?>

<!-- Tartalom -->
<div class="contents">
	<div class="row">
		<?php
		global $wp_query;
		$args = array(
			'category_and' => -1,
			'posts_per_page' => 4
		);
		$pageposts = get_posts($args);
		?>

		<?php
		foreach ($pageposts as $post) :
			setup_postdata($post);
			get_template_part('content', get_post_format());
		endforeach;
		?>
	</div>
</div>

<!-- Footer -->
<?php get_footer(); ?>