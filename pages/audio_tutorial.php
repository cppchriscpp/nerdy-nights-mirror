<div class="mdl-layout__tab-panel" id="audio_tutorial">
    <section class="section--center mdl-grid mdl-grid--no-spacing">
        <div class="mdl-cell mdl-cell--12-col">
            <h4>Audio Tutorial Series</h4>

            <h5>Chapters</h5>
            <ul class="toc" id="audio_tutorial-toc">

                <?php foreach ($TUTORIAL_MANIFEST['audio'] as $idx => $item): ?>
                    <a href="#audio_tutorial-<?php echo $idx; ?>"><?php echo $item['name']; ?></a>
                <?php endforeach; ?>
            </ul>

            <?php foreach($TUTORIAL_MANIFEST['audio'] as $idx => $item): ?>
                <div class="tutorialCard mdl-card mdl-shadow--2dp" id="audio_tutorial-<?php echo $idx; ?>">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text"><?php echo $item['name']; ?></h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <?php include "scraper/pages/" . $item['filename']; ?>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="#audio_tutorial-toc">
                        Back to Table of Contents
                    </a>

                    </div>
                </div>
                <div class="spacer"></div>

            <?php endforeach; ?>

        </div>
    </section>
</div>
