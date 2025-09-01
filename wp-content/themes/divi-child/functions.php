<?php
// Enqueue parent and Bootstrap styles/scripts
function divi_child_enqueue_scripts() {
    // Parent theme CSS
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    // Bootstrap 5 CSS
    wp_enqueue_style('bootstrap-5-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

    // Bootstrap 5 JS
    wp_enqueue_script('bootstrap-5-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'divi_child_enqueue_scripts');





// Custom Blog Grid Shortcode
function iph_custom_blog_grid_shortcode($atts) {
    ob_start();

    // Parse attributes
    $atts = shortcode_atts([
        'posts_per_page' => 4,
        'category' => 'your-logistics-blogs',
    ], $atts);

    $args = [
        'post_type' => 'post',
        'posts_per_page' => $atts['posts_per_page'],
        'category_name' => $atts['category'],
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ?>

<div class="iph-blog-grid rounded-top">
    <?php
        while ($query->have_posts()) {
            $query->the_post();
            ?>
    <div class="iph-blog-item">
        <?php if (has_post_thumbnail()) : ?>
        <div class="iph-blog-image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
            </a>
        </div>
        <?php endif; ?>
        <div class="iph-blog-content">
            <h2 class="iph-blog-title">
                <?php echo wp_trim_words(get_the_title(), 6, '...'); ?>
            </h2>
            <p class="iph-blog-meta">by <?php the_author(); ?> | <?php the_time('F j, Y'); ?></p>
            <div class="iph-blog-excerpt my-3">
                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
            </div>
            <a href="<?php the_permalink(); ?>" class="iph-blog-button">View Now</a>
        </div>

    </div>
    <?php
        }
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo '<p>No posts found.</p>';
    }

    return ob_get_clean();
}
function enqueue_bootstrap_for_divi_carousel() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

    // Bootstrap JS (includes Popper)
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap_for_divi_carousel');

add_shortcode('iph_blog_grid', 'iph_custom_blog_grid_shortcode');
function enqueue_bootstrap_icons() {
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css');
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap_icons');


function divi_card_slider_shortcode() {
    ob_start();
    ?>
    <style>
        .half-border-bottom {
            background-color: #2874cf;
            width: 100%;
            height: 140px;
            padding: 20px;
            border-radius: 10px;
            margin-top: -135px;
        }

        .text-image-body {
            position: relative;
            width: 380px;
            margin: 0 auto;
            display: block;
        }

        .card-image {
            max-width: 90px;
            height: 90px;
            border-radius: 50%;
            margin-top: -50px;
            border: 5px solid #252525
        }

        .card-center {
            width: 400px;
            background-color: #252525;
            border-radius: 10px;
            gap: 20px;
        }

        .container {
            margin-bottom: 40px;
            gap: 20px;
        }

        .divi-card-slider-container {
            padding: 40px 0;
            position: relative;
            max-width: 1320px;
            margin: 0 auto;
        }

        .divi-slider-wrapper {
            overflow: hidden;
        }

        .divi-cards-wrapper {
            display: flex;
            transition: transform 0.5s ease;
            margin: 0 -10px;
        }

        .divi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .divi-slider-controls {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 20px;
        }

        .divi-slider-btn {
            background: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            font-size: 20px;
        }

        .divi-slider-btn:hover {
            transform: scale(1.1);
            background-color: #f0f0f0;
        }

        @media (max-width: 980px) {
            .divi-card {
             flex: 0 0 calc(50% - 20px);
            }

            .text-image-body {
                width: 330px;
            }
           
        }

        @media (max-width: 767px) {
            .divi-card {
                flex: 0 0 calc(400px - 20px);

            }

            
            
        }
    </style>

    <div class="divi-card-slider-container">
        <div class="divi-slider-wrapper">
            <div class="divi-cards-wrapper" id="diviCardsWrapper">
                <!-- Slide 1 -->
                <div class="card-center divi-card">
                    <div class="text-end p-3">
                        <div class="d-inline-flex g-1">
                            <i class="bi bi-star-fill text-info"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <h4 class="text-light">William .R</h4>
                    </div>
                    <div class="text-center text-image-body" style="background-color:#121212; border-radius: 10px;">
                        <div class="text-start ms-4">
                            <img class="card-image"
                                src="http://localhost/shivam/projects/sourcecode/iphTechnologies/wp-content/uploads/2025/05/close-up-portrait-handsome-young-hipster-man-hazel-eyes-wearing-trendy-plaid-shirt-posing-near-city-cafe.png"
                                alt="">
                        </div>
                        <p style="color:#c3c3c3; padding:10px;">
                            IPH Technologies has a skilled team delivering results. They developed an iPhone version of
                            a larger project within a tight timeline, with significant design enhancements.
                        </p>
                    </div>
                    <div class="half-border-bottom"></div>
                </div>

                <!-- Slide 2 -->
                <div class="card-center divi-card">
                    <div class="text-end p-3">
                        <div class="d-inline-flex g-1">
                            <i class="bi bi-star-fill text-info"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <h4 class="text-light">William .R</h4>
                    </div>
                    <div class="text-center text-image-body" style="background-color:#121212; border-radius: 10px;">
                        <div class="text-start ms-4">
                            <img class="card-image"
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRI9lRck6miglY0SZF_BZ_sK829yiNskgYRUg&s"
                                alt="">
                        </div>
                        <p style="color:#c3c3c3; padding:10px;">
                            IPH Technologies has a skilled team delivering results. They developed an iPhone version of
                            a larger project within a tight timeline, with significant design enhancements.
                        </p>
                    </div>
                    <div class="half-border-bottom"></div>
                </div>

                <!-- Slide 3 -->
                <div class="card-center divi-card">
                    <div class="text-end p-3">
                        <div class="d-inline-flex g-1">
                            <i class="bi bi-star-fill text-info"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <h4 class="text-light">William .R</h4>
                    </div>
                    <div class="text-center text-image-body" style="background-color:#121212; border-radius: 10px;">
                        <div class="text-start ms-4">
                            <img class="card-image"
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRI9lRck6miglY0SZF_BZ_sK829yiNskgYRUg&s"
                                alt="">
                        </div>
                        <p style="color:#c3c3c3; padding:10px;">
                            IPH Technologies has a skilled team delivering results. They developed an iPhone version of
                            a larger project within a tight timeline, with significant design enhancements.
                        </p>
                    </div>
                    <div class="half-border-bottom"></div>
                </div>
            </div>
        </div>
        <div class="divi-slider-controls">
            <button class="divi-slider-btn" id="diviPrevBtn"><span
                    class="dashicons dashicons-arrow-left-alt2"></span></button>
            <button class="divi-slider-btn" id="diviNextBtn"><span
                    class="dashicons dashicons-arrow-right-alt2"></span></button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('diviCardsWrapper');
            const prevBtn = document.getElementById('diviPrevBtn');
            const nextBtn = document.getElementById('diviNextBtn');
            let cards = wrapper.querySelectorAll('.divi-card');
            if (!wrapper || cards.length === 0) return;
            let cardWidth = cards[0].offsetWidth + parseFloat(getComputedStyle(cards[0]).marginLeft) +
                parseFloat(getComputedStyle(cards[0]).marginRight);
            let position = 0;
            // Clone cards for infinite loop effect
            cards.forEach(card => {
                let clone = card.cloneNode(true);
                wrapper.appendChild(clone);
            });

            function moveNext() {
                position += cardWidth;
                wrapper.style.transition = 'transform 0.5s ease';
                wrapper.style.transform = `translateX(-${position}px)`;
                if (position >= cardWidth * cards.length) {
                    setTimeout(() => {
                        wrapper.style.transition = 'none';
                        position = 0;
                        wrapper.style.transform = `translateX(0px)`;
                    }, 500);
                }
            }

            function movePrev() {
                position -= cardWidth;
                if (position < 0) {
                    position = cardWidth * cards.length;
                    wrapper.style.transition = 'none';
                    wrapper.style.transform = `translateX(-${position}px)`;
                    setTimeout(() => {
                        position -= cardWidth;
                        wrapper.style.transition = 'transform 0.5s ease';
                        wrapper.style.transform = `translateX(-${position}px)`;
                    }, 20);
                } else {
                    wrapper.style.transition = 'transform 0.5s ease';
                    wrapper.style.transform = `translateX(-${position}px)`;
                }
            }
            nextBtn.addEventListener('click', moveNext);
            prevBtn.addEventListener('click', movePrev);
            setInterval(moveNext, 3000);
            window.addEventListener('resize', () => {
                cardWidth = cards[0].offsetWidth + parseFloat(getComputedStyle(cards[0]).marginLeft) +
                    parseFloat(getComputedStyle(cards[0]).marginRight);
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('divi_card_slider', 'divi_card_slider_shortcode');