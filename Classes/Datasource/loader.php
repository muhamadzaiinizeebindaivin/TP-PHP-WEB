<?php
namespace Classes\Datasource;

class DataSource {
    private $data;
    private $sourcePath;

    public function __construct(string $sourcePath = null) {
        $this->sourcePath = $sourcePath ?? __DIR__ . '/../../Data/questions.json';
        $this->loadData();
    }

    private function loadData(): void {
        if (!file_exists($this->sourcePath)) {
            throw new \RuntimeException("Source file not found: {$this->sourcePath}");
        }

        $jsonContent = file_get_contents($this->sourcePath);
        if ($jsonContent === false) {
            throw new \RuntimeException("Failed to read source file");
        }

        $this->data = json_decode($jsonContent, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException("Invalid JSON data: " . json_last_error_msg());
        }
    }

    public function getQuestions(): array {
        return $this->data ?? [];
    }

    public function saveQuestions(array $questions): bool {
        $this->data = $questions;
        return file_put_contents(
            $this->sourcePath, 
            json_encode($questions, JSON_PRETTY_PRINT)
        ) !== false;
    }
}