<?php
require_once './htmlpurifier-4.15.0/library/HTMLPurifier.auto.php';

class Filter {
    private $purifier;

    public function __construct() {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'UTF-8');
        $config->set('HTML.Doctype', 'HTML 4.01 Transitional');
        $config->set('HTML.Allowed', '');
        $config->set('AutoFormat.AutoParagraph', true);
        $config->set('AutoFormat.RemoveEmpty', true);
        $config->set('AutoFormat.RemoveEmpty.RemoveNbsp', true);

        $this->purifier = new HTMLPurifier($config);
    }

    public function purify($input) {
        return $this->purifier->purify($input);
    }

    public function filterSqlInjection($input) {
        if (is_array($input)) {
            foreach ($input as $key => $value) {
                $input[$key] = $this->filterSqlInjection($value);
            }
        } else {
            $input = preg_replace("/[^A-Za-z0-9]/", '', $input);
        }
        return $input;
    }
}

