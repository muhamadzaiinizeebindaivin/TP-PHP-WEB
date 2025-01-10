<form method="POST" action="submit_quiz.php">
    <?php
    foreach ($this->questions['questions'] as $question) {
        echo "<div>";
        echo "<p>{$question['text']}</p>";  // 'text' au lieu de 'question'

        switch ($question['type']) {
            case 'text':
                echo "<input type='text' name='{$question['name']}'>";
                break;

            case 'radio':
                foreach ($question['choices'] as $choice) {  // 'choices' au lieu de 'options'
                    echo "<label>
                            <input type='radio' name='{$question['name']}' value='{$choice['value']}'> 
                            {$choice['text']}
                          </label><br>";
                }
                break;

            case 'checkbox':
                foreach ($question['choices'] as $choice) {  // 'choices' au lieu de 'options'
                    echo "<label>
                            <input type='checkbox' name='{$question['name']}[]' value='{$choice['value']}'> 
                            {$choice['text']}
                          </label><br>";
                }
                break;
        }
        echo "</div>";
    }
    ?>
    <input type="submit" value="Envoyer">
</form>