<?php
require_once __DIR__.'/src/classes/autoload.php';
$translateHandle = new Translator\Main('ru', 'en');

$arTexts = [
    'Не используйте стандартные фразы и формулировки, присущие разговорному стилю',
    'Есть стандартные фразы, которые я должен использовать',
    'Обычный пейс в Иркутск, стандартные фразы о том, что нужно пристегнуть ремни',
    'Менеджеры по персоналу часто говорят уволенным сотрудникам стандартные фразы "к сожалению, вы не соответствовали показателям производительности" или "не справлялись со своими поручениями"'
];

$ch = new \Database\TranslateTable();

foreach ($arTexts as $phrase) {
    echo '<p><i>'.$phrase.'</i> <b>-></b> <i>'.$translateHandle->getTranslate($phrase).'</i></p>';
}

$ch->closeConnection();

?>
