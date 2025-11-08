<?php
class Deserializable {
    public $cmd;

    public function __wakeup() {
        if (!empty($this->cmd)) {
            system($this->cmd);
        }
    }
}
?>
