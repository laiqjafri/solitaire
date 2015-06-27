<?php
class SpecialTowersPile extends Pile {
    public function __construct() {
        parent::__construct(1, false, true);
    }

    public function add_card($card) {
        if(count($this->cards) == $this->max) {
            $this->user_message("The pile is full\n");
            return false;
        } else {
            parent::add_card($card);
            return true;
        }
    }

    public function can_donate_card_to($destination) {
        return true;
    }

    public function pile_name() {
        return "SpecialTowersPile";
    }
}
?>
