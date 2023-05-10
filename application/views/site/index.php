<main>
    <section class="media-section">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <ul class="categories-list">
                        <li>
                            <a href="<?= base_url() ?>">
                                <p class="category-single all-photos-list <?= !isset($_GET['category']) ? 'active' : '' ?>">All Photos</p>
                            </a>
                        </li>
                        <?php foreach ($CATEGORIES as $category) { ?>
                            <li>
                                <a href="<?= base_url() . '?category=' . $category->id ?>">
                                    <p class="category-single <?= isset($_GET['category']) && $_GET['category'] === $category->id ? 'active' : '' ?>">
                                        <?= $category->category ?>
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-9">
                    <h3 class="section-title heading5"><?= !isset($_GET['category']) ? 'All Photos' : $CATEGORIES[array_search($_GET['category'], array_column($CATEGORIES, 'id'), 'id')]->category ?></h3>
                    <?php
                    if (count($PHOTOS) == 0) {
                        echo '<center>No photos to show</center>';
                    }
                    $count = 0;
                    $evenodd = 'even';
                    foreach ($PHOTOS as $photo) {
                    ?>
                        <?= $count % 3 === 0 ? '<div class="grid ' . $evenodd . '-row">' : '' ?>
                        <div class="grid-item">
                            <div class="mediaCard">
                                <img src="<?= $photo->is_image == 1 ? base_url('uploads/photos/' . $photo->file_name) : ($photo->thumbnail_path ? base_url('uploads/thumbnails/' . $photo->thumbnail_path) : base_url('assets/site/images/no-image-placeholder.png')) ?>" />
                                <div class="media-content">
                                    <h4 class="heading2"><?= $photo->title ? $photo->title : 'No title' ?></h4>
                                    <h5 class="sub-heading" title="<?= $photo->orig_name ?>"><?= strlen($photo->orig_name) > 20 ? mb_substr($photo->orig_name, 0, 20) . '...' : $photo->orig_name; ?></h5>
                                    <p class="supported-text media-views"> <?= $photo->total_views == 0 ? 'No' : $photo->total_views ?> views</p>
                                </div>
                                <div class="media-card-overlay"></div>
                            </div>
                        </div>
                    <?php
                        if ($count % 3 == 2) {
                            echo '</div>';
                            $evenodd = $evenodd == 'even' ? 'odd' : 'even';
                        }
                        $count++;
                    } ?>
                </div>
            </div>
        </div>
    </section>