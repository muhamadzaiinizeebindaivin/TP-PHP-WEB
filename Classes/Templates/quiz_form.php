<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="_inc\static\style.css">
</head>
<body>
    <div class="quiz-container">
        <form method="POST" action="submit_quiz.php">
            <?php
            foreach ($this->questions['questions'] as $question) {
                echo "<div class='question'>";
                echo "<p>{$question['text']}</p>";

                switch ($question['type']) {
                    case 'text':
                        echo "<input type='text' name='{$question['name']}' required>";
                        break;

                    case 'radio':
                        foreach ($question['choices'] as $choice) {
                            echo "<label>
                                    <input type='radio' name='{$question['name']}' value='{$choice['value']}' required> 
                                    {$choice['text']}
                                  </label>";
                        }
                        break;

                    case 'checkbox':
                        foreach ($question['choices'] as $choice) {
                            echo "<label>
                                    <input type='checkbox' name='{$question['name']}[]' value='{$choice['value']}'> 
                                    {$choice['text']}
                                  </label>";
                        }
                        break;
                }
                echo "</div>";
            }
            ?>
            <input type="submit" value="Envoyer mes réponses">
        </form>
    </div>
</body>
</html>