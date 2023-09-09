<?php
class Language
{
    private $linguageUser;
    private $wordsFromIni;
    public function __construct()
    {
        global $config;
        $this->linguageUser = $config['default_lang'];

        if (!empty($_SESSION['lang']) && file_exists('lang/' . $_SESSION['lang'] . '.ini')) {
            $this->linguageUser = $_SESSION['lang'];
        }

        $this->wordsFromIni = parse_ini_file('lang/' . $this->linguageUser . '.ini');
    }

    public function get($word, $return = false)
    {
        //que lógica top
        $text = $word;

        if (isset($this->wordsFromIni[$word])) {
            $text = $this->wordsFromIni[$word];
        }

        if ($return) {
            return $text;
        } else {
            echo $text;
        }
    }
}
