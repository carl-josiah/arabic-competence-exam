<?php

class Question
{
    public int $id;
    public string $text;
    public array $choices;
    public int $correct;

    public function __construct(int $id, string $text, array $choices, int $correct)
    {
        $this->id = $id;
        $this->text = $text;
        $this->choices = $choices;
        $this->correct = $correct;
    }
}
