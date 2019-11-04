<?php
class NightsWatch {
    protected $fighters = array();

    public function fight() {
        foreach ($this->fighters as $fighter) {
            $fighter->fight();
        }
    }

    public function recruit($name) {
        if ($name instanceof IFighter)
            $this->fighters[] = $name;
    }
}
?>