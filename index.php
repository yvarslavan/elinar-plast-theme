<?php get_header(); ?>

<main class="section blog-content">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="page-header">
                <h1><?php single_post_title(); ?></h1>
            </div>

            <div class="posts-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="entry-meta">
                                <?php echo get_the_date(); ?>
                            </div>
                        </header>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination">
                <?php the_posts_navigation(); ?>
            </div>

        <?php else : ?>
            <p>Записей не найдено.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
