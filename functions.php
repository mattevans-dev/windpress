<?php
/* -- Include WindPress. Do not delete. -- */
$folders = ['windpress', 'windpress/framework'];
foreach ($folders as $folder) {
    foreach (glob(get_template_directory() . '/' . $folder . '/*.php') as $file) {
        require $file;
    }
}
/* -- End WindPress -- */