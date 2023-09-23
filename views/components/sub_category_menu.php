<?php foreach ($subs as $sub) : ?>
    <li>
        <a href="">
            <?php for ($cont = 0; $cont < $level; $cont++) echo "-- "; ?>
            <?= $sub['name'] ?>
        </a>
    </li>
    <?php
    if (count($sub['subs']) > 0) {
        $this->loadView('components/sub_category_menu', array(
            'subs' => $sub['subs'],
            'level' => $level + 1
        ));
    }
    ?>
<?php endforeach ?>