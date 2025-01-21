<?php

namespace Model\DataSources;
use Model\Quiz\Checkbox;
use Model\Quiz\Text;
use Model\Quiz\Radio;
 
class JsonProvider
{
    private $questions;

    public function __construct()
    {
        $this->questions = json_decode(file_get_contents('../data/questions.json'), true);
    }

    public function getListeQuestions(): array
{
    $array = [];
    foreach ($this->questions as $question) {
        $name = $question['name'];
        $type = $question['type'];
        $label = $question['text'];
        $answer = $question['answer'];
        $score = $question['score'];

        $choices = [];
        if (isset($question['choices'])) {
            foreach ($question['choices'] as $choice) {
                $choices[] = $choice['value'];
            }
        }
        switch ($type) {
            case 'text':
                $array[] = new Text($name, $label, $choices, $answer, $score);
                break;
            case 'radio':
                $array[] = new Radio($name, $label, $choices, $answer, $score);
                break;
            case 'checkbox':
                $array[] = new Checkbox($name, $label, $choices, $answer, $score);
                break;
            default:
                echo "Problem !!!!";
                break;
        }
    }
    return $array;
}
}
?>
