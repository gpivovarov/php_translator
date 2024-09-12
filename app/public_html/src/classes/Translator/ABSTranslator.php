<?php
namespace Translator;

abstract class ABSTranslator
{
    protected string $fromLang;
    protected string $toLang;

    public function __construct(string $fromLang, string $toLang) {
        $this->fromLang = strtoupper($fromLang);
        $this->toLang = strtoupper($toLang);
    }

    public function getTranslate(string $text): string {
        return $text;
    }
}
