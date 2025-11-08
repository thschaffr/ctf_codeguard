<?php
class Deserializable {
    public $cmd;
    public static $lastOutput = null;

    public function __wakeup() {
        if (!empty($this->cmd)) {
            self::$lastOutput = shell_exec($this->cmd . " 2>&1");
        }
    }
}
?>
