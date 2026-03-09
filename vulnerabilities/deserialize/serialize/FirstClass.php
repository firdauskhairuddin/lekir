<?php

class First {
    public $default = 10;
    public $trigger = 0;
    public $command = '"Hello World!"';
    public $_func = 'print_r';
    public $num = 0;
    
    public function __construct($num) {
        $this->trigger = $this->add($this->default, $num);
        $this->num = $num;
        $this->result();
    }

    public function add($first, $second) {
        return $first + $second;
    }

    public function result(): void {
        echo "<div class='result-box'>";
        echo "<h3>📊 Calculation Results:</h3>";
        echo "<p>Default number: <span class='value'>" . $this->default . "</span></p>";
        echo "<p>Your picked number: <span class='value'>" . $this->num . "</span></p>";
        echo "<p>Sum result: <span class='value'>" . $this->trigger . "</span></p>";
        echo "</div>";
    }

    public function __destruct() {
        if ($this->trigger < $this->default) {
            echo "<div class='alert alert-warning'>";
            echo "⚠️ Trigger condition met! (trigger = {$this->trigger} < default = {$this->default})<br>";
            echo "Attempting to call <code>{$this->_func}</code> with parameter: <code>" . htmlspecialchars($this->command) . "</code>";
            echo "</div>";
            
            // Execute the function if it exists and is callable
            if (is_callable($this->_func)) {
                echo "<div class='alert alert-execution'>";
                echo "🔧 Function Output:<br>";
                call_user_func($this->_func, $this->command);
                echo "</div>";
            } else {
                echo "<div class='alert alert-danger'>";
                echo "❌ Error: <code>{$this->_func}</code> is not a callable function!";
                echo "</div>";
            }
        } else {
            echo "<div class='alert alert-info'>";
            echo "✅ Safe: trigger ({$this->trigger}) >= default ({$this->default}) - No execution";
            echo "</div>";
        }
    }
}