<?php
class SpecialTableauPile extends SixteensTableauPile {
    public function __construct() {
        parent::__construct(3, false, true);
    }

    public function add_card($card) {
        if($this->is_empty()) {
            $this->cards []= $card;
            return true;
        } else {
            if(count($this->cards) >= $this->max) {
                $this->user_message("This pile is full\n");
                return false;
            } else {
                $top_card = $this->get_top_card();
                if($top_card->color() != $card->color() and ((($top_card->get_rank() - 1) % 13) == ($card->get_rank() % 13))) {
                    $this->cards []= $card;
                    return true;
                } else {
                    $this->user_message("Illegal move\n");
                    return false;
                }
            }
        }
    }

    public function can_donate_card_to($destination) {
        return true;
    }

    public function pile_name() {
        return "SpecialTableauPile";
    }
}
?>
