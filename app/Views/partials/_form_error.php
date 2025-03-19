<?php if (session('validacion')) : ?>
    <div>
        <?= session('validacion')->listErrors() ?>
    </div>
    <br>
<?php endif ?>
