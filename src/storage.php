<!-- load/save JSON helpers -->
<?php
    class Storage {
        private string $path;
        private string $json;
        private array $tasks;

        public function __construct(string $path) {
            $this->path = $path;
            $this->json = file_get_contents($this->path);

            if ($this->json === false) {
                die('Error reading the JSON file');
            }

            $this->tasks = json_decode($this->json, true);
        }

        public function getTasks() : array {
            return $this->tasks;
        }

        public function saveJson(array $tasks) {
            $this->tasks = $tasks;
            $this->json = json_encode($this->tasks);
            file_put_contents($this->path, $json);
        }
    }
