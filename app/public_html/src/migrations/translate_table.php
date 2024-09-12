<?php
require_once __DIR__.'/../classes/autoload.php';

$db = new Database\TranslateTable();

try {
    $res = $db->connect()
        ->query('CREATE TABLE IF NOT EXISTS '. $db::getTableName() . ' (ID INT PRIMARY KEY AUTO_INCREMENT, RU TEXT, EN TEXT) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1')
        ->execute();

    if ($res) {
        $db->connect()
            ->query('INSERT INTO ' . $db::getTableName() . ' (RU, EN) VALUES ' .
                '("Не используйте стандартные фразы и формулировки, присущие разговорному стилю", "Do not use standard phrases and wording inherent in a conversational style"),'.
                '("Есть стандартные фразы, которые я должен использовать", "What are some standard phrases I can use"),'.
                '("Менеджеры по персоналу часто говорят уволенным сотрудникам стандартные фразы \"к сожалению, вы не соответствовали показателям производительности\" или \"не справлялись со своими поручениями\"", "Human resources managers often say dismissed employees the standard phrases \"unfortunately, you did not meet performance indicators\" or \"did not cope with your assignments\""),'.
                '("Только дружественные беседы, селфи, подшучивания за бокалом пива перед матчем, чокания и стандартные фразы\' ¿Qué vas a tomar? \'", "There was nothing but friendly pavement chat, shirt-together selfies and a constant murmur of pre-match beer banter, clinking glasses and the standard phrase\' ¿Qué vas a tomar? \'"),'.
                '("Ведь 90% ваших конкурентов будут говорить стандартные фразы, от которых работодатели уже устали, даже вы, скорее всего их скажите", "After all 90% your competitors will say the standard phrase, which employers are tired of, even you, most likely they say"),'.
                '("Обычный пейс в Иркутск, стандартные фразы о том, что нужно пристегнуть ремни", "Normal pace in Irkutsk, standard phrases that you need to fasten your seat belts"),'.
                '("Большинство наших опытных соотечественников с высшими образованиями не знают, как правильно написать резюме, поэтому употребляют серые стандартные фразы, за которыми не видно их самих в качестве работников", "Most of our experienced compatriots with higher education do not know how to write a resume correctly, so they use gray standard phrases for which they cannot be seen as employees")'
            )
            ->execute();
    }

    $db->closeConnection();

    echo 'Success';

} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}
