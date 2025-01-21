<?php
namespace Model\DataSources;
// Charger les questions depuis le fichier JSON
use Model\Quiz\Checkbox;
use Model\Quiz\Text;
use Model\Quiz\Radio; // Assuming you have a Radio class in the same namespace
 
class JsonProvider
{
    private $questions;

    public function __construct()
    {
        // Charge les questions dans la classe
        $this->questions = json_decode(file_get_contents('../data/questions.json'), true);
    }

    public function getListeQuestions(): array
{
    $array = []; // Initialize the array to hold the question objects
    foreach ($this->questions as $question) {
        $name = $question['name'];
        $type = $question['type'];
        $label = $question['text'];
        $answer = $question['answer'];
        $score = $question['score'];

        // Handle choices, ensuring they are extracted correctly
        $choices = [];
        if (isset($question['choices'])) {
            foreach ($question['choices'] as $choice) {
                $choices[] = $choice['text']; // Or $choice['value'], depending on what you need
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
                // Handle unsupported types or log an error
                echo "Problem !!!!";
                break;
        }
    }
    return $array;
}
}
?>
