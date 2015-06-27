<?php
class SixteensTableauPile extends Pile {
    public function __construct() {
        parent::__construct(3, false, true);
    }

    public function add_card($card) {
        if($this->is_empty() or count($this->cards) == $this->max) {
            if($this->is_empty()) {
                $this->user_message("The destination pile can no longer be used\n");
            } else {
                $this->user_message("The pile is full\n");
            }
            return false;
        } else {
            $top_card = $this->get_top_card();
            if($top_card->color() != $card->color() and ((($top_card->get_rank() - 1) % 13) == ($card->get_rank() % 13))) {
                parent::add_card($card);
                return true;
            } else {
                $this->user_message("Illegal move\n");
                return false;
            }
        }
    }

    public function can_donate_card_to($destination) {
        return true;
    }

    public function pile_name() {
        return "SixteensTableauPile";
    }
}
?>
